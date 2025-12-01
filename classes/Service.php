<?php
/**
 * Service Class
 * Represents a single service
 */
class Service {
    private $title;
    private $description;
    private $icon;
    private $image;
    
    public function __construct($title, $description, $icon, $image) {
        $this->title = $title;
        $this->description = $description;
        $this->icon = $icon;
        $this->image = $image;
    }
    
    public function render($delay = 0) {
        ?>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="<?php echo $delay; ?>">
            <div class="service-card">
                <div class="service-image">
                    <img src="<?php echo htmlspecialchars($this->image); ?>" alt="<?php echo htmlspecialchars($this->title); ?>">
                    <div class="service-overlay">
                        <i class="fas fa-<?php echo htmlspecialchars($this->icon); ?> fa-3x"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h4><?php echo htmlspecialchars($this->title); ?></h4>
                    <p><?php echo htmlspecialchars($this->description); ?></p>
                    <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * Services Section Class
 * Manages collection of services
 */
class ServicesSection {
    private $title;
    private $subtitle;
    private $services;
    
    public function __construct() {
        $this->title = 'Our Services';
        $this->subtitle = 'Comprehensive solutions for your business needs';
        $this->services = [
            new Service('Web Development', 'Custom websites built with modern technologies', 'laptop-code', 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=300&fit=crop'),
            new Service('Mobile Apps', 'Native and cross-platform mobile solutions', 'mobile-alt', 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&h=300&fit=crop'),
            new Service('UI/UX Design', 'Beautiful and intuitive user experiences', 'pencil-ruler', 'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=400&h=300&fit=crop'),
            new Service('Digital Marketing', 'Grow your business with targeted campaigns', 'chart-line', 'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?w=400&h=300&fit=crop')
        ];
    }
    
    public function addService(Service $service) {
        $this->services[] = $service;
    }
    
    public function render() {
        ?>
        <section id="services" class="py-5 section-padding bg-light-section">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                <div class="row g-4">
                    <?php 
                    foreach ($this->services as $index => $service) {
                        $service->render(($index + 1) * 100);
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
