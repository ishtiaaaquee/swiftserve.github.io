/**
 * Shopping Cart Functionality
 * Manages cart operations, storage, and UI updates
 */

class ShoppingCart {
    constructor() {
        this.items = this.loadCart();
        this.init();
    }

    init() {
        this.updateCartUI();
        this.attachEventListeners();
    }

    attachEventListeners() {
        // Cart toggle button
        const cartToggleBtn = document.getElementById('cartToggleBtn');
        const cartSidebar = document.getElementById('cartSidebar');
        const closeCartBtn = document.getElementById('closeCart');
        
        if (cartToggleBtn) {
            cartToggleBtn.addEventListener('click', () => {
                cartSidebar.classList.add('active');
            });
        }

        if (closeCartBtn) {
            closeCartBtn.addEventListener('click', () => {
                cartSidebar.classList.remove('active');
            });
        }

        // Close cart when clicking outside
        document.addEventListener('click', (e) => {
            if (cartSidebar.classList.contains('active') && 
                !cartSidebar.contains(e.target) && 
                !cartToggleBtn.contains(e.target)) {
                cartSidebar.classList.remove('active');
            }
        });

        // Add to cart buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-add-to-cart')) {
                const btn = e.target.closest('.btn-add-to-cart');
                const card = btn.closest('.menu-item-card');
                
                const item = {
                    id: card.dataset.id,
                    name: card.dataset.name,
                    price: parseFloat(card.dataset.price),
                    image: card.querySelector('img')?.src || 'assets/images/placeholder.jpg'
                };

                this.addItem(item);
                this.showAddedNotification(item.name);
            }
        });

        // Checkout button
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', () => {
                this.checkout();
            });
        }
    }

    addItem(item) {
        const existingItem = this.items.find(i => i.id === item.id);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.items.push({...item, quantity: 1});
        }

        this.saveCart();
        this.updateCartUI();
    }

    removeItem(itemId) {
        this.items = this.items.filter(item => item.id !== itemId);
        this.saveCart();
        this.updateCartUI();
    }

    updateQuantity(itemId, newQuantity) {
        const item = this.items.find(i => i.id === itemId);
        
        if (item) {
            if (newQuantity <= 0) {
                this.removeItem(itemId);
            } else {
                item.quantity = newQuantity;
                this.saveCart();
                this.updateCartUI();
            }
        }
    }

    getTotal() {
        return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    }

    getItemCount() {
        return this.items.reduce((sum, item) => sum + item.quantity, 0);
    }

    saveCart() {
        localStorage.setItem('swiftserve_cart', JSON.stringify(this.items));
    }

    loadCart() {
        const saved = localStorage.getItem('swiftserve_cart');
        return saved ? JSON.parse(saved) : [];
    }

    clearCart() {
        this.items = [];
        this.saveCart();
        this.updateCartUI();
    }

    updateCartUI() {
        const cartCount = document.getElementById('cartCount');
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');
        const checkoutBtn = document.getElementById('checkoutBtn');

        // Update count badge
        const count = this.getItemCount();
        if (cartCount) {
            cartCount.textContent = count;
            cartCount.classList.toggle('hidden', count === 0);
        }

        // Update total
        if (cartTotal) {
            cartTotal.textContent = `$${this.getTotal().toFixed(2)}`;
        }

        // Enable/disable checkout button
        if (checkoutBtn) {
            checkoutBtn.disabled = count === 0;
        }

        // Update cart items display
        if (cartItems) {
            if (this.items.length === 0) {
                cartItems.innerHTML = `
                    <div class="empty-cart text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Your cart is empty</p>
                    </div>
                `;
            } else {
                cartItems.innerHTML = this.items.map(item => `
                    <div class="cart-item" data-id="${item.id}">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                        <div class="cart-item-details">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                            <div class="cart-item-controls">
                                <button class="qty-btn qty-decrease" data-id="${item.id}">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="qty-display">${item.quantity}</span>
                                <button class="qty-btn qty-increase" data-id="${item.id}">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="btn-remove-item" data-id="${item.id}">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('');

                // Attach event listeners to cart item controls
                this.attachCartItemListeners();
            }
        }
    }

    attachCartItemListeners() {
        // Quantity increase
        document.querySelectorAll('.qty-increase').forEach(btn => {
            btn.addEventListener('click', () => {
                const itemId = btn.dataset.id;
                const item = this.items.find(i => i.id === itemId);
                if (item) {
                    this.updateQuantity(itemId, item.quantity + 1);
                }
            });
        });

        // Quantity decrease
        document.querySelectorAll('.qty-decrease').forEach(btn => {
            btn.addEventListener('click', () => {
                const itemId = btn.dataset.id;
                const item = this.items.find(i => i.id === itemId);
                if (item) {
                    this.updateQuantity(itemId, item.quantity - 1);
                }
            });
        });

        // Remove item
        document.querySelectorAll('.btn-remove-item').forEach(btn => {
            btn.addEventListener('click', () => {
                const itemId = btn.dataset.id;
                this.removeItem(itemId);
                this.showNotification('Item removed from cart', 'error');
            });
        });
    }

    showAddedNotification(itemName) {
        this.showNotification(`${itemName} added to cart!`, 'success');
        
        // Open cart sidebar briefly
        const cartSidebar = document.getElementById('cartSidebar');
        if (cartSidebar) {
            cartSidebar.classList.add('active');
            setTimeout(() => {
                // Auto-close after 2 seconds if user doesn't interact
                if (!cartSidebar.matches(':hover')) {
                    cartSidebar.classList.remove('active');
                }
            }, 2000);
        }
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
            ${message}
        `;
        
        // Add to body
        document.body.appendChild(notification);
        
        // Show notification
        setTimeout(() => notification.classList.add('show'), 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    checkout() {
        if (this.items.length === 0) {
            this.showNotification('Your cart is empty!', 'error');
            return;
        }

        // Here you would typically redirect to checkout page or open checkout modal
        const total = this.getTotal();
        const itemCount = this.getItemCount();
        
        const confirmed = confirm(
            `Proceed to checkout?\n\n` +
            `Items: ${itemCount}\n` +
            `Total: $${total.toFixed(2)}\n\n` +
            `(In a real application, this would take you to the checkout page)`
        );

        if (confirmed) {
            this.showNotification('Redirecting to checkout...', 'success');
            // Simulate checkout process
            setTimeout(() => {
                this.clearCart();
                document.getElementById('cartSidebar').classList.remove('active');
                this.showNotification('Order placed successfully! (Demo)', 'success');
            }, 1500);
        }
    }
}

// Add notification styles dynamically
const notificationStyles = `
<style>
.notification {
    position: fixed;
    top: 100px;
    right: -400px;
    background: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    z-index: 10000;
    transition: right 0.3s ease;
    display: flex;
    align-items: center;
    font-weight: 600;
    min-width: 300px;
}

.notification.show {
    right: 2rem;
}

.notification-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.notification-error {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.notification-info {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}

[data-theme="dark"] .notification {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', notificationStyles);

// Initialize cart when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.cart = new ShoppingCart();
});
