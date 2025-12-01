/**
 * Food Delivery Platform Features
 * Additional functionality specific to food delivery
 */

// Restaurant Filter
class RestaurantFilter {
    constructor() {
        this.currentFilter = 'all';
        this.init();
    }

    init() {
        this.attachFilterListeners();
    }

    attachFilterListeners() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('.filter-btn')) {
                const btn = e.target.closest('.filter-btn');
                const category = btn.dataset.category;
                this.filterRestaurants(category);
                
                // Update active state
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active');
                });
                btn.classList.add('active');
            }
        });
    }

    filterRestaurants(category) {
        this.currentFilter = category;
        const restaurantCards = document.querySelectorAll('.restaurant-card');
        
        restaurantCards.forEach(card => {
            const cardCategories = card.dataset.categories?.toLowerCase() || '';
            
            if (category === 'all' || cardCategories.includes(category.toLowerCase())) {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.5s ease';
            } else {
                card.style.display = 'none';
            }
        });
    }
}

// Delivery Address Search
class DeliverySearch {
    constructor() {
        this.init();
    }

    init() {
        const searchBtn = document.querySelector('.delivery-search-box button');
        const searchInput = document.querySelector('.delivery-search-box input');
        
        if (searchBtn && searchInput) {
            searchBtn.addEventListener('click', () => {
                this.searchLocation(searchInput.value);
            });
            
            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    this.searchLocation(searchInput.value);
                }
            });
        }
    }

    searchLocation(address) {
        if (!address.trim()) {
            this.showAlert('Please enter your delivery address', 'warning');
            return;
        }

        // Simulate location search
        this.showAlert(`Searching for restaurants near: ${address}...`, 'info');
        
        // In a real application, this would call a geolocation API
        setTimeout(() => {
            this.showAlert(`Found 24 restaurants delivering to ${address}!`, 'success');
        }, 1500);
    }

    showAlert(message, type) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.style.cssText = 'position: fixed; top: 100px; left: 50%; transform: translateX(-50%); z-index: 10000; min-width: 400px;';
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.remove();
        }, 4000);
    }
}

// Animated Counters for Stats
class AnimatedCounter {
    constructor() {
        this.init();
    }

    init() {
        const counters = document.querySelectorAll('.stat-number');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    }

    animateCounter(element) {
        const target = parseInt(element.dataset.target || element.textContent.replace(/\D/g, ''));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < target) {
                element.textContent = Math.floor(current).toLocaleString() + '+';
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString() + '+';
            }
        };

        updateCounter();
    }
}

// Restaurant Card Interactions
class RestaurantCard {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('.restaurant-card')) {
                const card = e.target.closest('.restaurant-card');
                // Don't navigate if clicking inside the card for other actions
                if (!e.target.closest('button')) {
                    this.viewRestaurant(card);
                }
            }
        });
    }

    viewRestaurant(card) {
        const restaurantName = card.querySelector('.restaurant-name')?.textContent || 'Restaurant';
        
        // In a real application, this would navigate to restaurant detail page
        console.log(`Viewing restaurant: ${restaurantName}`);
        
        // Show modal or navigate to detail page
        this.showRestaurantModal(restaurantName);
    }

    showRestaurantModal(name) {
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'restaurantModal';
        modal.innerHTML = `
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${name}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-muted py-5">
                            <i class="fas fa-utensils fa-3x mb-3"></i><br>
                            Restaurant menu and details would appear here.<br>
                            <small>(This is a demo - full implementation would show menu items, reviews, etc.)</small>
                        </p>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        
        modal.addEventListener('hidden.bs.modal', () => {
            modal.remove();
        });
    }
}

// Order Tracking Simulation
class OrderTracking {
    constructor() {
        this.orders = this.loadOrders();
    }

    createOrder(items, total) {
        const order = {
            id: 'ORD' + Date.now(),
            items: items,
            total: total,
            status: 'confirmed',
            timestamp: new Date().toISOString(),
            estimatedDelivery: new Date(Date.now() + 30 * 60000).toLocaleTimeString()
        };

        this.orders.unshift(order);
        this.saveOrders();
        return order;
    }

    updateOrderStatus(orderId, status) {
        const order = this.orders.find(o => o.id === orderId);
        if (order) {
            order.status = status;
            this.saveOrders();
        }
    }

    getOrder(orderId) {
        return this.orders.find(o => o.id === orderId);
    }

    saveOrders() {
        localStorage.setItem('swiftserve_orders', JSON.stringify(this.orders));
    }

    loadOrders() {
        const saved = localStorage.getItem('swiftserve_orders');
        return saved ? JSON.parse(saved) : [];
    }
}

// Favorites Management
class FavoritesManager {
    constructor() {
        this.favorites = this.loadFavorites();
        this.init();
    }

    init() {
        this.attachEventListeners();
        this.updateUI();
    }

    attachEventListeners() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-favorite')) {
                const btn = e.target.closest('.btn-favorite');
                const itemId = btn.dataset.id;
                this.toggleFavorite(itemId);
            }
        });
    }

    toggleFavorite(itemId) {
        const index = this.favorites.indexOf(itemId);
        
        if (index > -1) {
            this.favorites.splice(index, 1);
        } else {
            this.favorites.push(itemId);
        }

        this.saveFavorites();
        this.updateUI();
    }

    isFavorite(itemId) {
        return this.favorites.includes(itemId);
    }

    saveFavorites() {
        localStorage.setItem('swiftserve_favorites', JSON.stringify(this.favorites));
    }

    loadFavorites() {
        const saved = localStorage.getItem('swiftserve_favorites');
        return saved ? JSON.parse(saved) : [];
    }

    updateUI() {
        document.querySelectorAll('.btn-favorite').forEach(btn => {
            const itemId = btn.dataset.id;
            const icon = btn.querySelector('i');
            
            if (this.isFavorite(itemId)) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                btn.classList.add('active');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                btn.classList.remove('active');
            }
        });
    }
}

// Initialize all delivery features
document.addEventListener('DOMContentLoaded', () => {
    // Initialize features
    window.restaurantFilter = new RestaurantFilter();
    window.deliverySearch = new DeliverySearch();
    window.animatedCounter = new AnimatedCounter();
    window.restaurantCard = new RestaurantCard();
    window.orderTracking = new OrderTracking();
    window.favoritesManager = new FavoritesManager();

    console.log('🍔 SwiftServe Food Delivery Platform Initialized!');
});

// Add favorite button styles
const favoriteStyles = `
<style>
.btn-favorite {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-favorite:hover,
.btn-favorite.active {
    color: #ef4444;
    transform: scale(1.2);
}

.btn-favorite.active i {
    animation: heartBeat 0.5s ease;
}

@keyframes heartBeat {
    0%, 100% { transform: scale(1); }
    25% { transform: scale(1.3); }
    50% { transform: scale(1.1); }
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', favoriteStyles);
