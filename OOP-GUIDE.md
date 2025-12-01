# 🎯 SwiftServe - Object-Oriented Architecture

## 📐 Architecture Overview

This project now follows **Object-Oriented Programming (OOP)** principles with a clean, modular architecture that makes it easy to maintain, extend, and customize.

## 🏗️ Project Structure

```
swiftserve/
├── index.php                 # Main entry point (uses OOP classes)
├── classes/                  # OOP Classes directory
│   ├── Page.php             # Page metadata and rendering
│   ├── Navigation.php       # Navigation menu management
│   ├── Hero.php             # Hero section with stats
│   ├── Feature.php          # Features section
│   ├── Service.php          # Services section
│   ├── Portfolio.php        # Portfolio items and filtering
│   ├── Testimonial.php      # Client testimonials
│   ├── Contact.php          # Contact section and form
│   ├── Footer.php           # Footer with newsletter
│   └── Modal.php            # Modal windows manager
├── assets/
│   ├── css/
│   │   └── style.css        # All custom styles
│   └── js/
│       └── main.js          # Interactive JavaScript
└── README.md
```

## 🔧 Class Documentation

### 1. **Page Class**
Manages page metadata, theme, and core HTML structure.

```php
$page = new Page('Custom Title', 'Description', 'keywords');
$page->renderHead();    // Renders <head> section
$page->renderScripts(); // Renders closing scripts
```

**Methods:**
- `getTitle()` - Get page title
- `setTitle($title)` - Set page title
- `getTheme()` - Get current theme
- `renderHead()` - Render HTML head section
- `renderScripts()` - Render footer scripts

---

### 2. **Navigation Class**
Manages navigation menu and theme toggle.

```php
$nav = new Navigation('Brand Name', $showThemeToggle = true);
$nav->addMenuItem('About', '#about', false);
$nav->render();
```

**Methods:**
- `addMenuItem($name, $link, $active)` - Add custom menu item
- `render()` - Render navigation HTML

---

### 3. **Hero Class**
Manages hero section with animated stats.

```php
$hero = new Hero();
$hero->setTitle('Custom Title');
$hero->setSubtitle('Custom Subtitle');
$hero->addStat(1000, 'Custom Stat');
$hero->render();
```

**Methods:**
- `setTitle($title)` - Set hero title (supports HTML)
- `setSubtitle($subtitle)` - Set hero subtitle
- `addStat($value, $label)` - Add statistics counter
- `render()` - Render hero section

---

### 4. **Feature Class & FeaturesSection**
Individual features and collection management.

```php
// Create feature
$feature = new Feature('icon-name', 'Title', 'Description');

// Manage features section
$features = new FeaturesSection();
$features->addFeature(new Feature('star', 'New Feature', 'Description'));
$features->render();
```

**Feature Methods:**
- `render($delay)` - Render single feature with animation delay

**FeaturesSection Methods:**
- `addFeature(Feature $feature)` - Add new feature
- `render()` - Render all features

---

### 5. **Service Class & ServicesSection**
Service cards with images and overlays.

```php
$service = new Service(
    'Service Name',
    'Description',
    'icon-name',
    'image-url.jpg'
);

$services = new ServicesSection();
$services->addService($service);
$services->render();
```

**Methods:**
- `addService(Service $service)` - Add new service
- `render()` - Render services grid

---

### 6. **PortfolioItem & PortfolioSection**
Portfolio items with category filtering.

```php
$item = new PortfolioItem(
    'Project Name',
    'web', // Category: web, mobile, design
    'Description',
    'image-url.jpg'
);

$portfolio = new PortfolioSection();
$portfolio->addItem($item);
$portfolio->render();
```

**Methods:**
- `addItem(PortfolioItem $item)` - Add portfolio item
- `render()` - Render portfolio grid with filters

---

### 7. **Testimonial Class & TestimonialsSection**
Client testimonials with ratings.

```php
$testimonial = new Testimonial(
    'Client Name',
    'Position',
    'Company',
    'Testimonial text',
    5, // Rating (1-5)
    'avatar-url.jpg'
);

$testimonials = new TestimonialsSection();
$testimonials->addTestimonial($testimonial);
$testimonials->render();
```

**Methods:**
- `addTestimonial(Testimonial $testimonial)` - Add testimonial
- `render()` - Render testimonials grid

---

### 8. **ContactSection Class**
Contact information and form.

```php
$contact = new ContactSection();
$contact->setContactInfo(
    'Address',
    'Phone',
    'Email'
);
$contact->render();
```

**Methods:**
- `setContactInfo($address, $phone, $email)` - Update contact info
- `render()` - Render contact section with form

---

### 9. **Footer Class**
Footer with newsletter and links.

```php
$footer = new Footer();
$footer->render();
```

**Methods:**
- `render()` - Render footer and newsletter section

---

### 10. **Modal Class & ModalsManager**
Modal window management.

```php
$modal = new Modal(
    'modalId',
    'Modal Title',
    '<p>Modal content</p>',
    'lg' // Size: sm, lg, xl
);

$modals = new ModalsManager();
$modals->addModal($modal);
$modals->render();
```

**Methods:**
- `addModal(Modal $modal)` - Add custom modal
- `render()` - Render all modals

---

## 🎨 Customization Examples

### Example 1: Custom Hero Section
```php
$hero = new Hero();
$hero->setTitle('Welcome to <span class="gradient-text">My Company</span>');
$hero->setSubtitle('We build amazing things');
$hero->addStat(5000, 'Customers');
$hero->addStat(200, 'Projects');
$hero->render();
```

### Example 2: Add Custom Features
```php
$features = new FeaturesSection();
$features->addFeature(new Feature(
    'fire',
    'Hot Feature',
    'This is our hottest feature!'
));
$features->render();
```

### Example 3: Custom Service
```php
$services = new ServicesSection();
$services->addService(new Service(
    'Consulting',
    'Expert business consulting',
    'lightbulb',
    'https://example.com/consulting.jpg'
));
$services->render();
```

### Example 4: Add Portfolio Item
```php
$portfolio = new PortfolioSection();
$portfolio->addItem(new PortfolioItem(
    'My Project',
    'web',
    'Web Development',
    'https://example.com/project.jpg'
));
$portfolio->render();
```

### Example 5: Custom Modal
```php
$modals = new ModalsManager();
$modals->addModal(new Modal(
    'customModal',
    'Special Offer',
    '<h4>Get 50% Off!</h4><p>Limited time offer</p>',
    'md'
));
$modals->render();
```

---

## 🚀 Benefits of OOP Architecture

### ✅ **Maintainability**
- Each component is isolated in its own class
- Easy to locate and fix bugs
- Clear separation of concerns

### ✅ **Reusability**
- Classes can be reused across different pages
- No code duplication
- DRY (Don't Repeat Yourself) principle

### ✅ **Extensibility**
- Easy to extend classes with new functionality
- Inheritance support for specialized components
- Open/Closed principle

### ✅ **Testability**
- Each class can be tested independently
- Mock objects for unit testing
- Better code coverage

### ✅ **Scalability**
- Add new sections without touching existing code
- Multiple instances of same component
- Easy to add new features

---

## 🔄 Advanced Usage

### Creating Custom Sections

```php
<?php
class PricingSection {
    private $plans = [];
    
    public function addPlan($name, $price, $features) {
        $this->plans[] = [
            'name' => $name,
            'price' => $price,
            'features' => $features
        ];
    }
    
    public function render() {
        echo '<section id="pricing" class="py-5">';
        echo '<div class="container">';
        foreach ($this->plans as $plan) {
            // Render pricing cards
        }
        echo '</div>';
        echo '</section>';
    }
}

// Usage
$pricing = new PricingSection();
$pricing->addPlan('Basic', '$9/mo', ['Feature 1', 'Feature 2']);
$pricing->render();
```

### Extending Existing Classes

```php
<?php
class ExtendedHero extends Hero {
    public function addVideo($videoUrl) {
        // Add video background functionality
    }
    
    public function addCountdown($targetDate) {
        // Add countdown timer
    }
}

$hero = new ExtendedHero();
$hero->addVideo('video.mp4');
$hero->render();
```

---

## 📝 Auto-loading

The project uses **PSR-4 autoloading**:

```php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
```

All classes in the `classes/` directory are automatically loaded when needed.

---

## 🎯 Best Practices

1. **Single Responsibility**: Each class has one job
2. **Encapsulation**: Private properties with public methods
3. **Type Hinting**: Method parameters specify expected types
4. **Documentation**: Each class and method is documented
5. **Security**: All output is escaped with `htmlspecialchars()`
6. **Consistency**: Uniform naming and coding style

---

## 🔐 Security Features

- XSS Prevention with `htmlspecialchars()`
- CSRF protection ready
- Input validation in forms
- Secure rendering methods
- No direct HTML in classes

---

## 📚 Learning Resources

- [PHP OOP Documentation](https://www.php.net/manual/en/language.oop5.php)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [Design Patterns](https://refactoring.guru/design-patterns/php)

---

## 🎉 Getting Started

1. **View your OOP site:**
   ```
   http://localhost/swiftserve
   ```

2. **Customize content:**
   - Edit `index.php` to change content
   - Modify classes in `classes/` for behavior changes
   - Update `style.css` for styling

3. **Add new sections:**
   - Create new class in `classes/`
   - Instantiate in `index.php`
   - Call `render()` method

---

**Your project is now fully object-oriented! 🎊**
