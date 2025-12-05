<?php
/**
 * Order Success Page - SwiftServe Food Delivery
 */

// Initialize page components
require_once 'classes/Page.php';
require_once 'classes/Navigation.php';
require_once 'classes/Footer.php';

$page = new Page('Order Confirmed - SwiftServe', 'Your order has been placed successfully', 'order confirmation, food delivery');
$navigation = new Navigation('🍔 SwiftServe');
$footer = new Footer();

$orderId = isset($_GET['order']) ? htmlspecialchars($_GET['order']) : 'N/A';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page->renderHead(); ?>
</head>
<body class="transition-colors duration-300">

    <?php $navigation->render(); ?>

    <!-- Success Section -->
    <section class="success-section" style="padding: 150px 0 100px; background: var(--bg-secondary); min-height: 100vh;">
        <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px; text-align: center;">
            
            <!-- Success Icon -->
            <div style="margin-bottom: 2rem; animation: scaleIn 0.5s ease;">
                <div style="width: 120px; height: 120px; margin: 0 auto; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-check" style="font-size: 60px; color: white;"></i>
                </div>
            </div>

            <!-- Success Message -->
            <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1rem;">
                Order Placed Successfully!
            </h1>
            
            <p style="font-size: 1.2rem; color: var(--text-secondary); margin-bottom: 2rem;">
                Thank you for ordering with SwiftServe! Your delicious food is on its way.
            </p>

            <!-- Order Details Card -->
            <div style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem; text-align: left;">
                <div style="text-align: center; margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px dashed #e5e7eb;">
                    <div style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 0.5rem;">Order ID</div>
                    <div style="font-size: 1.8rem; font-weight: 700; color: var(--primary);">#<?php echo $orderId; ?></div>
                </div>

                <div id="orderDetails"></div>

                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e5e7eb;">
                    <h3 style="font-size: 1.3rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; text-align: center;">
                        <i class="fas fa-clock" style="color: var(--primary);"></i> Estimated Delivery
                    </h3>
                    <div style="text-align: center; font-size: 2rem; font-weight: 700; color: var(--primary);">
                        30-45 Minutes
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="index.php" style="background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; padding: 1rem 2rem; border-radius: 12px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s;">
                    <i class="fas fa-home"></i> Back to Home
                </a>
                <a href="index.php#restaurants" style="background: white; color: var(--text-primary); padding: 1rem 2rem; border-radius: 12px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; border: 2px solid #e5e7eb; transition: all 0.3s;">
                    <i class="fas fa-utensils"></i> Order More
                </a>
            </div>

            <!-- Track Order Info -->
            <div style="margin-top: 3rem; padding: 1.5rem; background: linear-gradient(135deg, #fff5eb, #ffe8cc); border-radius: 16px;">
                <p style="color: var(--text-primary); font-size: 1rem; margin-bottom: 0.5rem;">
                    <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                    <strong>We'll call you when your order is on the way!</strong>
                </p>
                <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0;">
                    Keep your phone handy for delivery updates.
                </p>
            </div>
        </div>
    </section>

    <?php $footer->render(); ?>

    <?php $page->renderScripts(); ?>
    
    <script>
        // Load and display order details
        document.addEventListener('DOMContentLoaded', function() {
            const orderId = '<?php echo $orderId; ?>';
            const orders = JSON.parse(localStorage.getItem('swiftserve_orders') || '[]');
            const order = orders.find(o => o.orderId === orderId);
            
            if (order) {
                const detailsHtml = `
                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 1.1rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                            <i class="fas fa-shopping-bag" style="color: var(--primary);"></i> Order Items
                        </h4>
                        ${order.items.map(item => `
                            <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;">
                                <div>
                                    <div style="font-weight: 600; color: var(--text-primary);">${item.name}</div>
                                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Qty: ${item.quantity} × ৳${item.price}</div>
                                </div>
                                <div style="font-weight: 700; color: var(--primary);">৳${(item.price * item.quantity).toFixed(0)}</div>
                            </div>
                        `).join('')}
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 1.1rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary);"></i> Delivery Address
                        </h4>
                        <p style="color: var(--text-secondary); margin: 0; line-height: 1.6;">
                            ${order.customerName}<br>
                            ${order.customerPhone}<br>
                            ${order.address.street}, ${order.address.area}
                            ${order.address.postalCode ? ', ' + order.address.postalCode : ''}
                        </p>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 1.1rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                            <i class="fas fa-credit-card" style="color: var(--primary);"></i> Payment Method
                        </h4>
                        <p style="color: var(--text-secondary); margin: 0;">
                            ${order.paymentMethod === 'cod' ? 'Cash on Delivery' : order.paymentMethod === 'bkash' ? 'bKash' : 'Credit/Debit Card'}
                        </p>
                    </div>
                    
                    <div style="background: #f9fafb; padding: 1rem; border-radius: 12px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: var(--text-secondary);">Subtotal</span>
                            <span style="font-weight: 600;">৳${order.subtotal.toFixed(0)}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: var(--text-secondary);">Delivery Fee</span>
                            <span style="font-weight: 600;">৳${order.deliveryFee}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-top: 0.75rem; margin-top: 0.75rem; border-top: 2px solid #e5e7eb;">
                            <span style="font-size: 1.2rem; font-weight: 700; color: var(--text-primary);">Total</span>
                            <span style="font-size: 1.2rem; font-weight: 700; color: var(--primary);">৳${order.total.toFixed(0)}</span>
                        </div>
                    </div>
                `;
                
                document.getElementById('orderDetails').innerHTML = detailsHtml;
            }
        });
    </script>
    
    <style>
        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

</body>
</html>
