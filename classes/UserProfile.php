<?php
/**
 * UserProfile Class
 * Handles user profile section and settings
 */
class UserProfile {
    
    public function render() {
        ?>
        <!-- User Profile Modal -->
        <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content user-profile-modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userProfileModalLabel">
                            <i class="fas fa-user-circle me-2"></i>My Profile
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Profile Tabs -->
                        <ul class="nav nav-pills mb-4" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview" type="button">
                                    <i class="fas fa-user me-2"></i>Overview
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="orders-tab" data-bs-toggle="pill" data-bs-target="#orders" type="button">
                                    <i class="fas fa-shopping-bag me-2"></i>Orders
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="favorites-tab" data-bs-toggle="pill" data-bs-target="#favorites" type="button">
                                    <i class="fas fa-heart me-2"></i>Favorites
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="addresses-tab" data-bs-toggle="pill" data-bs-target="#addresses" type="button">
                                    <i class="fas fa-map-marker-alt me-2"></i>Addresses
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="pill" data-bs-target="#settings" type="button">
                                    <i class="fas fa-cog me-2"></i>Settings
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="profileTabContent">
                            <!-- Overview Tab -->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <div class="profile-overview">
                                    <div class="profile-header text-center mb-4">
                                        <div class="profile-avatar">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                        <h4 class="mt-3 mb-1" id="profileUserName">Loading...</h4>
                                        <p class="text-muted" id="profileUserEmail">Loading...</p>
                                        <p class="text-muted small" id="profileUserPhone">Loading...</p>
                                        <span class="badge bg-success">Active Member</span>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="stat-card">
                                                <div class="stat-icon">
                                                    <i class="fas fa-shopping-bag"></i>
                                                </div>
                                                <div class="stat-info">
                                                    <h3 id="totalOrders">0</h3>
                                                    <p>Total Orders</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="stat-card">
                                                <div class="stat-icon">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                                <div class="stat-info">
                                                    <h3 id="totalFavorites">0</h3>
                                                    <p>Favorites</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="stat-card">
                                                <div class="stat-icon">
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="stat-info">
                                                    <h3 id="loyaltyPoints">0</h3>
                                                    <p>Loyalty Points</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Orders Tab -->
                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                <div class="orders-list" id="ordersList">
                                    <div class="empty-state text-center py-5">
                                        <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No orders yet</p>
                                        <p class="small text-muted">Start ordering delicious food!</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Favorites Tab -->
                            <div class="tab-pane fade" id="favorites" role="tabpanel">
                                <div class="favorites-list" id="favoritesList">
                                    <div class="empty-state text-center py-5">
                                        <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No favorites yet</p>
                                        <p class="small text-muted">Save your favorite restaurants and dishes</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Addresses Tab -->
                            <div class="tab-pane fade" id="addresses" role="tabpanel">
                                <div class="addresses-section">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6>Saved Addresses</h6>
                                        <button class="btn btn-sm btn-primary" id="addAddressBtn">
                                            <i class="fas fa-plus me-1"></i>Add New
                                        </button>
                                    </div>
                                    <div class="addresses-list" id="addressesList">
                                        <div class="empty-state text-center py-5">
                                            <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No saved addresses</p>
                                            <p class="small text-muted">Add your delivery addresses for faster checkout</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="settings" role="tabpanel">
                                <div class="settings-section">
                                    <h6 class="mb-3">Account Settings</h6>
                                    
                                    <div class="setting-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Email Notifications</h6>
                                                <small class="text-muted">Receive order updates via email</small>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="setting-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">SMS Notifications</h6>
                                                <small class="text-muted">Receive delivery updates via SMS</small>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="smsNotif" checked>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="setting-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Promotional Offers</h6>
                                                <small class="text-muted">Get notified about deals and offers</small>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="promoNotif">
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <h6 class="mb-3">Privacy & Security</h6>
                                    
                                    <button class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-key me-2"></i>Change Password
                                    </button>
                                    
                                    <button class="btn btn-outline-danger w-100">
                                        <i class="fas fa-trash me-2"></i>Delete Account
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
