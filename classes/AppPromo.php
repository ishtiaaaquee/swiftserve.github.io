<?php
/**
 * AppPromo Section
 * Promotes mobile app download
 */
class AppPromo {
    private $title;
    private $subtitle;
    private $features;
    
    public function __construct() {
        $this->title = 'Get the SwiftServe App';
        $this->subtitle = 'Download our mobile app for the best food delivery experience';
        $this->features = [
            'Faster checkout',
            'Exclusive app-only deals',
            'Real-time order tracking',
            'Easy reordering',
            'Save your favorite restaurants'
        ];
    }
    
    public function render() {
        ?>
        <section id="app-promo" class="py-5 section-padding bg-light-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                        <p class="lead"><?php echo htmlspecialchars($this->subtitle); ?></p>
                        <ul class="app-features-list">
                            <?php foreach ($this->features as $feature): ?>
                            <li><i class="fas fa-check-circle text-success me-2"></i><?php echo htmlspecialchars($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="app-download-buttons mt-4">
                            <a href="#" class="app-btn">
                                <i class="fab fa-apple fa-2x"></i>
                                <div>
                                    <small>Download on the</small>
                                    <strong>App Store</strong>
                                </div>
                            </a>
                            <a href="#" class="app-btn">
                                <i class="fab fa-google-play fa-2x"></i>
                                <div>
                                    <small>Get it on</small>
                                    <strong>Google Play</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="app-mockup">
                            <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=500&h=600&fit=crop" 
                                 alt="App Screenshot" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
