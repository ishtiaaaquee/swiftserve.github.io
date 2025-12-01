<?php
/**
 * Hero Class
 * Manages hero section content and statistics
 */
class Hero {
    private $title;
    private $subtitle;
    private $stats;
    private $buttons;
    
    public function __construct() {
        $this->title = 'Welcome to the <span class="gradient-text">Future</span>';
        $this->subtitle = 'Experience lightning-fast service with cutting-edge technology and elegant design';
        $this->stats = [
            ['value' => 10000, 'label' => 'Happy Clients'],
            ['value' => 500, 'label' => 'Projects Done'],
            ['value' => 50, 'label' => 'Awards Won']
        ];
        $this->buttons = [
            ['text' => 'Get Started', 'icon' => 'rocket', 'class' => 'btn-primary pulse-btn'],
            ['text' => 'Watch Demo', 'icon' => 'play-circle', 'class' => 'btn-outline-light', 'modal' => 'videoModal']
        ];
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }
    
    public function addStat($value, $label) {
        $this->stats[] = ['value' => $value, 'label' => $label];
    }
    
    public function render() {
        ?>
        <section id="home" class="hero-section">
            <div class="hero-background">
                <div class="gradient-overlay"></div>
                <div class="particles" id="particles"></div>
            </div>
            <div class="container">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                        <h1 class="hero-title"><?php echo $this->title; ?></h1>
                        <p class="hero-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                        <div class="hero-buttons">
                            <?php foreach ($this->buttons as $index => $button): ?>
                            <button class="btn <?php echo $button['class']; ?> btn-lg <?php echo $index > 0 ? 'ms-0 ms-md-3 mt-2 mt-md-0' : ''; ?>"
                                    <?php echo isset($button['modal']) ? 'data-bs-toggle="modal" data-bs-target="#' . $button['modal'] . '"' : ''; ?>>
                                <i class="fas fa-<?php echo $button['icon']; ?> me-2"></i><?php echo $button['text']; ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                        <div class="hero-stats mt-5">
                            <?php foreach ($this->stats as $index => $stat): ?>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                                <h3 class="counter" data-target="<?php echo $stat['value']; ?>">0</h3>
                                <p><?php echo htmlspecialchars($stat['label']); ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                        <?php $this->renderFloatingCards(); ?>
                    </div>
                </div>
            </div>
            <div class="scroll-indicator">
                <a href="#features">
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
        </section>
        <?php
    }
    
    private function renderFloatingCards() {
        $cards = [
            ['icon' => 'palette', 'color' => 'primary', 'text' => 'Beautiful Design', 'class' => 'card-1'],
            ['icon' => 'code', 'color' => 'success', 'text' => 'Clean Code', 'class' => 'card-2'],
            ['icon' => 'rocket', 'color' => 'warning', 'text' => 'Fast Performance', 'class' => 'card-3']
        ];
        ?>
        <div class="hero-image-container">
            <?php foreach ($cards as $card): ?>
            <div class="floating-card <?php echo $card['class']; ?>">
                <i class="fas fa-<?php echo $card['icon']; ?> fa-2x text-<?php echo $card['color']; ?>"></i>
                <p class="mb-0 mt-2"><?php echo $card['text']; ?></p>
            </div>
            <?php endforeach; ?>
            <div class="hero-main-image">
                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=600&fit=crop" alt="Hero" class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>
        <?php
    }
}
