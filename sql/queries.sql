-- ============================================
-- SwiftServe Common SQL Queries
-- ============================================

-- ============================================
-- USER QUERIES
-- ============================================

-- Get user details with stats
SELECT u.*, 
       COUNT(DISTINCT o.id) as total_orders,
       SUM(o.total_amount) as total_spent,
       COUNT(DISTINCT ua.id) as saved_addresses,
       COUNT(DISTINCT f.id) as favorite_restaurants
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
LEFT JOIN user_addresses ua ON u.id = ua.user_id
LEFT JOIN user_favorites f ON u.id = f.user_id
WHERE u.id = ?
GROUP BY u.id;

-- Find users by email
SELECT id, email, full_name, phone, created_at, last_login
FROM users
WHERE email LIKE '%@%';

-- Get top customers by order count
SELECT u.id, u.full_name, u.email, 
       COUNT(o.id) as order_count,
       SUM(o.total_amount) as total_spent
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
GROUP BY u.id
ORDER BY order_count DESC
LIMIT 10;

-- ============================================
-- ORDER QUERIES
-- ============================================

-- Get all orders with details
SELECT o.*, 
       u.full_name as customer_name,
       u.email as customer_email,
       u.phone as customer_phone,
       r.name as restaurant_name,
       CONCAT(a.street, ', ', a.area, ', ', a.city) as delivery_address
FROM orders o
JOIN users u ON o.user_id = u.id
JOIN restaurants r ON o.restaurant_id = r.id
LEFT JOIN user_addresses a ON o.delivery_address_id = a.id
ORDER BY o.created_at DESC;

-- Get pending orders
SELECT o.order_number, u.full_name, r.name as restaurant, 
       o.total_amount, o.created_at
FROM orders o
JOIN users u ON o.user_id = o.user_id
JOIN restaurants r ON o.restaurant_id = r.id
WHERE o.order_status = 'pending'
ORDER BY o.created_at DESC;

-- Get order with items
SELECT o.order_number, o.total_amount, o.order_status,
       oi.quantity, 
       COALESCE(mi.name, JSON_UNQUOTE(JSON_EXTRACT(oi.customizations, '$.item_name'))) as item_name,
       oi.unit_price, oi.total_price
FROM orders o
JOIN order_items oi ON o.id = oi.order_id
LEFT JOIN menu_items mi ON oi.menu_item_id = mi.id
WHERE o.id = ?;

-- Orders by date range
SELECT DATE(created_at) as order_date,
       COUNT(*) as total_orders,
       SUM(total_amount) as total_revenue
FROM orders
WHERE created_at BETWEEN '2025-01-01' AND '2025-12-31'
GROUP BY DATE(created_at)
ORDER BY order_date DESC;

-- ============================================
-- RESTAURANT QUERIES
-- ============================================

-- Get restaurant with menu items
SELECT r.name as restaurant,
       mc.name as category,
       mi.name as item,
       mi.price,
       mi.is_available
FROM restaurants r
JOIN menu_items mi ON r.id = mi.restaurant_id
JOIN menu_categories mc ON mi.menu_category_id = mc.id
WHERE r.id = ?
ORDER BY mc.name, mi.name;

-- Top rated restaurants
SELECT r.name, r.rating, r.total_reviews, r.total_orders,
       r.delivery_time_min, r.delivery_time_max
FROM restaurants r
WHERE r.is_active = 1
ORDER BY r.rating DESC, r.total_reviews DESC
LIMIT 10;

-- Popular menu items across all restaurants
SELECT mi.name, r.name as restaurant,
       mi.price, mi.sold_count, mi.rating
FROM menu_items mi
JOIN restaurants r ON mi.restaurant_id = r.id
WHERE mi.is_available = 1
ORDER BY mi.sold_count DESC
LIMIT 20;

-- ============================================
-- REVENUE & ANALYTICS QUERIES
-- ============================================

-- Daily revenue
SELECT DATE(created_at) as date,
       COUNT(*) as orders,
       SUM(subtotal) as subtotal,
       SUM(delivery_fee) as delivery_fees,
       SUM(total_amount) as total_revenue
FROM orders
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY DATE(created_at)
ORDER BY date DESC;

-- Revenue by restaurant
SELECT r.name,
       COUNT(o.id) as total_orders,
       SUM(o.subtotal) as restaurant_revenue,
       SUM(o.delivery_fee) as delivery_revenue,
       SUM(o.total_amount) as total_revenue
FROM restaurants r
LEFT JOIN orders o ON r.id = o.restaurant_id
GROUP BY r.id
ORDER BY total_revenue DESC;

-- Payment method distribution
SELECT payment_method,
       COUNT(*) as order_count,
       SUM(total_amount) as revenue,
       AVG(total_amount) as avg_order_value
FROM orders
GROUP BY payment_method;

-- ============================================
-- REVIEW QUERIES
-- ============================================

-- Recent reviews
SELECT rev.rating, rev.comment, rev.created_at,
       u.full_name as customer,
       r.name as restaurant
FROM reviews rev
JOIN users u ON rev.user_id = u.id
JOIN restaurants r ON rev.restaurant_id = r.id
ORDER BY rev.created_at DESC
LIMIT 20;

-- Average ratings by restaurant
SELECT r.name,
       COUNT(rev.id) as review_count,
       AVG(rev.rating) as avg_rating,
       AVG(rev.food_rating) as avg_food_rating,
       AVG(rev.delivery_rating) as avg_delivery_rating
FROM restaurants r
LEFT JOIN reviews rev ON r.id = rev.restaurant_id
GROUP BY r.id
HAVING review_count > 0
ORDER BY avg_rating DESC;

-- ============================================
-- MAINTENANCE QUERIES
-- ============================================

-- Update restaurant rating (run after new review)
UPDATE restaurants r
SET rating = (
    SELECT AVG(rating) 
    FROM reviews 
    WHERE restaurant_id = r.id
),
total_reviews = (
    SELECT COUNT(*) 
    FROM reviews 
    WHERE restaurant_id = r.id
)
WHERE r.id = ?;

-- Update menu item rating
UPDATE menu_items mi
SET rating = (
    SELECT AVG(rating) 
    FROM menu_item_reviews 
    WHERE menu_item_id = mi.id
)
WHERE mi.id = ?;

-- Clean up old cart data (older than 7 days)
DELETE FROM carts
WHERE updated_at < DATE_SUB(NOW(), INTERVAL 7 DAY);

-- Update user stats
UPDATE users u
SET total_orders = (
    SELECT COUNT(*) FROM orders WHERE user_id = u.id
),
total_spent = (
    SELECT COALESCE(SUM(total_amount), 0) FROM orders WHERE user_id = u.id
)
WHERE u.id = ?;

-- ============================================
-- SEARCH QUERIES
-- ============================================

-- Search restaurants by name or cuisine
SELECT r.name, r.cuisine_types, r.rating, r.delivery_time_min
FROM restaurants r
WHERE r.is_active = 1
  AND (r.name LIKE CONCAT('%', ?, '%')
   OR r.cuisine_types LIKE CONCAT('%', ?, '%'))
ORDER BY r.rating DESC;

-- Search menu items
SELECT mi.name as item, r.name as restaurant,
       mi.price, mi.description
FROM menu_items mi
JOIN restaurants r ON mi.restaurant_id = r.id
WHERE mi.is_available = 1
  AND (mi.name LIKE CONCAT('%', ?, '%')
   OR mi.description LIKE CONCAT('%', ?, '%'))
ORDER BY mi.sold_count DESC;

-- ============================================
-- REPORTING QUERIES
-- ============================================

-- Order status summary
SELECT order_status,
       COUNT(*) as count,
       SUM(total_amount) as revenue
FROM orders
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY order_status;

-- Hourly order distribution
SELECT HOUR(created_at) as hour,
       COUNT(*) as order_count,
       AVG(total_amount) as avg_order_value
FROM orders
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
GROUP BY HOUR(created_at)
ORDER BY hour;

-- Most ordered items this month
SELECT COALESCE(mi.name, JSON_UNQUOTE(JSON_EXTRACT(oi.customizations, '$.item_name'))) as item_name,
       SUM(oi.quantity) as total_quantity,
       SUM(oi.total_price) as total_revenue
FROM order_items oi
LEFT JOIN menu_items mi ON oi.menu_item_id = mi.id
JOIN orders o ON oi.order_id = o.id
WHERE o.created_at >= DATE_FORMAT(NOW(), '%Y-%m-01')
GROUP BY item_name
ORDER BY total_quantity DESC
LIMIT 20;

-- ============================================
-- CUSTOMER BEHAVIOR QUERIES
-- ============================================

-- Customer order frequency
SELECT u.full_name, u.email,
       COUNT(o.id) as total_orders,
       MIN(o.created_at) as first_order,
       MAX(o.created_at) as last_order,
       DATEDIFF(MAX(o.created_at), MIN(o.created_at)) as customer_lifetime_days,
       AVG(o.total_amount) as avg_order_value
FROM users u
JOIN orders o ON u.id = o.user_id
GROUP BY u.id
HAVING total_orders >= 2
ORDER BY total_orders DESC;

-- Repeat vs new customers (this month)
SELECT 
    CASE 
        WHEN previous_orders = 0 THEN 'New Customer'
        ELSE 'Repeat Customer'
    END as customer_type,
    COUNT(*) as order_count,
    SUM(total_amount) as revenue
FROM (
    SELECT o.id, o.total_amount,
           (SELECT COUNT(*) FROM orders o2 
            WHERE o2.user_id = o.user_id 
            AND o2.created_at < o.created_at) as previous_orders
    FROM orders o
    WHERE o.created_at >= DATE_FORMAT(NOW(), '%Y-%m-01')
) as customer_orders
GROUP BY customer_type;

-- Customer lifetime value ranking
SELECT u.full_name, u.email,
       COUNT(o.id) as total_orders,
       SUM(o.total_amount) as lifetime_value,
       AVG(o.total_amount) as avg_order,
       DATEDIFF(NOW(), u.created_at) as days_as_customer
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
GROUP BY u.id
ORDER BY lifetime_value DESC
LIMIT 50;

-- Abandoned carts (users with items but no recent orders)
SELECT u.full_name, u.email, c.items, c.updated_at as cart_updated
FROM users u
JOIN carts c ON u.id = c.user_id
WHERE NOT EXISTS (
    SELECT 1 FROM orders o 
    WHERE o.user_id = u.id 
    AND o.created_at > c.updated_at
)
AND c.updated_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
ORDER BY c.updated_at DESC;

-- ============================================
-- DELIVERY & LOGISTICS QUERIES
-- ============================================

-- Orders by delivery status
SELECT order_status,
       COUNT(*) as count,
       AVG(TIMESTAMPDIFF(MINUTE, created_at, COALESCE(actual_delivery_time, NOW()))) as avg_delivery_minutes
FROM orders
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
GROUP BY order_status
ORDER BY count DESC;

-- Late deliveries (exceeded estimated time)
SELECT o.order_number, r.name as restaurant,
       o.created_at, o.estimated_delivery, o.actual_delivery_time,
       TIMESTAMPDIFF(MINUTE, o.estimated_delivery, o.actual_delivery_time) as minutes_late
FROM orders o
JOIN restaurants r ON o.restaurant_id = r.id
WHERE o.actual_delivery_time > o.estimated_delivery
  AND o.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
ORDER BY minutes_late DESC;

-- Delivery performance by restaurant
SELECT r.name,
       COUNT(o.id) as total_deliveries,
       AVG(TIMESTAMPDIFF(MINUTE, o.created_at, o.actual_delivery_time)) as avg_delivery_time,
       SUM(CASE WHEN o.actual_delivery_time <= o.estimated_delivery THEN 1 ELSE 0 END) as on_time_count,
       ROUND(SUM(CASE WHEN o.actual_delivery_time <= o.estimated_delivery THEN 1 ELSE 0 END) * 100.0 / COUNT(o.id), 2) as on_time_percentage
FROM restaurants r
JOIN orders o ON r.id = o.restaurant_id
WHERE o.actual_delivery_time IS NOT NULL
  AND o.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY r.id
ORDER BY on_time_percentage DESC;

-- Peak delivery hours
SELECT HOUR(created_at) as hour,
       COUNT(*) as order_count,
       AVG(total_amount) as avg_value
FROM orders
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
GROUP BY HOUR(created_at)
ORDER BY order_count DESC;

-- Orders by area/location
SELECT a.area, a.city,
       COUNT(o.id) as total_orders,
       SUM(o.total_amount) as total_revenue,
       AVG(o.total_amount) as avg_order_value
FROM orders o
JOIN user_addresses a ON o.delivery_address_id = a.id
WHERE o.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY a.area, a.city
ORDER BY total_orders DESC;

-- ============================================
-- RESTAURANT PERFORMANCE QUERIES
-- ============================================

-- Restaurant revenue comparison
SELECT r.name,
       COUNT(o.id) as orders_this_month,
       SUM(o.subtotal) as revenue_this_month,
       (SELECT COUNT(*) FROM orders o2 
        WHERE o2.restaurant_id = r.id 
        AND o2.created_at >= DATE_SUB(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH)
        AND o2.created_at < DATE_FORMAT(NOW(), '%Y-%m-01')) as orders_last_month,
       (SELECT SUM(o2.subtotal) FROM orders o2 
        WHERE o2.restaurant_id = r.id 
        AND o2.created_at >= DATE_SUB(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH)
        AND o2.created_at < DATE_FORMAT(NOW(), '%Y-%m-01')) as revenue_last_month
FROM restaurants r
LEFT JOIN orders o ON r.id = o.restaurant_id 
    AND o.created_at >= DATE_FORMAT(NOW(), '%Y-%m-01')
GROUP BY r.id
ORDER BY revenue_this_month DESC;

-- Menu item performance by restaurant
SELECT r.name as restaurant,
       mi.name as item,
       COUNT(oi.id) as times_ordered,
       SUM(oi.quantity) as total_quantity,
       SUM(oi.total_price) as total_revenue,
       AVG(oi.unit_price) as avg_price
FROM restaurants r
JOIN menu_items mi ON r.id = mi.restaurant_id
LEFT JOIN order_items oi ON mi.id = oi.menu_item_id
JOIN orders o ON oi.order_id = o.id
WHERE o.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY r.id, mi.id
ORDER BY total_revenue DESC
LIMIT 50;

-- Slow selling items (available but rarely ordered)
SELECT r.name as restaurant,
       mi.name as item,
       mi.price,
       mi.sold_count,
       mi.created_at
FROM menu_items mi
JOIN restaurants r ON mi.restaurant_id = r.id
WHERE mi.is_available = 1
  AND mi.sold_count < 5
  AND mi.created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)
ORDER BY mi.sold_count ASC, mi.created_at ASC;

-- Restaurant availability and uptime
SELECT r.name,
       r.is_open,
       r.opening_time,
       r.closing_time,
       COUNT(o.id) as total_orders,
       MAX(o.created_at) as last_order_time
FROM restaurants r
LEFT JOIN orders o ON r.id = o.restaurant_id 
    AND o.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
GROUP BY r.id
ORDER BY total_orders DESC;

-- ============================================
-- PROMOTION & DISCOUNT QUERIES
-- ============================================

-- Discount usage and impact
SELECT d.code,
       d.description,
       d.discount_type,
       d.discount_value,
       COUNT(o.id) as times_used,
       SUM(o.discount) as total_discount_given,
       SUM(o.total_amount) as total_revenue_with_discount
FROM deals d
LEFT JOIN orders o ON FIND_IN_SET(d.id, o.applied_deals)
WHERE d.is_active = 1
GROUP BY d.id
ORDER BY times_used DESC;

-- Orders with vs without discounts
SELECT 
    CASE WHEN o.discount > 0 THEN 'With Discount' ELSE 'No Discount' END as discount_status,
    COUNT(*) as order_count,
    AVG(o.subtotal) as avg_subtotal,
    AVG(o.total_amount) as avg_total,
    SUM(o.total_amount) as total_revenue
FROM orders o
WHERE o.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY discount_status;

-- Most effective promotional periods
SELECT DATE(o.created_at) as date,
       COUNT(*) as total_orders,
       SUM(CASE WHEN o.discount > 0 THEN 1 ELSE 0 END) as discounted_orders,
       SUM(o.discount) as total_discount,
       SUM(o.total_amount) as total_revenue
FROM orders o
WHERE o.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY DATE(o.created_at)
ORDER BY total_orders DESC;

-- ============================================
-- LOYALTY & REFERRAL QUERIES
-- ============================================

-- Loyalty points distribution
SELECT 
    CASE 
        WHEN loyalty_points = 0 THEN '0 points'
        WHEN loyalty_points < 100 THEN '1-99 points'
        WHEN loyalty_points < 500 THEN '100-499 points'
        WHEN loyalty_points < 1000 THEN '500-999 points'
        ELSE '1000+ points'
    END as points_range,
    COUNT(*) as user_count,
    AVG(total_orders) as avg_orders
FROM users
GROUP BY points_range
ORDER BY points_range;

-- Referral program effectiveness
SELECT u.full_name as referrer,
       u.referral_code,
       COUNT(referred.id) as total_referrals,
       SUM(referred.total_orders) as referred_orders,
       SUM(referred.total_spent) as referred_revenue
FROM users u
LEFT JOIN users referred ON u.id = referred.referred_by
GROUP BY u.id
HAVING total_referrals > 0
ORDER BY total_referrals DESC;

-- Active loyalty members
SELECT lt.name as tier,
       COUNT(u.id) as member_count,
       AVG(u.loyalty_points) as avg_points,
       AVG(u.total_spent) as avg_lifetime_value
FROM users u
LEFT JOIN loyalty_tiers lt ON u.loyalty_points BETWEEN lt.min_points AND COALESCE(lt.max_points, 999999)
GROUP BY lt.id
ORDER BY lt.min_points;

-- ============================================
-- PAYMENT & FINANCIAL QUERIES
-- ============================================

-- Payment method trends
SELECT DATE(created_at) as date,
       payment_method,
       COUNT(*) as transactions,
       SUM(total_amount) as revenue
FROM orders
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY DATE(created_at), payment_method
ORDER BY date DESC, revenue DESC;

-- Failed/cancelled order analysis
SELECT r.name as restaurant,
       COUNT(o.id) as cancelled_orders,
       SUM(o.total_amount) as lost_revenue,
       AVG(o.total_amount) as avg_cancelled_value
FROM orders o
JOIN restaurants r ON o.restaurant_id = r.id
WHERE o.order_status = 'cancelled'
  AND o.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY r.id
ORDER BY cancelled_orders DESC;

-- Revenue breakdown by category
SELECT mc.name as category,
       COUNT(DISTINCT oi.order_id) as orders,
       SUM(oi.quantity) as items_sold,
       SUM(oi.total_price) as category_revenue
FROM menu_categories mc
JOIN menu_items mi ON mc.id = mi.menu_category_id
JOIN order_items oi ON mi.id = oi.menu_item_id
JOIN orders o ON oi.order_id = o.id
WHERE o.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY mc.id
ORDER BY category_revenue DESC;

-- Average order value trends
SELECT DATE(created_at) as date,
       COUNT(*) as orders,
       AVG(subtotal) as avg_subtotal,
       AVG(delivery_fee) as avg_delivery,
       AVG(total_amount) as avg_total,
       MIN(total_amount) as min_order,
       MAX(total_amount) as max_order
FROM orders
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY DATE(created_at)
ORDER BY date DESC;

-- ============================================
-- INVENTORY & MENU QUERIES
-- ============================================

-- Out of stock items
SELECT r.name as restaurant,
       mi.name as item,
       mi.price,
       mi.sold_count,
       mi.updated_at
FROM menu_items mi
JOIN restaurants r ON mi.restaurant_id = r.id
WHERE mi.is_available = 0
ORDER BY mi.sold_count DESC;

-- Price analysis by category
SELECT mc.name as category,
       COUNT(mi.id) as item_count,
       MIN(mi.price) as min_price,
       AVG(mi.price) as avg_price,
       MAX(mi.price) as max_price
FROM menu_categories mc
JOIN menu_items mi ON mc.id = mi.menu_category_id
WHERE mi.is_available = 1
GROUP BY mc.id
ORDER BY avg_price DESC;

-- Vegetarian/Vegan options availability
SELECT r.name as restaurant,
       COUNT(CASE WHEN mi.is_vegetarian = 1 THEN 1 END) as vegetarian_items,
       COUNT(CASE WHEN mi.is_vegan = 1 THEN 1 END) as vegan_items,
       COUNT(*) as total_items,
       ROUND(COUNT(CASE WHEN mi.is_vegetarian = 1 THEN 1 END) * 100.0 / COUNT(*), 2) as veg_percentage
FROM restaurants r
JOIN menu_items mi ON r.id = mi.restaurant_id
WHERE mi.is_available = 1
GROUP BY r.id
ORDER BY veg_percentage DESC;

-- ============================================
-- DATA QUALITY & CLEANUP QUERIES
-- ============================================

-- Find duplicate users by email
SELECT email, COUNT(*) as count
FROM users
GROUP BY email
HAVING count > 1;

-- Orders without items (data integrity check)
SELECT o.id, o.order_number, o.created_at
FROM orders o
LEFT JOIN order_items oi ON o.id = oi.order_id
WHERE oi.id IS NULL;

-- Users without orders (never purchased)
SELECT u.id, u.full_name, u.email, u.created_at,
       DATEDIFF(NOW(), u.created_at) as days_registered
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
WHERE o.id IS NULL
  AND u.created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)
ORDER BY u.created_at ASC;

-- Inactive restaurants (no orders in 30 days)
SELECT r.name, r.is_active, r.rating,
       MAX(o.created_at) as last_order,
       DATEDIFF(NOW(), MAX(o.created_at)) as days_since_last_order
FROM restaurants r
LEFT JOIN orders o ON r.id = o.restaurant_id
GROUP BY r.id
HAVING last_order < DATE_SUB(NOW(), INTERVAL 30 DAY) 
   OR last_order IS NULL
ORDER BY days_since_last_order DESC;
