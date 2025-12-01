<?php
/**
 * MenuItem Class
 * Represents a menu item
 */
class MenuItem {
    private $id;
    private $name;
    private $description;
    private $price;
    private $image;
    private $category;
    private $isVegetarian;
    private $isPopular;
    
    public function __construct($id, $name, $description, $price, $image, $category = 'Main', $isVegetarian = false, $isPopular = false) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->category = $category;
        $this->isVegetarian = $isVegetarian;
        $this->isPopular = $isPopular;
    }
    
    public function render() {
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="menu-item-card">
                <div class="menu-item-image">
                    <img src="<?php echo htmlspecialchars($this->image); ?>" alt="<?php echo htmlspecialchars($this->name); ?>">
                    <?php if ($this->isPopular): ?>
                    <span class="popular-badge"><i class="fas fa-fire"></i> Popular</span>
                    <?php endif; ?>
                    <?php if ($this->isVegetarian): ?>
                    <span class="veg-badge"><i class="fas fa-leaf"></i></span>
                    <?php endif; ?>
                </div>
                <div class="menu-item-content">
                    <h5><?php echo htmlspecialchars($this->name); ?></h5>
                    <p class="text-muted small"><?php echo htmlspecialchars($this->description); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="price">$<?php echo number_format($this->price, 2); ?></span>
                        <button class="btn btn-primary btn-sm add-to-cart" 
                                data-id="<?php echo $this->id; ?>"
                                data-name="<?php echo htmlspecialchars($this->name); ?>"
                                data-price="<?php echo $this->price; ?>">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * PopularDishes Section
 * Shows popular menu items
 */
class PopularDishes {
    private $title;
    private $subtitle;
    private $dishes;
    
    public function __construct() {
        $this->title = 'Popular Dishes';
        $this->subtitle = 'Most loved items by our customers';
        $this->dishes = [
            new MenuItem(1, "Classic Cheeseburger", "Juicy beef patty with cheese, lettuce, tomato", 12.99, "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=300&fit=crop", "Burgers", false, true),
            new MenuItem(2, "California Roll", "Fresh salmon, avocado, cucumber", 14.99, "https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=400&h=300&fit=crop", "Sushi", false, true),
            new MenuItem(3, "Margherita Pizza", "Fresh mozzarella, basil, tomato sauce", 16.99, "https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=400&h=300&fit=crop", "Pizza", true, true),
            new MenuItem(4, "Pad Thai", "Stir-fried rice noodles with shrimp", 13.99, "https://images.unsplash.com/photo-1559314809-0d155014e29e?w=400&h=300&fit=crop", "Asian", false, true),
            new MenuItem(5, "BBQ Ribs", "Slow-cooked pork ribs with BBQ sauce", 18.99, "https://images.unsplash.com/photo-1544025162-d76694265947?w=400&h=300&fit=crop", "American", false, true),
            new MenuItem(6, "Chicken Tacos", "Grilled chicken, salsa, guacamole", 11.99, "https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400&h=300&fit=crop", "Mexican", false, true)
        ];
    }
    
    public function addDish(MenuItem $dish) {
        $this->dishes[] = $dish;
    }
    
    public function render() {
        ?>
        <section id="popular-dishes" class="py-5 section-padding bg-light-section">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                <div class="row g-4">
                    <?php 
                    foreach ($this->dishes as $dish) {
                        $dish->render();
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
