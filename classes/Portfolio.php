<?php
/**
 * Portfolio Item Class
 * Represents a single portfolio item
 */
class PortfolioItem {
    private $title;
    private $category;
    private $description;
    private $image;
    
    public function __construct($title, $category, $description, $image) {
        $this->title = $title;
        $this->category = $category;
        $this->description = $description;
        $this->image = $image;
    }
    
    public function getCategory() {
        return $this->category;
    }
    
    public function render($delay = 0) {
        ?>
        <div class="col-md-6 col-lg-4 portfolio-item" data-category="<?php echo htmlspecialchars($this->category); ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="portfolio-card">
                <img src="<?php echo htmlspecialchars($this->image); ?>" alt="<?php echo htmlspecialchars($this->title); ?>">
                <div class="portfolio-overlay">
                    <h4><?php echo htmlspecialchars($this->title); ?></h4>
                    <p><?php echo htmlspecialchars($this->description); ?></p>
                    <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                        <i class="fas fa-eye"></i> View Details
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * Portfolio Section Class
 * Manages portfolio items and filtering
 */
class PortfolioSection {
    private $title;
    private $subtitle;
    private $items;
    private $categories;
    
    public function __construct() {
        $this->title = 'Our Portfolio';
        $this->subtitle = 'Check out our latest projects and success stories';
        $this->categories = ['all' => 'All', 'web' => 'Web', 'mobile' => 'Mobile', 'design' => 'Design'];
        $this->items = [
            new PortfolioItem('E-Commerce Platform', 'web', 'Web Development', 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=500&h=400&fit=crop'),
            new PortfolioItem('Fitness Tracking App', 'mobile', 'Mobile Development', 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=500&h=400&fit=crop'),
            new PortfolioItem('Brand Identity Design', 'design', 'UI/UX Design', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&h=400&fit=crop'),
            new PortfolioItem('Business Dashboard', 'web', 'Web Application', 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=500&h=400&fit=crop'),
            new PortfolioItem('Food Delivery App', 'mobile', 'Mobile Platform', 'https://images.unsplash.com/photo-1512428559087-560fa5ceab42?w=500&h=400&fit=crop'),
            new PortfolioItem('Landing Page Design', 'design', 'Creative Design', 'https://images.unsplash.com/photo-1542744094-3a31f272c490?w=500&h=400&fit=crop')
        ];
    }
    
    public function addItem(PortfolioItem $item) {
        $this->items[] = $item;
    }
    
    public function render() {
        ?>
        <section id="portfolio" class="py-5 section-padding">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                <div class="portfolio-filter text-center mb-4" data-aos="fade-up">
                    <?php foreach ($this->categories as $key => $label): ?>
                    <button class="filter-btn <?php echo $key === 'all' ? 'active' : ''; ?>" data-filter="<?php echo $key; ?>">
                        <?php echo htmlspecialchars($label); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
                <div class="row g-4" id="portfolioGrid">
                    <?php 
                    foreach ($this->items as $index => $item) {
                        $item->render($index % 3 * 100);
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
