<?php
/**
 * Restaurant Class
 * Represents a restaurant in the platform
 */
class Restaurant {
    private $id;
    private $name;
    private $cuisine;
    private $rating;
    private $deliveryTime;
    private $minOrder;
    private $image;
    private $description;
    private $isOpen;
    
    public function __construct($id, $name, $cuisine, $rating, $deliveryTime, $minOrder, $image, $description = '', $isOpen = true) {
        $this->id = $id;
        $this->name = $name;
        $this->cuisine = $cuisine;
        $this->rating = $rating;
        $this->deliveryTime = $deliveryTime;
        $this->minOrder = $minOrder;
        $this->image = $image;
        $this->description = $description;
        $this->isOpen = $isOpen;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function render($delay = 0) {
        $statusClass = $this->isOpen ? 'open' : 'closed';
        $statusText = $this->isOpen ? 'Open Now' : 'Closed';
        ?>
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="<?php echo htmlspecialchars($this->image); ?>" alt="<?php echo htmlspecialchars($this->name); ?>">
                    <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                    <div class="restaurant-overlay">
                        <button class="btn btn-light btn-sm view-menu" data-restaurant-id="<?php echo $this->id; ?>">
                            <i class="fas fa-utensils me-2"></i>View Menu
                        </button>
                    </div>
                </div>
                <div class="restaurant-content">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4><?php echo htmlspecialchars($this->name); ?></h4>
                            <p class="cuisine-type text-muted"><?php echo htmlspecialchars($this->cuisine); ?></p>
                        </div>
                        <div class="rating-badge">
                            <i class="fas fa-star"></i> <?php echo $this->rating; ?>
                        </div>
                    </div>
                    <div class="restaurant-info">
                        <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($this->deliveryTime); ?></span>
                        <span><i class="fas fa-dollar-sign"></i> Min $<?php echo $this->minOrder; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * Restaurants Section Class
 * Manages collection of restaurants
 */
class RestaurantsSection {
    private $title;
    private $subtitle;
    private $restaurants;
    private $categories;
    
    public function __construct() {
        $this->title = 'Popular Restaurants';
        $this->subtitle = 'Discover amazing food from local restaurants';
        $this->categories = ['All', 'Fast Food', 'Asian', 'Italian', 'Mexican', 'American', 'Desserts'];
        $this->restaurants = [
            new Restaurant(1, "Burger Palace", "Fast Food", 4.8, "20-30 min", 10, "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&h=400&fit=crop", "Juicy burgers and crispy fries"),
            new Restaurant(2, "Sushi Master", "Asian", 4.9, "30-40 min", 15, "https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=500&h=400&fit=crop", "Fresh sushi and authentic Japanese cuisine"),
            new Restaurant(3, "Pizza Heaven", "Italian", 4.7, "25-35 min", 12, "https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500&h=400&fit=crop", "Wood-fired pizzas and pasta"),
            new Restaurant(4, "Taco Fiesta", "Mexican", 4.6, "15-25 min", 8, "https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=500&h=400&fit=crop", "Authentic Mexican street food"),
            new Restaurant(5, "The Grill House", "American", 4.8, "30-40 min", 15, "https://images.unsplash.com/photo-1544025162-d76694265947?w=500&h=400&fit=crop", "Premium steaks and BBQ"),
            new Restaurant(6, "Sweet Treats", "Desserts", 4.9, "15-20 min", 5, "https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=500&h=400&fit=crop", "Cakes, pastries, and ice cream")
        ];
    }
    
    public function addRestaurant(Restaurant $restaurant) {
        $this->restaurants[] = $restaurant;
    }
    
    public function render() {
        ?>
        <section id="restaurants" class="py-5 section-padding">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                
                <div class="category-filter text-center mb-4" data-aos="fade-up">
                    <?php foreach ($this->categories as $index => $category): ?>
                    <button class="filter-btn <?php echo $index === 0 ? 'active' : ''; ?>" data-category="<?php echo strtolower(str_replace(' ', '-', $category)); ?>">
                        <?php echo htmlspecialchars($category); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
                
                <div class="row g-4" id="restaurantsGrid">
                    <?php 
                    foreach ($this->restaurants as $index => $restaurant) {
                        $restaurant->render($index * 100);
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
