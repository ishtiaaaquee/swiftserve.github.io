/**
 * User Profile Management
 * Handles profile display, orders, favorites, and settings
 */

// Initialize profile when DOM loads
document.addEventListener('DOMContentLoaded', () => {
    initializeProfile();
    setupProfileEventListeners();
});

function initializeProfile() {
    // Check if user is logged in when profile modal opens
    const profileModal = document.getElementById('userProfileModal');
    if (profileModal) {
        profileModal.addEventListener('show.bs.modal', loadUserProfile);
    }
}

function loadUserProfile() {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    // Update profile header
    document.getElementById('profileUserName').textContent = user.name;
    document.getElementById('profileUserEmail').textContent = user.email;
    document.getElementById('profileUserPhone').textContent = user.phone || 'No phone added';

    // Load user data
    loadUserOrders();
    loadUserFavorites();
    loadUserAddresses();
    loadUserStats();
}

function loadUserStats() {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    // Get orders from localStorage
    const orders = JSON.parse(localStorage.getItem(`orders_${user.email}`) || '[]');
    const favorites = JSON.parse(localStorage.getItem(`favorites_${user.email}`) || '[]');
    const points = parseInt(localStorage.getItem(`points_${user.email}`) || '0');

    document.getElementById('totalOrders').textContent = orders.length;
    document.getElementById('totalFavorites').textContent = favorites.length;
    document.getElementById('loyaltyPoints').textContent = points;
}

function loadUserOrders() {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    const orders = JSON.parse(localStorage.getItem(`orders_${user.email}`) || '[]');
    const ordersList = document.getElementById('ordersList');

    if (orders.length === 0) {
        ordersList.innerHTML = `
            <div class="empty-state text-center py-5">
                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                <p class="text-muted">No orders yet</p>
                <p class="small text-muted">Start ordering delicious food!</p>
            </div>
        `;
        return;
    }

    ordersList.innerHTML = orders.map(order => `
        <div class="order-card">
            <div class="order-header">
                <div>
                    <h6 class="mb-0">Order #${order.id}</h6>
                    <small class="text-muted">${new Date(order.date).toLocaleDateString()}</small>
                </div>
                <span class="badge bg-${getOrderStatusColor(order.status)}">${order.status}</span>
            </div>
            <div class="order-items mt-2">
                <p class="mb-1"><strong>${order.itemCount} items</strong></p>
                <p class="text-muted mb-0">Total: $${order.total.toFixed(2)}</p>
            </div>
            <div class="order-actions mt-3">
                <button class="btn btn-sm btn-outline-primary" onclick="viewOrderDetails('${order.id}')">
                    <i class="fas fa-eye me-1"></i>View Details
                </button>
                <button class="btn btn-sm btn-outline-secondary" onclick="reorderItems('${order.id}')">
                    <i class="fas fa-redo me-1"></i>Reorder
                </button>
            </div>
        </div>
    `).join('');
}

function loadUserFavorites() {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    const favorites = JSON.parse(localStorage.getItem(`favorites_${user.email}`) || '[]');
    const favoritesList = document.getElementById('favoritesList');

    if (favorites.length === 0) {
        favoritesList.innerHTML = `
            <div class="empty-state text-center py-5">
                <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                <p class="text-muted">No favorites yet</p>
                <p class="small text-muted">Save your favorite restaurants and dishes</p>
            </div>
        `;
        return;
    }

    favoritesList.innerHTML = favorites.map(item => `
        <div class="favorite-card">
            <div class="d-flex align-items-center">
                <div class="favorite-image">
                    <i class="fas fa-${item.type === 'restaurant' ? 'store' : 'utensils'}"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="mb-0">${item.name}</h6>
                    <small class="text-muted">${item.description || item.type}</small>
                </div>
                <button class="btn btn-sm btn-outline-danger" onclick="removeFavorite('${item.id}')">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `).join('');
}

function loadUserAddresses() {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    const addresses = JSON.parse(localStorage.getItem(`addresses_${user.email}`) || '[]');
    const addressesList = document.getElementById('addressesList');

    if (addresses.length === 0) {
        addressesList.innerHTML = `
            <div class="empty-state text-center py-5">
                <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                <p class="text-muted">No saved addresses</p>
                <p class="small text-muted">Add your delivery addresses for faster checkout</p>
            </div>
        `;
        return;
    }

    addressesList.innerHTML = addresses.map((addr, index) => `
        <div class="address-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="mb-1">
                        <i class="fas fa-${addr.type === 'home' ? 'home' : addr.type === 'work' ? 'briefcase' : 'map-marker-alt'} me-2"></i>
                        ${addr.label}
                        ${addr.isDefault ? '<span class="badge bg-primary ms-2">Default</span>' : ''}
                    </h6>
                    <p class="text-muted small mb-0">${addr.address}</p>
                </div>
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-primary" onclick="editAddress(${index})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteAddress(${index})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

function setupProfileEventListeners() {
    // Add address button
    const addAddressBtn = document.getElementById('addAddressBtn');
    if (addAddressBtn) {
        addAddressBtn.addEventListener('click', showAddAddressModal);
    }

    // Settings toggles
    ['emailNotif', 'smsNotif', 'promoNotif'].forEach(id => {
        const toggle = document.getElementById(id);
        if (toggle) {
            toggle.addEventListener('change', (e) => saveNotificationSettings(id, e.target.checked));
        }
    });
}

function getOrderStatusColor(status) {
    const colors = {
        'Pending': 'warning',
        'Preparing': 'info',
        'On the way': 'primary',
        'Delivered': 'success',
        'Cancelled': 'danger'
    };
    return colors[status] || 'secondary';
}

function viewOrderDetails(orderId) {
    // Implementation for viewing order details
    showNotification('Opening order details...', 'info');
}

function reorderItems(orderId) {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    const orders = JSON.parse(localStorage.getItem(`orders_${user.email}`) || '[]');
    const order = orders.find(o => o.id === orderId);
    
    if (order) {
        showNotification('Items added to cart!', 'success');
    }
}

function removeFavorite(itemId) {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    let favorites = JSON.parse(localStorage.getItem(`favorites_${user.email}`) || '[]');
    favorites = favorites.filter(f => f.id !== itemId);
    localStorage.setItem(`favorites_${user.email}`, JSON.stringify(favorites));
    
    loadUserFavorites();
    loadUserStats();
    showNotification('Removed from favorites', 'success');
}

function showAddAddressModal() {
    const address = prompt('Enter your delivery address:');
    if (!address) return;

    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    const addresses = JSON.parse(localStorage.getItem(`addresses_${user.email}`) || '[]');
    addresses.push({
        id: Date.now(),
        label: addresses.length === 0 ? 'Home' : `Address ${addresses.length + 1}`,
        address: address,
        type: addresses.length === 0 ? 'home' : 'other',
        isDefault: addresses.length === 0
    });

    localStorage.setItem(`addresses_${user.email}`, JSON.stringify(addresses));
    loadUserAddresses();
    loadUserStats();
    showNotification('Address added successfully!', 'success');
}

function editAddress(index) {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    const addresses = JSON.parse(localStorage.getItem(`addresses_${user.email}`) || '[]');
    const addr = addresses[index];
    
    const newAddress = prompt('Edit address:', addr.address);
    if (newAddress) {
        addresses[index].address = newAddress;
        localStorage.setItem(`addresses_${user.email}`, JSON.stringify(addresses));
        loadUserAddresses();
        showNotification('Address updated!', 'success');
    }
}

function deleteAddress(index) {
    if (!confirm('Delete this address?')) return;

    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    const addresses = JSON.parse(localStorage.getItem(`addresses_${user.email}`) || '[]');
    addresses.splice(index, 1);
    localStorage.setItem(`addresses_${user.email}`, JSON.stringify(addresses));
    
    loadUserAddresses();
    loadUserStats();
    showNotification('Address deleted', 'success');
}

function saveNotificationSettings(setting, value) {
    const user = window.authSystem?.getCurrentUser();
    if (!user) return;

    const settings = JSON.parse(localStorage.getItem(`settings_${user.email}`) || '{}');
    settings[setting] = value;
    localStorage.setItem(`settings_${user.email}`, JSON.stringify(settings));
    
    showNotification('Settings saved', 'success');
}

function showNotification(message, type) {
    if (window.authSystem) {
        // Use existing notification system if available
        const event = new CustomEvent('showNotification', { detail: { message, type } });
        document.dispatchEvent(event);
    }
}

// Export functions for global access
window.userProfile = {
    loadUserProfile,
    viewOrderDetails,
    reorderItems,
    removeFavorite
};
