# 🚀 Quick Start Guide - SwiftServe OOP

## ⚡ 5-Minute Setup

### 1. View Your Site
```
http://localhost/swiftserve
```

### 2. View Custom Example Page
```
http://localhost/swiftserve/example-custom-page.php
```

---

## 🎨 Common Customizations

### Change Page Title
```php
// In index.php
$page = new Page('My Custom Title');
```

### Modify Hero Section
```php
$hero = new Hero();
$hero->setTitle('Your <span class="gradient-text">Title</span>');
$hero->setSubtitle('Your subtitle here');
```

### Add More Statistics
```php
$hero->addStat(999, 'Custom Metric');
```

### Add New Feature
```php
$features = new FeaturesSection();
$features->addFeature(new Feature(
    'icon-name',      // Font Awesome icon
    'Feature Title',
    'Feature description'
));
```

### Add New Service
```php
$services = new ServicesSection();
$services->addService(new Service(
    'Service Name',
    'Service description',
    'icon-name',
    'https://image-url.jpg'
));
```

### Add Portfolio Project
```php
$portfolio = new PortfolioSection();
$portfolio->addItem(new PortfolioItem(
    'Project Name',
    'web',              // Category: web, mobile, design
    'Project Type',
    'https://image-url.jpg'
));
```

### Add Testimonial
```php
$testimonials = new TestimonialsSection();
$testimonials->addTestimonial(new Testimonial(
    'Client Name',
    'Job Title',
    'Company',
    'Testimonial text here',
    5,                  // Rating 1-5
    'https://avatar-url.jpg'
));
```

### Update Contact Info
```php
$contact = new ContactSection();
$contact->setContactInfo(
    'Your Address',
    'Your Phone',
    'Your Email'
);
```

---

## 📝 Create New Page

### Step 1: Create new file
```php
<?php
// my-page.php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$page = new Page('My Page Title');
$navigation = new Navigation('SwiftServe');
$hero = new Hero();
// ... add more sections
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page->renderHead(); ?>
</head>
<body>
    <?php $navigation->render(); ?>
    <?php $hero->render(); ?>
    <!-- Add your custom HTML here -->
    <?php $page->renderScripts(); ?>
</body>
</html>
```

### Step 2: Access your page
```
http://localhost/swiftserve/my-page.php
```

---

## 🎨 Styling Tips

### Change Colors
Edit `assets/css/style.css`:
```css
:root {
    --primary-color: #your-color;
    --secondary-color: #your-color;
}
```

### Add Custom CSS
```css
/* In assets/css/style.css */
.my-custom-class {
    /* Your styles */
}
```

### Add Custom JavaScript
```javascript
// In assets/js/main.js
function myCustomFunction() {
    // Your code
}
```

---

## 🔧 Class Reference

| Class | Purpose | Key Methods |
|-------|---------|-------------|
| `Page` | Page setup | `setTitle()`, `renderHead()`, `renderScripts()` |
| `Navigation` | Menu | `addMenuItem()`, `render()` |
| `Hero` | Hero section | `setTitle()`, `addStat()`, `render()` |
| `FeaturesSection` | Features | `addFeature()`, `render()` |
| `ServicesSection` | Services | `addService()`, `render()` |
| `PortfolioSection` | Portfolio | `addItem()`, `render()` |
| `TestimonialsSection` | Testimonials | `addTestimonial()`, `render()` |
| `ContactSection` | Contact | `setContactInfo()`, `render()` |
| `Footer` | Footer | `render()` |
| `ModalsManager` | Modals | `addModal()`, `render()` |

---

## 📚 Documentation Files

- **README.md** - Overview and features
- **OOP-GUIDE.md** - Complete OOP documentation
- **QUICK-START.md** - This file
- **example-custom-page.php** - Working example

---

## 🎯 Font Awesome Icons

Use any icon from [Font Awesome](https://fontawesome.com/icons):
```php
new Feature('star', 'Title', 'Description')
new Feature('rocket', 'Title', 'Description')
new Feature('heart', 'Title', 'Description')
```

---

## 🌈 Image Sources

### Free Image Resources:
- [Unsplash](https://unsplash.com/) - High-quality free images
- [Pexels](https://pexels.com/) - Free stock photos
- [Pixabay](https://pixabay.com/) - Free images and videos

### Avatar Generators:
- [Pravatar](https://pravatar.cc/) - Random avatars
- [UI Faces](https://uifaces.co/) - User avatars

---

## 🐛 Troubleshooting

### Page shows blank?
Check if Apache is running in XAMPP.

### Classes not loading?
Make sure all files are in `classes/` folder.

### Styles not working?
Clear browser cache (Ctrl+Shift+Delete).

### JavaScript not working?
Check browser console (F12) for errors.

---

## 💡 Pro Tips

1. **Use descriptive names** for features, services, etc.
2. **Keep images optimized** - use WebP format when possible
3. **Test responsive design** - check on mobile devices
4. **Enable dark mode** - click moon/sun icon in navbar
5. **Check console** - F12 for developer messages

---

## 🎉 Next Steps

1. ✅ Customize content in `index.php`
2. ✅ Add your own images
3. ✅ Update contact information
4. ✅ Create additional pages
5. ✅ Deploy to production server

---

## 📧 Need Help?

- Read **OOP-GUIDE.md** for detailed documentation
- Check **example-custom-page.php** for working examples
- Experiment with the code - it's all object-oriented!

---

**Happy coding! 🚀**
