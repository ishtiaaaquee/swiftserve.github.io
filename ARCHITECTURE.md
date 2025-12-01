# 🏗️ SwiftServe Architecture Diagram

## System Architecture

```
┌─────────────────────────────────────────────────────────┐
│                      index.php                          │
│                   (Main Entry Point)                     │
└────────────────────┬────────────────────────────────────┘
                     │
                     │ Autoloader loads classes
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│                   classes/ Directory                     │
│                                                          │
│  ┌──────────┐  ┌──────────────┐  ┌─────────────┐      │
│  │  Page    │  │  Navigation  │  │    Hero     │      │
│  └──────────┘  └──────────────┘  └─────────────┘      │
│                                                          │
│  ┌──────────┐  ┌──────────────┐  ┌─────────────┐      │
│  │ Feature  │  │   Service    │  │  Portfolio  │      │
│  └──────────┘  └──────────────┘  └─────────────┘      │
│                                                          │
│  ┌──────────┐  ┌──────────────┐  ┌─────────────┐      │
│  │Testimonial│ │   Contact    │  │   Footer    │      │
│  └──────────┘  └──────────────┘  └─────────────┘      │
│                                                          │
│  ┌──────────┐                                           │
│  │  Modal   │                                           │
│  └──────────┘                                           │
└─────────────────────────────────────────────────────────┘
                     │
                     │ Renders HTML
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│                    Client Browser                        │
│                                                          │
│  ┌────────────────────────────────────────────────┐    │
│  │              HTML Document                      │    │
│  │                                                 │    │
│  │  • Navigation (Fixed)                           │    │
│  │  • Hero Section (Animated)                      │    │
│  │  • Features Grid (6 cards)                      │    │
│  │  • Services Grid (4 cards)                      │    │
│  │  • Portfolio Grid (Filterable)                  │    │
│  │  • Testimonials (3 cards)                       │    │
│  │  • Contact Form                                 │    │
│  │  • Newsletter                                   │    │
│  │  • Footer                                       │    │
│  │  • Modals (Video, Portfolio)                    │    │
│  └────────────────────────────────────────────────┘    │
│                                                          │
│  ┌────────────────────────────────────────────────┐    │
│  │         Assets (CSS/JS)                         │    │
│  │  • style.css (Custom styling)                   │    │
│  │  • main.js (Interactivity)                      │    │
│  │  • Bootstrap 5.3                                │    │
│  │  • Tailwind CSS                                 │    │
│  │  • Font Awesome 6.4                             │    │
│  │  • AOS Animations                               │    │
│  └────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────┘
```

---

## Class Relationships

```
Page
 │
 ├─ renderHead() ─────► Loads CSS libraries
 │
 └─ renderScripts() ──► Loads JS libraries


Navigation
 │
 ├─ menuItems[] ──► Array of menu items
 │
 └─ render() ──────► Outputs navigation HTML


Hero
 │
 ├─ title
 ├─ subtitle
 ├─ stats[] ───────► Array of statistics
 │
 └─ render() ──────► Hero section with floating cards


FeaturesSection
 │
 ├─ features[] ────► Array of Feature objects
 │   │
 │   └─ Feature
 │       ├─ icon
 │       ├─ title
 │       └─ description
 │
 └─ render() ──────► Features grid


ServicesSection
 │
 ├─ services[] ────► Array of Service objects
 │   │
 │   └─ Service
 │       ├─ title
 │       ├─ description
 │       ├─ icon
 │       └─ image
 │
 └─ render() ──────► Services grid


PortfolioSection
 │
 ├─ items[] ───────► Array of PortfolioItem objects
 │   │
 │   └─ PortfolioItem
 │       ├─ title
 │       ├─ category (web/mobile/design)
 │       ├─ description
 │       └─ image
 │
 └─ render() ──────► Portfolio grid with filters


TestimonialsSection
 │
 ├─ testimonials[] ► Array of Testimonial objects
 │   │
 │   └─ Testimonial
 │       ├─ name
 │       ├─ position
 │       ├─ company
 │       ├─ text
 │       ├─ rating
 │       └─ avatar
 │
 └─ render() ──────► Testimonials grid


ContactSection
 │
 ├─ contactInfo
 ├─ socialLinks[]
 │
 └─ render() ──────► Contact info + form


Footer
 │
 ├─ quickLinks[]
 ├─ services[]
 ├─ contactInfo[]
 ├─ socialLinks[]
 │
 └─ render() ──────► Newsletter + Footer


ModalsManager
 │
 ├─ modals[] ──────► Array of Modal objects
 │   │
 │   └─ Modal
 │       ├─ id
 │       ├─ title
 │       ├─ content
 │       └─ size
 │
 └─ render() ──────► All modals
```

---

## Request Flow

```
1. User Request
   │
   ▼
2. index.php loads
   │
   ▼
3. Autoloader initializes
   │
   ▼
4. Classes instantiated
   ├─ Page
   ├─ Navigation
   ├─ Hero
   ├─ Features
   ├─ Services
   ├─ Portfolio
   ├─ Testimonials
   ├─ Contact
   ├─ Footer
   └─ Modals
   │
   ▼
5. HTML structure begins
   │
   ▼
6. Each component renders
   ├─ renderHead() → <head> section
   ├─ Navigation → <nav>
   ├─ Hero → <section id="home">
   ├─ Features → <section id="features">
   ├─ Services → <section id="services">
   ├─ Portfolio → <section id="portfolio">
   ├─ Testimonials → <section id="testimonials">
   ├─ Contact → <section id="contact">
   ├─ Footer → <footer> + newsletter
   ├─ Modals → Modal dialogs
   └─ renderScripts() → Scripts
   │
   ▼
7. HTML sent to browser
   │
   ▼
8. Browser loads assets
   ├─ CSS files
   └─ JS files
   │
   ▼
9. JavaScript initializes
   ├─ Dark mode
   ├─ Smooth scroll
   ├─ Animations (AOS)
   ├─ Counters
   ├─ Portfolio filter
   ├─ Form validation
   └─ Back to top
   │
   ▼
10. Page fully interactive
```

---

## Data Flow Example: Adding a Feature

```
Developer Code:
┌─────────────────────────────────────┐
│ $features = new FeaturesSection();  │
│ $features->addFeature(              │
│     new Feature(                    │
│         'star',                     │
│         'New Feature',              │
│         'Description'               │
│     )                               │
│ );                                  │
│ $features->render();                │
└─────────────────────────────────────┘
              │
              ▼
┌─────────────────────────────────────┐
│   FeaturesSection Object            │
│   features[] = [                    │
│       Feature {                     │
│           icon: 'star'              │
│           title: 'New Feature'      │
│           description: 'Desc...'    │
│       }                             │
│   ]                                 │
└─────────────────────────────────────┘
              │
              ▼ render() called
              │
┌─────────────────────────────────────┐
│   HTML Output:                      │
│   <div class="feature-card">        │
│       <i class="fas fa-star">       │
│       <h3>New Feature</h3>          │
│       <p>Description</p>            │
│   </div>                            │
└─────────────────────────────────────┘
              │
              ▼
┌─────────────────────────────────────┐
│   Browser Displays:                 │
│   ┌───────────────┐                │
│   │    ★          │                │
│   │ New Feature   │                │
│   │ Description   │                │
│   └───────────────┘                │
└─────────────────────────────────────┘
```

---

## File Structure Tree

```
swiftserve/
│
├── 📄 index.php                    # Main page (uses all classes)
├── 📄 example-custom-page.php      # Example custom page
│
├── 📁 classes/                     # PHP OOP Classes
│   ├── 📄 Page.php                 # Page management
│   ├── 📄 Navigation.php           # Navigation menu
│   ├── 📄 Hero.php                 # Hero section
│   ├── 📄 Feature.php              # Features section
│   ├── 📄 Service.php              # Services section
│   ├── 📄 Portfolio.php            # Portfolio section
│   ├── 📄 Testimonial.php          # Testimonials section
│   ├── 📄 Contact.php              # Contact section
│   ├── 📄 Footer.php               # Footer section
│   └── 📄 Modal.php                # Modal windows
│
├── 📁 assets/
│   ├── 📁 css/
│   │   └── 📄 style.css            # Custom CSS (1000+ lines)
│   └── 📁 js/
│       └── 📄 main.js              # Custom JS (600+ lines)
│
├── 📄 README.md                    # Project overview
├── 📄 OOP-GUIDE.md                 # Complete OOP documentation
├── 📄 QUICK-START.md               # Quick start guide
├── 📄 ARCHITECTURE.md              # This file
└── 📄 .gitignore                   # Git ignore rules
```

---

## Component Interaction Diagram

```
┌──────────────┐
│    User      │
└──────┬───────┘
       │
       │ Clicks navigation link
       │
       ▼
┌──────────────┐         ┌─────────────────┐
│  Navigation  │────────>│  Smooth Scroll  │
└──────────────┘         └────────┬────────┘
                                  │
                                  ▼
                         ┌─────────────────┐
                         │ Target Section  │
                         └─────────────────┘


┌──────────────┐
│    User      │
└──────┬───────┘
       │
       │ Clicks theme toggle
       │
       ▼
┌──────────────┐         ┌─────────────────┐
│ Theme Toggle │────────>│  Toggle Class   │
└──────────────┘         └────────┬────────┘
                                  │
                                  ▼
                         ┌─────────────────┐
                         │ Save to Storage │
                         └────────┬────────┘
                                  │
                                  ▼
                         ┌─────────────────┐
                         │ Update UI Theme │
                         └─────────────────┘


┌──────────────┐
│    User      │
└──────┬───────┘
       │
       │ Clicks portfolio filter
       │
       ▼
┌──────────────┐         ┌─────────────────┐
│Filter Button │────────>│  Filter Items   │
└──────────────┘         └────────┬────────┘
                                  │
                                  ▼
                         ┌─────────────────┐
                         │  Hide/Show      │
                         │  Portfolio      │
                         │  Items          │
                         └─────────────────┘
```

---

## Extensibility Examples

### Create Custom Section Class

```php
class TeamSection {
    private $members = [];
    
    public function addMember($name, $role, $image) {
        $this->members[] = compact('name', 'role', 'image');
    }
    
    public function render() {
        echo '<section id="team">';
        foreach ($this->members as $member) {
            // Render team member card
        }
        echo '</section>';
    }
}

// Usage
$team = new TeamSection();
$team->addMember('John Doe', 'CEO', 'john.jpg');
$team->render();
```

### Extend Existing Class

```php
class ExtendedHero extends Hero {
    private $videoBackground;
    
    public function setVideoBackground($url) {
        $this->videoBackground = $url;
    }
    
    public function render() {
        // Custom render with video
        parent::render(); // Call original
    }
}
```

---

## Performance Considerations

```
Optimization Techniques Used:

1. Lazy Loading
   └─ Images load as needed

2. CSS Minification
   └─ Reduced file sizes

3. Debounced Events
   └─ Scroll handlers optimized

4. Cached Queries
   └─ DOM queries cached

5. GPU Acceleration
   └─ Transform properties used

6. Async Scripts
   └─ Non-blocking loads
```

---

## Security Features

```
Security Layers:

1. HTML Escaping
   └─ htmlspecialchars() on all output

2. Input Validation
   └─ Form validation (client-side)

3. XSS Prevention
   └─ No raw HTML injection

4. CSRF Ready
   └─ Token system can be added

5. Secure Headers
   └─ Content security policy ready
```

---

**This architecture provides a solid foundation for building scalable web applications! 🚀**
