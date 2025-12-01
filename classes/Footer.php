<?php
/**
 * Footer Class
 * Manages footer content and links
 */
class Footer {
    private $brand;
    private $description;
    private $quickLinks;
    private $services;
    private $contactInfo;
    private $socialLinks;
    
    public function __construct() {
        $this->brand = 'SwiftServe';
        $this->description = 'Your favorite food delivered fresh and fast. Order from the best restaurants in your area with just a few clicks.';
        $this->quickLinks = [
            ['text' => 'Home', 'url' => '#home'],
            ['text' => 'Restaurants', 'url' => '#restaurants'],
            ['text' => 'Popular Dishes', 'url' => '#popular-dishes'],
            ['text' => 'How It Works', 'url' => '#how-it-works']
        ];
        $this->services = [
            ['text' => 'Food Delivery', 'url' => '#'],
            ['text' => 'Partner Restaurants', 'url' => '#'],
            ['text' => 'Delivery Driver', 'url' => '#'],
            ['text' => 'Corporate Catering', 'url' => '#']
        ];
        $this->contactInfo = [
            ['icon' => 'map-marker-alt', 'text' => 'Serving 50+ Cities Nationwide'],
            ['icon' => 'phone', 'text' => '1-800-FOOD-NOW'],
            ['icon' => 'envelope', 'text' => 'support@swiftserve.com']
        ];
        $this->socialLinks = [
            ['icon' => 'facebook-f', 'url' => '#'],
            ['icon' => 'twitter', 'url' => '#'],
            ['icon' => 'instagram', 'url' => '#'],
            ['icon' => 'linkedin-in', 'url' => '#']
        ];
    }
    
    public function render() {
        ?>
        <section class="newsletter-section">
            <div class="container">
                <div class="row align-items-center" data-aos="fade-up">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h3 class="mb-2">🍕 Get Exclusive Deals!</h3>
                        <p class="mb-0">Subscribe to receive special offers and new restaurant updates</p>
                    </div>
                    <div class="col-lg-6">
                        <form id="newsletterForm" class="newsletter-form">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Enter your email" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <h5 class="footer-title">
                            <i class="fas fa-bolt text-primary"></i> <?php echo htmlspecialchars($this->brand); ?>
                        </h5>
                        <p><?php echo htmlspecialchars($this->description); ?></p>
                        <div class="social-links mt-3">
                            <?php foreach ($this->socialLinks as $link): ?>
                            <a href="<?php echo htmlspecialchars($link['url']); ?>" class="social-link">
                                <i class="fab fa-<?php echo htmlspecialchars($link['icon']); ?>"></i>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h5 class="footer-title">Quick Links</h5>
                        <ul class="footer-links">
                            <?php foreach ($this->quickLinks as $link): ?>
                            <li><a href="<?php echo htmlspecialchars($link['url']); ?>"><?php echo htmlspecialchars($link['text']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h5 class="footer-title">Services</h5>
                        <ul class="footer-links">
                            <?php foreach ($this->services as $link): ?>
                            <li><a href="<?php echo htmlspecialchars($link['url']); ?>"><?php echo htmlspecialchars($link['text']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="footer-title">Contact Us</h5>
                        <ul class="footer-contact">
                            <?php foreach ($this->contactInfo as $info): ?>
                            <li><i class="fas fa-<?php echo htmlspecialchars($info['icon']); ?>"></i> <?php echo htmlspecialchars($info['text']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($this->brand); ?>. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="#" class="footer-link me-3">Privacy Policy</a>
                        <a href="#" class="footer-link me-3">Terms of Service</a>
                        <a href="#" class="footer-link">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </footer>

        <button id="backToTop" class="back-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>
        <?php
    }
}
