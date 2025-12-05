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
        <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="deal-card restaurant-card">
                <div class="deal-image-wrapper restaurant-image">
                    <img src="<?php echo htmlspecialchars($this->image); ?>" alt="<?php echo htmlspecialchars($this->name); ?>" class="deal-image">
                    <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                    <div class="restaurant-overlay">
                        <button class="btn btn-light btn-sm view-menu" data-restaurant-id="<?php echo $this->id; ?>">
                            <i class="fas fa-utensils me-2"></i>View Menu
                        </button>
                    </div>
                </div>
                <div class="deal-content restaurant-content">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <h5 class="deal-name mb-0"><?php echo htmlspecialchars($this->name); ?></h5>
                        <div class="deal-rating rating-badge">
                            <i class="fas fa-star"></i> 
                            <span><?php echo $this->rating; ?>(5000+)</span>
                        </div>
                    </div>
                    <p class="cuisine-type text-muted small mb-2"><i class="fas fa-utensils me-1"></i><?php echo htmlspecialchars($this->cuisine); ?></p>
                    <div class="deal-meta restaurant-info mb-2">
                        <span><i class="fas fa-clock me-1"></i><?php echo htmlspecialchars($this->deliveryTime); ?></span>
                        <span><i class="fas fa-bangladeshi-taka-sign me-1"></i>Min ৳<?php echo $this->minOrder; ?></span>
                    </div>
                    <button class="btn btn-sm btn-primary w-100 view-menu" data-restaurant-id="<?php echo $this->id; ?>" style="padding: 0.4rem; font-size: 0.85rem;">
                        <i class="fas fa-utensils me-1"></i>View Menu
                    </button>
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
        $this->categories = ['All', 'Biryani', 'Bengali', 'Fast Food', 'Chinese', 'Indian', 'Desserts'];
        $this->restaurants = [
            new Restaurant(1, "Kacchi Bhai", "Biryani", 4.7, "30-45 min", 250, "https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=500&h=400&fit=crop", "Famous for authentic Kacchi Biryani"),
            new Restaurant(2, "Haji Biriyani", "Biryani", 4.6, "35-50 min", 200, "https://images.unsplash.com/photo-1642821373181-696a54913e93?w=500&h=400&fit=crop", "Legendary Old Dhaka biryani since 1939"),
            new Restaurant(3, "Kasturi Restaurant", "Bengali", 4.8, "25-40 min", 300, "https://images.unsplash.com/photo-1601050690597-df0568f70950?w=500&h=400&fit=crop", "Traditional Bengali cuisine"),
            new Restaurant(4, "Takeout Dhaka", "Fast Food", 4.5, "20-35 min", 150, "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&h=400&fit=crop", "Burgers, fries and American fast food"),
            new Restaurant(5, "Spice & Rice", "Chinese", 4.7, "30-45 min", 280, "https://images.unsplash.com/photo-1525755662778-989d0524087e?w=500&h=400&fit=crop", "Thai and Chinese fusion"),
            new Restaurant(6, "Khana's", "Indian", 4.6, "25-40 min", 250, "https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=500&h=400&fit=crop", "North Indian cuisine and tandoor"),
            new Restaurant(7, "Coopers Chocolate House", "Desserts", 4.8, "15-30 min", 120, "https://images.unsplash.com/photo-1551024506-0bccd828d307?w=500&h=400&fit=crop", "Premium desserts and chocolates"),
            new Restaurant(8, "Chillox", "Fast Food", 4.5, "20-35 min", 200, "https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=500&h=400&fit=crop", "Popular local burger joint"),
            new Restaurant(9, "Star Kabab", "Bengali", 4.7, "25-40 min", 180, "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=500&h=400&fit=crop", "Grilled kebabs and BBQ specials")
        ];
    }
    
    public function addRestaurant(Restaurant $restaurant) {
        $this->restaurants[] = $restaurant;
    }
    
    public function render() {
        ?>
        <section id="restaurants" class="py-5 section-padding">
            <div class="container">
                <div class="mb-4" data-aos="fade-up">
                    <h2 class="section-title mb-1"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle text-muted"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                
                <div class="category-filter mb-4" data-aos="fade-up">
                    <?php foreach ($this->categories as $index => $category): ?>
                    <button class="filter-btn <?php echo $index === 0 ? 'active' : ''; ?>" data-category="<?php echo strtolower(str_replace(' ', '-', $category)); ?>">
                        <?php echo htmlspecialchars($category); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
                
                <div class="deals-scroll-container">
                    <div class="row g-3 flex-nowrap deals-row" id="restaurantsGrid">
                        <?php 
                        foreach ($this->restaurants as $index => $restaurant) {
                            $restaurant->render($index * 100);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
