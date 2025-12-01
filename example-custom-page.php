<?php
/**
 * Example: Custom Page Creation
 * This file demonstrates how to create a custom page using the OOP architecture
 */

// Autoloader
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Initialize components
$page = new Page('About Us - SwiftServe');
$navigation = new Navigation('SwiftServe');

// Customize hero section
$hero = new Hero();
$hero->setTitle('About <span class="gradient-text">Our Company</span>');
$hero->setSubtitle('Passionate about creating amazing digital experiences since 2020');
$hero->addStat(150, 'Team Members');
$hero->addStat(1200, 'Happy Clients');
$hero->addStat(2500, 'Projects Completed');

// Custom features
$features = new FeaturesSection();
$features->addFeature(new Feature(
    'heart',
    'Customer First',
    'We put our customers at the heart of everything we do'
));
$features->addFeature(new Feature(
    'award',
    'Award Winning',
    'Recognized globally for excellence in design and innovation'
));

// Custom services
$services = new ServicesSection();
$services->addService(new Service(
    'Cloud Solutions',
    'Scalable cloud infrastructure and migration services',
    'cloud',
    'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=400&h=300&fit=crop'
));
$services->addService(new Service(
    'DevOps',
    'Continuous integration and deployment pipelines',
    'code-branch',
    'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?w=400&h=300&fit=crop'
));

// Custom portfolio items
$portfolio = new PortfolioSection();
$portfolio->addItem(new PortfolioItem(
    'Healthcare Portal',
    'web',
    'Healthcare Management System',
    'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&h=400&fit=crop'
));
$portfolio->addItem(new PortfolioItem(
    'Fitness Mobile App',
    'mobile',
    'iOS & Android Fitness Tracker',
    'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=500&h=400&fit=crop'
));

// Custom testimonials
$testimonials = new TestimonialsSection();
$testimonials->addTestimonial(new Testimonial(
    'Emma Wilson',
    'CTO',
    'HealthTech Inc',
    'Their expertise in healthcare technology is unmatched. They delivered a secure, scalable solution that exceeded our expectations.',
    5,
    'https://i.pravatar.cc/100?img=10'
));

// Custom contact info
$contact = new ContactSection();
$contact->setContactInfo(
    '456 Innovation Boulevard, San Francisco, CA 94102',
    '+1 (555) 987-6543',
    'contact@swiftserve.com'
);

$footer = new Footer();
$modals = new ModalsManager();

// Add custom modal
$customModalContent = '
<div class="text-center">
    <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
    <h3>Thank You for Your Interest!</h3>
    <p>Our team will contact you within 24 hours.</p>
    <button class="btn btn-primary" data-bs-dismiss="modal">Got it!</button>
</div>
';
$modals->addModal(new Modal('thankYouModal', 'Success', $customModalContent, 'md'));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page->renderHead(); ?>
</head>
<body class="transition-colors duration-300">

    <?php $navigation->render(); ?>
    
    <?php $hero->render(); ?>
    
    <!-- Custom Content Section -->
    <section class="py-5 section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="section-title">Our Story</h2>
                    <p class="lead">Founded in 2020, SwiftServe has grown from a small startup to a leading digital agency.</p>
                    <p>We believe in the power of technology to transform businesses and improve lives. Our team of passionate developers, designers, and strategists work together to create innovative solutions that drive real results.</p>
                    <button class="btn btn-primary mt-3">Learn More</button>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop" alt="Our Team" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>
    
    <?php $features->render(); ?>
    
    <?php $services->render(); ?>
    
    <?php $portfolio->render(); ?>
    
    <?php $testimonials->render(); ?>
    
    <!-- Custom Team Section -->
    <section class="py-5 section-padding bg-light-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Meet Our Team</h2>
                <p class="section-subtitle">The talented people behind our success</p>
            </div>
            <div class="row g-4">
                <?php
                $team = [
                    ['name' => 'Alex Rodriguez', 'role' => 'CEO & Founder', 'img' => 'https://i.pravatar.cc/300?img=12'],
                    ['name' => 'Sophie Chen', 'role' => 'Lead Designer', 'img' => 'https://i.pravatar.cc/300?img=44'],
                    ['name' => 'Marcus Johnson', 'role' => 'CTO', 'img' => 'https://i.pravatar.cc/300?img=15'],
                    ['name' => 'Isabella Garcia', 'role' => 'Marketing Director', 'img' => 'https://i.pravatar.cc/300?img=47']
                ];
                
                foreach ($team as $index => $member):
                ?>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <img src="<?php echo $member['img']; ?>" class="card-img-top rounded-circle mx-auto mt-4" alt="<?php echo $member['name']; ?>" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $member['name']; ?></h5>
                            <p class="text-muted"><?php echo $member['role']; ?></p>
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <?php $contact->render(); ?>
    
    <?php $footer->render(); ?>
    
    <?php $modals->render(); ?>
    
    <?php $page->renderScripts(); ?>

</body>
</html>
