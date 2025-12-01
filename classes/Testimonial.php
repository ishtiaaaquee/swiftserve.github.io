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
            new Testimonial('John Smith', 'CEO', 'TechCorp', 'Outstanding work! The team delivered exactly what we needed, on time and within budget. Highly recommended!', 5, 'https://i.pravatar.cc/100?img=1'),
            new Testimonial('Sarah Johnson', 'Founder', 'StartupHub', 'Incredible attention to detail and amazing customer service. They went above and beyond our expectations!', 5, 'https://i.pravatar.cc/100?img=5'),
            new Testimonial('Michael Chen', 'Director', 'InnovateCo', 'Best investment we\'ve made for our business. The results speak for themselves. Thank you!', 5, 'https://i.pravatar.cc/100?img=3')
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
