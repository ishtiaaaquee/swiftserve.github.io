<?php
/**
 * Contact Section Class
 * Manages contact information and form
 */
class ContactSection {
    private $title;
    private $subtitle;
    private $address;
    private $phone;
    private $email;
    private $socialLinks;
    
    public function __construct() {
        $this->title = 'Get In Touch';
        $this->subtitle = "Have questions? We're here to help!";
        $this->address = 'Banani, Dhaka 1213, Bangladesh';
        $this->phone = '+880 1721-346909';
        $this->email = 'support@swiftserve.bd';
        $this->socialLinks = [
            ['icon' => 'facebook-f', 'url' => '#'],
            ['icon' => 'twitter', 'url' => '#'],
            ['icon' => 'instagram', 'url' => '#'],
            ['icon' => 'linkedin-in', 'url' => '#'],
            ['icon' => 'github', 'url' => '#']
        ];
    }
    
    public function setContactInfo($address, $phone, $email) {
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
    }
    
    public function render() {
        ?>
        <section id="contact" class="py-5 section-padding">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-5" data-aos="fade-right">
                        <?php $this->renderContactInfo(); ?>
                    </div>
                    <div class="col-lg-7" data-aos="fade-left">
                        <?php $this->renderContactForm(); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    
    private function renderContactInfo() {
        ?>
        <div class="contact-info">
            <h3 class="mb-4">Contact Information</h3>
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h5>Address</h5>
                    <p><?php echo htmlspecialchars($this->address); ?></p>
                </div>
            </div>
            <div class="info-item">
                <i class="fas fa-phone"></i>
                <div>
                    <h5>Phone</h5>
                    <p><?php echo htmlspecialchars($this->phone); ?></p>
                </div>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <h5>Email</h5>
                    <p><?php echo htmlspecialchars($this->email); ?></p>
                </div>
            </div>
            <div class="social-links mt-4">
                <?php foreach ($this->socialLinks as $link): ?>
                <a href="<?php echo htmlspecialchars($link['url']); ?>" class="social-link">
                    <i class="fab fa-<?php echo htmlspecialchars($link['icon']); ?>"></i>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
    
    private function renderContactForm() {
        ?>
        <form id="contactForm" class="contact-form">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                        <label for="name">Your Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                        <label for="email">Your Email</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="subject" placeholder="Subject" required>
                        <label for="subject">Subject</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" id="message" placeholder="Your Message" style="height: 150px" required></textarea>
                        <label for="message">Your Message</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-paper-plane me-2"></i>Send Message
                    </button>
                </div>
            </div>
        </form>
        <div id="formMessage" class="alert mt-3" style="display: none;"></div>
        <?php
    }
}
