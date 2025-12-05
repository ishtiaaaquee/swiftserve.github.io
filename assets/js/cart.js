/**
 * Shopping Cart Functionality
 * Manages cart operations, storage, and UI updates
 */

class ShoppingCart {
    constructor() {
        console.log('🏗️ ShoppingCart constructor called');
        this.items = this.loadCart();
        console.log('📦 Loaded cart items:', this.items);
        this.init();
    }

    init() {
        console.log('⚙️ Initializing cart...');
        this.updateCartUI();
        this.attachEventListeners();
        console.log('✅ Cart initialization complete');
    }

    attachEventListeners() {
        console.log('📎 Attaching cart event listeners...');
        
        // Cart toggle button
        const cartToggleBtn = document.getElementById('cartToggleBtn');
        const cartSidebar = document.getElementById('cartSidebar');
        const closeCartBtn = document.getElementById('closeCart');
        
        console.log('Cart elements found:', {
            toggleBtn: !!cartToggleBtn,
            sidebar: !!cartSidebar,
            closeBtn: !!closeCartBtn
        });
        
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

        // Add to cart buttons - handles both menu cards and modal menu items
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-add-to-cart') || e.target.closest('.add-to-cart')) {
                console.log('🔔 Add to cart button clicked!');
                const btn = e.target.closest('.btn-add-to-cart') || e.target.closest('.add-to-cart');
                console.log('Button:', btn);
                console.log('Button data:', btn.dataset);
                
                // Try to get data from the button's data attributes first (modal menu items)
                let item;
                if (btn.dataset.id) {
                    item = {
                        id: btn.dataset.id,
                        name: btn.dataset.name,
                        price: parseFloat(btn.dataset.price),
                        image: btn.dataset.image || 'assets/images/placeholder.jpg'
                    };
                    console.log('✅ Item created from button data:', item);
                } else {
                    // Fallback to card-based data (regular menu cards)
                    const card = btn.closest('.menu-item-card');
                    if (card) {
                        item = {
                            id: card.dataset.id,
                            name: card.dataset.name,
                            price: parseFloat(card.dataset.price),
                            image: card.querySelector('img')?.src || 'assets/images/placeholder.jpg'
                        };
                        console.log('✅ Item created from card data:', item);
                    } else {
                        console.error('❌ Could not find menu card');
                    }
                }

                if (item) {
                    console.log('📦 Adding item to cart:', item);
                    this.addItem(item);
                    this.showAddedNotification(item.name);
                } else {
                    console.error('❌ No item data found!');
                }
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
            cartTotal.textContent = `৳${this.getTotal().toFixed(0)}`;
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
                    <div class="cart-item" data-id="${item.id}" style="display: flex; gap: 12px; padding: 15px; border-bottom: 1px solid #e5e7eb; animation: slideIn 0.3s ease;">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; flex-shrink: 0;">
                        <div class="cart-item-details" style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                            <div class="cart-item-name" style="font-weight: 600; color: #2b2d42; font-size: 0.95rem;">${item.name}</div>
                            <div class="cart-item-price" style="color: #ff6b35; font-weight: 700; font-size: 1rem;">৳${item.price.toFixed(0)} × ${item.quantity} = ৳${(item.price * item.quantity).toFixed(0)}</div>
                            <div class="cart-item-controls" style="display: flex; gap: 8px; align-items: center;">
                                <button class="qty-btn qty-decrease" data-id="${item.id}" style="width: 28px; height: 28px; border: 1px solid #e5e7eb; background: white; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='white'">
                                    <i class="fas fa-minus" style="font-size: 10px; color: #6b7280;"></i>
                                </button>
                                <span class="qty-display" style="min-width: 30px; text-align: center; font-weight: 600; color: #2b2d42;">${item.quantity}</span>
                                <button class="qty-btn qty-increase" data-id="${item.id}" style="width: 28px; height: 28px; border: 1px solid #e5e7eb; background: white; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='white'">
                                    <i class="fas fa-plus" style="font-size: 10px; color: #6b7280;"></i>
                                </button>
                                <button class="btn-remove-item" data-id="${item.id}" style="margin-left: auto; color: #ef4444; background: none; border: none; cursor: pointer; padding: 6px 10px; font-size: 0.85rem; transition: all 0.2s;" onmouseover="this.style.color='#dc2626'; this.style.background='#fee2e2'; this.style.borderRadius='6px';" onmouseout="this.style.color='#ef4444'; this.style.background='none';">
                                    <i class="fas fa-trash"></i>
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

        // Redirect to checkout page
        window.location.href = 'checkout.php';
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

.notification-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

[data-theme="dark"] .notification {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', notificationStyles);

// Initialize cart when DOM is ready
console.log('📜 cart.js file loaded');

document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 DOMContentLoaded fired in cart.js');
    window.cart = new ShoppingCart();
    console.log('🛒 Shopping Cart initialized!', window.cart);
});
