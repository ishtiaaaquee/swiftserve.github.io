<?php
/**
 * Feature Class
 * Represents a single feature
 */
class Feature {
    private $icon;
    private $title;
    private $description;
    
    public function __construct($icon, $title, $description) {
        $this->icon = $icon;
        $this->title = $title;
        $this->description = $description;
    }
    
    public function render($delay = 0) {
        ?>
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-<?php echo htmlspecialchars($this->icon); ?>"></i>
                </div>
                <h3><?php echo htmlspecialchars($this->title); ?></h3>
                <p><?php echo htmlspecialchars($this->description); ?></p>
            </div>
        </div>
        <?php
    }
}

/**
 * Features Section Class
 * Manages collection of features
 */
class FeaturesSection {
    private $title;
    private $subtitle;
    private $features;
    
    public function __construct() {
        $this->title = 'Amazing Features';
        $this->subtitle = 'Everything you need to build something extraordinary';
        $this->features = [
            new Feature('mobile-alt', 'Responsive Design', 'Perfectly optimized for all devices, from mobile to desktop'),
            new Feature('tachometer-alt', 'Lightning Fast', 'Optimized performance for blazing fast load times'),
            new Feature('shield-alt', 'Secure & Safe', 'Built with security best practices and encryption'),
            new Feature('cogs', 'Easy Customization', 'Flexible and customizable to fit your needs'),
            new Feature('life-ring', '24/7 Support', 'Round-the-clock support to help you succeed'),
            new Feature('sync-alt', 'Regular Updates', 'Continuous improvements and new features')
        ];
    }
    
    public function addFeature(Feature $feature) {
        $this->features[] = $feature;
    }
    
    public function render() {
        ?>
        <section id="features" class="py-5 section-padding">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                <div class="row g-4">
                    <?php 
                    foreach ($this->features as $index => $feature) {
                        $feature->render(($index % 3 + 1) * 100);
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
