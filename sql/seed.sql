-- ============================================
-- SwiftServe - Optimized Seed Data
-- ============================================

USE swiftserve;

-- ============================================
-- 1. USERS
-- ============================================

INSERT INTO users (email, password_hash, full_name, phone, loyalty_points, total_orders, total_spent) VALUES
('admin@gmail.com', '$2y$12$LQv3c1yycXGNw8kQmXfVqeqvyw8KvF7rVYiB4vB5wfYVNvPp7UBRC', 'Admin', '01721346909', 1000, 0, 0),
('ishtiaque@nsu.edu', '$2y$12$LQv3c1yycXGNw8kQmXfVqeqvyw8KvF7rVYiB4vB5wfYVNvPp7UBRC', 'Ishtiaque Ahmed', '01712345678', 500, 2, 660);

-- ============================================
-- 2. RESTAURANTS
-- ============================================

INSERT INTO restaurants (name, cuisine, description, image, rating, total_reviews, delivery_time, min_order_amount, is_open, is_featured) VALUES
('Kacchi Bhai', 'Biryani', 'Famous for authentic Kacchi Biryani', 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=500&h=400&fit=crop', 4.7, 5000, '30-45 min', 250, TRUE, TRUE),
('Haji Biriyani', 'Biryani', 'Legendary Old Dhaka biryani since 1939', 'https://images.unsplash.com/photo-1642821373181-696a54913e93?w=500&h=400&fit=crop', 4.6, 5000, '35-50 min', 200, TRUE, TRUE),
('Kasturi Restaurant', 'Bengali', 'Traditional Bengali cuisine', 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=500&h=400&fit=crop', 4.8, 5000, '25-40 min', 300, TRUE, FALSE),
('Takeout Dhaka', 'Fast Food', 'Burgers, fries and American fast food', 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&h=400&fit=crop', 4.5, 5000, '20-35 min', 150, TRUE, FALSE),
('Spice & Rice', 'Chinese', 'Thai and Chinese fusion', 'https://images.unsplash.com/photo-1525755662778-989d0524087e?w=500&h=400&fit=crop', 4.7, 5000, '30-45 min', 280, TRUE, FALSE),
('Khana''s', 'Indian', 'North Indian cuisine and tandoor', 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=500&h=400&fit=crop', 4.6, 5000, '25-40 min', 250, TRUE, FALSE),
('Coopers Chocolate House', 'Desserts', 'Premium desserts and chocolates', 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=500&h=400&fit=crop', 4.8, 5000, '15-30 min', 120, TRUE, FALSE),
('Burger King', 'Fast Food', 'Popular local burger joint', 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=500&h=400&fit=crop', 4.5, 5000, '20-35 min', 200, TRUE, FALSE);

-- ============================================
-- 3. MENU CATEGORIES
-- ============================================

INSERT INTO menu_categories (restaurant_id, name, display_order) VALUES
(1, 'Biryani', 1),
(1, 'Kebabs', 2),
(1, 'Beverages', 3),
(2, 'Biryani', 1),
(2, 'Special Items', 2),
(4, 'Burgers', 1),
(4, 'Sides', 2),
(4, 'Beverages', 3);

-- ============================================
-- 4. MENU ITEMS
-- ============================================

INSERT INTO menu_items (restaurant_id, menu_category_id, name, description, image, price, is_vegetarian, is_popular, is_available) VALUES
-- Kacchi Bhai
(1, 1, 'Kacchi Biryani', 'Traditional Dhaka style kacchi biryani with tender mutton', 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400', 350, FALSE, TRUE, TRUE),
(1, 1, 'Chicken Biryani', 'Flavorful chicken biryani with aromatic basmati rice', 'https://images.unsplash.com/photo-1642821373181-696a54913e93?w=400', 280, FALSE, TRUE, TRUE),
(1, 2, 'Beef Shish Kebab', 'Grilled beef kebab with special spices', 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=400', 250, FALSE, FALSE, TRUE),
(1, 3, 'Borhani', 'Traditional yogurt-based drink', NULL, 50, TRUE, FALSE, TRUE),

-- Haji Biriyani
(2, 4, 'Mutton Biryani', 'Legendary Haji biryani with premium mutton', 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400', 380, FALSE, TRUE, TRUE),
(2, 4, 'Chicken Roast', 'Special chicken roast with biryani', 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=400', 150, FALSE, TRUE, TRUE),

-- Takeout Dhaka
(4, 6, 'Classic Cheeseburger', 'Juicy beef patty with cheese, lettuce, tomato', 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400', 450, FALSE, TRUE, TRUE),
(4, 6, 'Chicken Burger', 'Crispy fried chicken with special sauce', 'https://images.unsplash.com/photo-1606755962773-d324e0a13086?w=400', 400, FALSE, TRUE, TRUE),
(4, 7, 'French Fries', 'Crispy golden fries', 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400', 150, TRUE, FALSE, TRUE),
(4, 8, 'Coca Cola', 'Chilled soft drink', NULL, 80, TRUE, FALSE, TRUE);

-- ============================================
-- 5. SAMPLE ORDERS (for testing)
-- ============================================

INSERT INTO orders (order_number, user_id, restaurant_id, delivery_address_id, subtotal, delivery_fee, total_amount, payment_method, payment_status, order_status, created_at) VALUES
('SWS93403662', 2, 1, NULL, 280, 50, 330, 'cash', 'pending', 'pending', NOW()),
('SWS91860227', 2, 1, NULL, 350, 30, 380, 'cash', 'pending', 'pending', NOW());

INSERT INTO order_items (order_id, menu_item_id, item_name, quantity, unit_price, total_price, customizations) VALUES
(1, 2, 'Chicken Biryani', 1, 280, 280, NULL),
(2, 1, 'Kacchi Biryani', 1, 350, 350, NULL);

-- ============================================
-- END OF SEED DATA
-- ============================================
