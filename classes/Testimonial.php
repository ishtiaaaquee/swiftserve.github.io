<?php
/**
 * Testimonial Class
 * Represents a single testimonial
 */
class Testimonial {
    private $name;
    private $position;
    private $company;
    private $text;
    private $rating;
    private $avatar;
    
    public function __construct($name, $position, $company, $text, $rating = 5, $avatar = null) {
        $this->name = $name;
        $this->position = $position;
        $this->company = $company;
        $this->text = $text;
        $this->rating = $rating;
        $this->avatar = $avatar;
    }
    
    public function render($delay = 0) {
        ?>
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="testimonial-card">
                <div class="stars mb-3">
                    <?php for ($i = 0; $i < $this->rating; $i++): ?>
                    <i class="fas fa-star"></i>
                    <?php endfor; ?>
                </div>
                <p class="testimonial-text">"<?php echo htmlspecialchars($this->text); ?>"</p>
                <div class="testimonial-author">
                    <img src="<?php echo htmlspecialchars($this->avatar); ?>" alt="<?php echo htmlspecialchars($this->name); ?>" class="author-image">
                    <div>
                        <h5 class="mb-0"><?php echo htmlspecialchars($this->name); ?></h5>
                        <small class="text-muted"><?php echo htmlspecialchars($this->position); ?>, <?php echo htmlspecialchars($this->company); ?></small>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * Testimonials Section Class
 * Manages collection of testimonials
 */
class TestimonialsSection {
    private $title;
    private $subtitle;
    private $testimonials;
    
    public function __construct() {
        $this->title = 'What Clients Say';
        $this->subtitle = "Don't just take our word for it";
        $this->testimonials = [
            new Testimonial('Ishtiaque Ahmed', 'Student', 'North South University', 'Amazing service! Ordered kacchi biryani and it arrived hot within 30 minutes. The food quality was excellent and delivery guy was very polite. Highly recommended!', 5, 'https://i.pravatar.cc/100?img=12'),
            new Testimonial('Nafis Adnan', 'Graduate Student', 'MIT', 'Best food delivery app in Dhaka! I use it almost daily for lunch. Great variety of restaurants and the live tracking feature is really helpful. Customer support is also very responsive.', 5, 'https://i.pravatar.cc/100?img=33'),
            new Testimonial('Noman Sakib', 'MBA Student', 'Harvard Business School', 'SwiftServe has become my go-to app for office lunch orders. Fast delivery, affordable prices, and authentic Bengali food. The loyalty points system is a great bonus!', 5, 'https://i.pravatar.cc/100?img=51')
        ];
    }
    
    public function addTestimonial(Testimonial $testimonial) {
        $this->testimonials[] = $testimonial;
    }
    
    public function render() {
        ?>
        <section id="testimonials" class="py-5 section-padding bg-light-section">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                <div class="row g-4">
                    <?php 
                    foreach ($this->testimonials as $index => $testimonial) {
                        $testimonial->render(($index + 1) * 100);
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
