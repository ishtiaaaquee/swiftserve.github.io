<?php
/**
 * HowItWorks Section
 * Shows the delivery process
 */
class HowItWorks {
    private $title;
    private $subtitle;
    private $steps;
    
    public function __construct() {
        $this->title = 'How It Works';
        $this->subtitle = 'Get your favorite food delivered in 3 easy steps';
        $this->steps = [
            [
                'icon' => 'map-marker-alt',
                'title' => 'Choose Location',
                'description' => 'Enter your delivery address and browse restaurants near you',
                'color' => 'primary'
            ],
            [
                'icon' => 'shopping-cart',
                'title' => 'Select & Order',
                'description' => 'Browse menus, add items to cart, and place your order',
                'color' => 'success'
            ],
            [
                'icon' => 'shipping-fast',
                'title' => 'Fast Delivery',
                'description' => 'Sit back and relax while we deliver your food hot and fresh',
                'color' => 'warning'
            ]
        ];
    }
    
    public function render() {
        ?>
        <section id="how-it-works" class="py-5 section-padding">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title"><?php echo htmlspecialchars($this->title); ?></h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($this->subtitle); ?></p>
                </div>
                <div class="row g-4 align-items-center">
                    <?php foreach ($this->steps as $index => $step): ?>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <div class="how-it-works-card text-center">
                            <div class="step-number"><?php echo $index + 1; ?></div>
                            <div class="step-icon bg-<?php echo $step['color']; ?>">
                                <i class="fas fa-<?php echo $step['icon']; ?>"></i>
                            </div>
                            <h4 class="mt-3"><?php echo htmlspecialchars($step['title']); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($step['description']); ?></p>
                        </div>
                    </div>
                    <?php if ($index < count($this->steps) - 1): ?>
                    <div class="col-md-1 d-none d-md-block text-center">
                        <i class="fas fa-arrow-right fa-2x text-primary"></i>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
