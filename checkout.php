<?php
/**
 * Checkout Page - SwiftServe Food Delivery
 */

// Initialize page components
require_once 'classes/Page.php';
require_once 'classes/Navigation.php';
require_once 'classes/Footer.php';

$page = new Page('Checkout - SwiftServe', 'Complete your order', 'checkout, payment, food delivery');
$navigation = new Navigation('🍔 SwiftServe');
$footer = new Footer();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page->renderHead(); ?>
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body class="transition-colors duration-300">

    <?php $navigation->render(); ?>

    <!-- Checkout Section -->
    <section class="checkout-section" style="padding: 100px 0 80px; background: var(--bg-secondary); min-height: 100vh;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            
            <!-- Page Header -->
            <div class="text-center mb-5" style="margin-bottom: 3rem;">
                <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                    <i class="fas fa-shopping-cart" style="color: var(--primary);"></i> Checkout
                </h1>
                <p style="color: var(--text-secondary); font-size: 1.1rem;">Complete your order in a few simple steps</p>
            </div>

            <div class="checkout-grid" style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem;">
                
                <!-- Left Column: Delivery & Payment -->
                <div>
                    <!-- Delivery Address -->
                    <div class="checkout-card" style="background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); margin-bottom: 2rem;">
                        <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary);"></i>
                            Delivery Address
                        </h3>
                        
                        <form id="deliveryForm">
                            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Full Name *</label>
                                    <input type="text" id="customerName" required style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 1rem;">
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Phone Number *</label>
                                    <input type="tel" id="customerPhone" required style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 1rem;">
                                </div>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Street Address *</label>
                                <input type="text" id="streetAddress" required style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 1rem;">
                            </div>
                            
                            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Area *</label>
                                    <select id="area" required style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 1rem;">
                                        <option value="">Select Area</option>
                                        <option value="Dhanmondi">Dhanmondi</option>
                                        <option value="Gulshan">Gulshan</option>
                                        <option value="Banani">Banani</option>
                                        <option value="Uttara">Uttara</option>
                                        <option value="Mirpur">Mirpur</option>
                                        <option value="Mohammadpur">Mohammadpur</option>
                                        <option value="Old Dhaka">Old Dhaka</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Postal Code</label>
                                    <input type="text" id="postalCode" style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 1rem;">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-primary);">Delivery Instructions (Optional)</label>
                                <textarea id="deliveryInstructions" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 1rem; resize: vertical;" placeholder="e.g., Ring the doorbell, Call when nearby..."></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-card" style="background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                        <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-credit-card" style="color: var(--primary);"></i>
                            Payment Method
                        </h3>
                        
                        <div class="payment-options" style="display: grid; gap: 1rem;">
                            <label class="payment-option" style="display: flex; align-items: center; gap: 1rem; padding: 1.25rem; border: 2px solid #e5e7eb; border-radius: 12px; cursor: pointer; transition: all 0.3s;">
                                <input type="radio" name="payment" value="cod" checked style="width: 20px; height: 20px; cursor: pointer;">
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; font-size: 1.1rem; color: var(--text-primary); margin-bottom: 0.25rem;">
                                        <i class="fas fa-money-bill-wave" style="color: #10b981; margin-right: 0.5rem;"></i>
                                        Cash on Delivery
                                    </div>
                                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Pay when you receive your order</div>
                                </div>
                            </label>
                            
                            <label class="payment-option" style="display: flex; align-items: center; gap: 1rem; padding: 1.25rem; border: 2px solid #e5e7eb; border-radius: 12px; cursor: pointer; transition: all 0.3s;">
                                <input type="radio" name="payment" value="bkash" style="width: 20px; height: 20px; cursor: pointer;">
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; font-size: 1.1rem; color: var(--text-primary); margin-bottom: 0.25rem;">
                                        <i class="fas fa-mobile-alt" style="color: #e2136e; margin-right: 0.5rem;"></i>
                                        bKash
                                    </div>
                                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Mobile payment</div>
                                </div>
                            </label>
                            
                            <label class="payment-option" style="display: flex; align-items: center; gap: 1rem; padding: 1.25rem; border: 2px solid #e5e7eb; border-radius: 12px; cursor: pointer; transition: all 0.3s;">
                                <input type="radio" name="payment" value="card" style="width: 20px; height: 20px; cursor: pointer;">
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; font-size: 1.1rem; color: var(--text-primary); margin-bottom: 0.25rem;">
                                        <i class="fas fa-credit-card" style="color: #3b82f6; margin-right: 0.5rem;"></i>
                                        Credit/Debit Card
                                    </div>
                                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Visa, Mastercard, American Express</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div>
                    <div class="checkout-card" style="background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); position: sticky; top: 100px;">
                        <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem;">Order Summary</h3>
                        
                        <div id="orderItems" style="margin-bottom: 1.5rem;">
                            <!-- Items will be loaded here -->
                        </div>
                        
                        <div style="border-top: 2px solid #e5e7eb; padding-top: 1rem; margin-bottom: 1rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                                <span style="color: var(--text-secondary);">Subtotal</span>
                                <span id="subtotal" style="font-weight: 600; color: var(--text-primary);">৳0</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                                <span style="color: var(--text-secondary);">Delivery Fee</span>
                                <span id="deliveryFee" style="font-weight: 600; color: var(--text-primary);">৳60</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding-top: 1rem; border-top: 2px solid #e5e7eb; margin-top: 1rem;">
                                <span style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary);">Total</span>
                                <span id="total" style="font-size: 1.25rem; font-weight: 700; color: var(--primary);">৳0</span>
                            </div>
                        </div>
                        
                        <button id="placeOrderBtn" style="width: 100%; background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; padding: 1rem; border: none; border-radius: 12px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s; margin-bottom: 1rem;">
                            <i class="fas fa-check-circle"></i> Place Order
                        </button>
                        
                        <div style="text-align: center; color: var(--text-secondary); font-size: 0.9rem;">
                            <i class="fas fa-lock"></i> Secure checkout
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $footer->render(); ?>

    <?php $page->renderScripts(); ?>
    
    <script src="assets/js/checkout.js"></script>

</body>
</html>
