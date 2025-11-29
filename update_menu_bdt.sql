-- Update products to BDT currency and modern menu items
-- Inspired by Chillox, Smashed Burgers, MadChef

USE food_delivery_db;

-- Clear existing products
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE products;
SET FOREIGN_KEY_CHECKS = 1;

-- Insert Burgers (400 BDT to 1500 BDT range)
INSERT INTO products (name, description, price, category, image, is_available) VALUES
('Classic Smash Burger', 'Double smashed beef patties, American cheese, pickles, onions, special sauce on a brioche bun', 450.00, 'Burgers', 'burger1.jpg', 1),
('Cheese Blast Burger', 'Juicy beef patty loaded with melted cheddar, mozzarella & American cheese, lettuce, tomato', 550.00, 'Burgers', 'burger2.jpg', 1),
('BBQ Bacon Burger', 'Grilled beef patty, crispy bacon, BBQ sauce, onion rings, cheddar cheese', 650.00, 'Burgers', 'burger3.jpg', 1),
('Mushroom Swiss Burger', 'Premium beef patty, sautéed mushrooms, Swiss cheese, truffle mayo', 720.00, 'Burgers', 'burger4.jpg', 1),
('Spicy Jalapeño Burger', 'Fire-grilled patty, jalapeños, pepper jack cheese, chipotle sauce, crispy onions', 680.00, 'Burgers', 'burger5.jpg', 1),
('Double Trouble Burger', 'Two massive beef patties, double cheese, bacon, egg, special sauce', 950.00, 'Burgers', 'burger6.jpg', 1),
('Chicken Smash Burger', 'Crispy smashed chicken breast, coleslaw, spicy mayo, pickles', 480.00, 'Burgers', 'burger7.jpg', 1),
('Beef & Bacon Deluxe', 'Premium angus beef, crispy bacon strips, caramelized onions, BBQ glaze', 780.00, 'Burgers', 'burger8.jpg', 1),
('Monster Burger', 'Triple patty beast with bacon, cheese, onion rings, loaded with toppings', 1200.00, 'Burgers', 'burger9.jpg', 1),
('Wagyu Premium Burger', 'Wagyu beef patty, truffle aioli, arugula, aged cheddar, gourmet bun', 1500.00, 'Burgers', 'burger10.jpg', 1);

-- Pizza (500 BDT to 1400 BDT)
INSERT INTO products (name, description, price, category, image, is_available) VALUES
('Margherita Classic', 'Fresh mozzarella, San Marzano tomatoes, basil, extra virgin olive oil', 550.00, 'Pizza', 'pizza1.jpg', 1),
('Pepperoni Blast', 'Loaded with pepperoni, mozzarella, marinara sauce', 680.00, 'Pizza', 'pizza2.jpg', 1),
('BBQ Chicken Pizza', 'Grilled chicken, BBQ sauce, red onions, cilantro, mozzarella', 750.00, 'Pizza', 'pizza3.jpg', 1),
('Meat Lovers', 'Pepperoni, beef, bacon, sausage, ham, mozzarella', 950.00, 'Pizza', 'pizza4.jpg', 1),
('Veggie Supreme', 'Bell peppers, mushrooms, olives, onions, tomatoes, corn', 620.00, 'Pizza', 'pizza5.jpg', 1),
('Four Cheese', 'Mozzarella, cheddar, parmesan, blue cheese, white sauce', 820.00, 'Pizza', 'pizza6.jpg', 1),
('Spicy Tikka Pizza', 'Chicken tikka, onions, peppers, spicy sauce, cheese', 780.00, 'Pizza', 'pizza7.jpg', 1),
('Seafood Special', 'Shrimp, calamari, fish, garlic butter, herbs', 1100.00, 'Pizza', 'pizza8.jpg', 1),
('Truffle Mushroom', 'Wild mushrooms, truffle oil, parmesan, arugula', 1250.00, 'Pizza', 'pizza9.jpg', 1),
('The MadChef Special', 'Chef\'s secret blend of premium toppings, signature sauce', 1400.00, 'Pizza', 'pizza10.jpg', 1);

-- Pasta (400 BDT to 950 BDT)
INSERT INTO products (name, description, price, category, image, is_available) VALUES
('Classic Carbonara', 'Creamy egg sauce, bacon, parmesan, black pepper', 520.00, 'Pasta', 'pasta1.jpg', 1),
('Spaghetti Bolognese', 'Rich meat sauce, parmesan, fresh herbs', 480.00, 'Pasta', 'pasta2.jpg', 1),
('Chicken Alfredo', 'Creamy alfredo sauce, grilled chicken, fettuccine', 650.00, 'Pasta', 'pasta3.jpg', 1),
('Spicy Arrabiata', 'Spicy tomato sauce, garlic, red chili, penne', 450.00, 'Pasta', 'pasta4.jpg', 1),
('Seafood Pasta', 'Mixed seafood, white wine garlic sauce, linguine', 850.00, 'Pasta', 'pasta5.jpg', 1),
('Pesto Chicken Pasta', 'Basil pesto, grilled chicken, cherry tomatoes, pine nuts', 680.00, 'Pasta', 'pasta6.jpg', 1),
('Mac & Cheese Supreme', 'Three cheese blend, crispy bacon topping', 550.00, 'Pasta', 'pasta7.jpg', 1),
('Lasagna Deluxe', 'Layered pasta, beef ragù, béchamel, mozzarella', 720.00, 'Pasta', 'pasta8.jpg', 1),
('Truffle Mushroom Pasta', 'Creamy truffle sauce, assorted mushrooms, parmesan', 950.00, 'Pasta', 'pasta9.jpg', 1);

-- Appetizers (250 BDT to 650 BDT)
INSERT INTO products (name, description, price, category, image, is_available) VALUES
('Crispy Chicken Wings', '8 pieces with choice of sauce: BBQ, Buffalo, or Honey Mustard', 420.00, 'Appetizers', 'wings1.jpg', 1),
('Loaded Nachos', 'Tortilla chips, cheese sauce, jalapeños, sour cream, salsa', 480.00, 'Appetizers', 'nachos1.jpg', 1),
('Mozzarella Sticks', '6 pieces with marinara dipping sauce', 380.00, 'Appetizers', 'mozz1.jpg', 1),
('French Fries', 'Crispy golden fries with ketchup', 250.00, 'Appetizers', 'fries1.jpg', 1),
('Onion Rings', 'Beer-battered crispy onion rings', 320.00, 'Appetizers', 'onion1.jpg', 1),
('Garlic Bread', '4 slices with butter and herbs', 280.00, 'Appetizers', 'garlic1.jpg', 1),
('Chicken Nuggets', '10 pieces with honey mustard sauce', 350.00, 'Appetizers', 'nuggets1.jpg', 1),
('Cheese Quesadilla', 'Grilled tortilla with melted cheese, served with salsa', 420.00, 'Appetizers', 'quesadilla1.jpg', 1),
('Loaded Fries', 'Fries topped with cheese, bacon, jalapeños, ranch', 450.00, 'Appetizers', 'loaded-fries1.jpg', 1),
('Platter Supreme', 'Wings, mozzarella sticks, onion rings, fries combo', 650.00, 'Appetizers', 'platter1.jpg', 1);

-- Beverages (80 BDT to 350 BDT)
INSERT INTO products (name, description, price, category, image, is_available) VALUES
('Coca Cola', 'Chilled 330ml can', 80.00, 'Beverages', 'coke1.jpg', 1),
('Sprite', 'Lemon-lime refreshment 330ml', 80.00, 'Beverages', 'sprite1.jpg', 1),
('Fresh Orange Juice', 'Freshly squeezed orange juice', 180.00, 'Beverages', 'orange1.jpg', 1),
('Mango Smoothie', 'Fresh mango blended with yogurt', 220.00, 'Beverages', 'mango1.jpg', 1),
('Chocolate Milkshake', 'Rich chocolate milkshake topped with whipped cream', 250.00, 'Beverages', 'choco-shake1.jpg', 1),
('Iced Coffee', 'Cold brew coffee with ice and milk', 200.00, 'Beverages', 'iced-coffee1.jpg', 1),
('Lemonade', 'Homemade fresh lemonade with mint', 150.00, 'Beverages', 'lemonade1.jpg', 1),
('Strawberry Shake', 'Fresh strawberry blended with ice cream', 280.00, 'Beverages', 'strawberry1.jpg', 1),
('Green Tea', 'Premium Japanese green tea', 120.00, 'Beverages', 'greentea1.jpg', 1),
('Special Mojito', 'Virgin mojito with fresh mint and lime', 350.00, 'Beverages', 'mojito1.jpg', 1);

-- Desserts (200 BDT to 550 BDT)
INSERT INTO products (name, description, price, category, image, is_available) VALUES
('Chocolate Lava Cake', 'Warm chocolate cake with molten center, vanilla ice cream', 380.00, 'Desserts', 'lava1.jpg', 1),
('New York Cheesecake', 'Classic creamy cheesecake with berry compote', 420.00, 'Desserts', 'cheesecake1.jpg', 1),
('Tiramisu', 'Italian coffee-flavored dessert with mascarpone', 450.00, 'Desserts', 'tiramisu1.jpg', 1),
('Brownie Sundae', 'Warm brownie with vanilla ice cream, chocolate sauce', 350.00, 'Desserts', 'brownie1.jpg', 1),
('Apple Pie', 'Classic apple pie with cinnamon, served warm', 320.00, 'Desserts', 'apple-pie1.jpg', 1),
('Ice Cream Sundae', 'Three scoops with toppings and sauces', 300.00, 'Desserts', 'sundae1.jpg', 1),
('Churros', '6 pieces with chocolate dipping sauce', 280.00, 'Desserts', 'churros1.jpg', 1),
('Nutella Pancakes', 'Fluffy pancakes loaded with Nutella and strawberries', 400.00, 'Desserts', 'pancakes1.jpg', 1),
('Oreo Cheesecake', 'Cheesecake loaded with Oreo cookies', 480.00, 'Desserts', 'oreo-cake1.jpg', 1),
('Molten Caramel Cake', 'Premium caramel cake with salted caramel ice cream', 550.00, 'Desserts', 'caramel1.jpg', 1);
