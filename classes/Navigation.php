<?php
/**
 * Navigation Class
 * Manages navigation menu and items
 */
class Navigation {
    private $brand;
    private $menuItems;
    private $showThemeToggle;
    
    public function __construct($brand = 'SwiftServe', $showThemeToggle = true) {
        $this->brand = $brand;
        $this->showThemeToggle = $showThemeToggle;
        $this->menuItems = [
            ['name' => 'Home', 'link' => '#home', 'active' => true],
            ['name' => 'How It Works', 'link' => '#how-it-works', 'active' => false],
            ['name' => 'Restaurants', 'link' => '#restaurants', 'active' => false],
            ['name' => 'Popular Dishes', 'link' => '#popular-dishes', 'active' => false],
            ['name' => 'Get the App', 'link' => '#app', 'active' => false],
            ['name' => 'Contact', 'link' => '#contact', 'active' => false],
        ];
    }
    
    public function addMenuItem($name, $link, $active = false) {
        $this->menuItems[] = ['name' => $name, 'link' => $link, 'active' => $active];
    }
    
    public function render() {
        ?>
        <nav class="navbar navbar-expand-lg fixed-top glass-nav" id="mainNav">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#" data-aos="fade-right">
                    <i class="fas fa-bolt text-primary"></i> <?php echo htmlspecialchars($this->brand); ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <?php foreach ($this->menuItems as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $item['active'] ? 'active' : ''; ?>" 
                               href="<?php echo htmlspecialchars($item['link']); ?>">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                        <?php if ($this->showThemeToggle): ?>
                        <li class="nav-item ms-3">
                            <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                                <i class="fas fa-moon"></i>
                            </button>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
    }
}
