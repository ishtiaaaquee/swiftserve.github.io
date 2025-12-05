<?php
/**
 * Featured Deals Section
 * Shows promotional offers and discounts like food delivery apps
 */
class FeaturedDeals {
    private $title;
    private $deals;
    
    public function __construct() {
        $this->title = '15% off entire menu';
        $this->deals = [
            [
                'id' => 1,
                'name' => 'Kacchi Bhai',
                'category' => 'Biryani',
                'cuisine' => 'Biryani',
                'rating' => 4.7,
                'reviewCount' => '2500+',
                'deliveryTime' => '30-45 min',
                'minPrice' => 250,
                'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400&h=300&fit=crop',
                'offers' => [
                    ['text' => '15% off ৳699: foodlover200', 'icon' => 'ticket-alt'],
                    ['text' => '10% off ৳249', 'icon' => 'percent']
                ],
                'badges' => ['Price Match']
            ],
            [
                'id' => 2,
                'name' => 'Kasturi Restaurant',
                'category' => 'Bengali',
                'cuisine' => 'Bengali',
                'rating' => 4.8,
                'reviewCount' => '3200+',
                'deliveryTime' => '25-40 min',
                'minPrice' => 300,
                'image' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=400&h=300&fit=crop',
                'offers' => [
                    ['text' => '15% off ৳699: foodlover200', 'icon' => 'ticket-alt'],
                    ['text' => '10% off ৳249', 'icon' => 'percent']
                ],
                'badges' => ['Price Match', 'Foodie Pack']
            ],
            [
                'id' => 3,
                'name' => 'Spice & Rice',
                'category' => 'Chinese',
                'cuisine' => 'Chinese',
                'rating' => 4.7,
                'reviewCount' => '1800+',
                'deliveryTime' => '30-45 min',
                'minPrice' => 280,
                'image' => 'https://images.unsplash.com/photo-1525755662778-989d0524087e?w=400&h=300&fit=crop',
                'offers' => [
                    ['text' => '15% off ৳699: foodlover200', 'icon' => 'ticket-alt'],
                    ['text' => '10% off ৳249', 'icon' => 'percent']
                ],
                'badges' => ['Price Match']
            ],
            [
                'id' => 4,
                'name' => 'Khana\'s',
                'category' => 'Indian',
                'cuisine' => 'Indian',
                'rating' => 4.6,
                'reviewCount' => '1500+',
                'deliveryTime' => '25-40 min',
                'minPrice' => 250,
                'image' => 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=400&h=300&fit=crop',
                'offers' => [
                    ['text' => '15% off ৳699: foodlover200', 'icon' => 'ticket-alt']
                ],
                'badges' => ['Saver']
            ]
        ];
    }
    
    public function render() {
        ?>
        <section id="featured-deals" class="py-5 section-padding bg-light-section">
            <div class="container">
                <div class="mb-4" data-aos="fade-up">
                    <h2 class="section-title mb-1"><?php echo htmlspecialchars($this->title); ?></h2>
                </div>
                
                <div class="deals-scroll-container mb-5">
                    <div class="row g-3 flex-nowrap deals-row">
                        <?php foreach ($this->deals as $index => $deal): ?>
                        <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                            <div class="deal-card">
                                <div class="deal-image-wrapper">
                                    <img src="<?php echo htmlspecialchars($deal['image']); ?>" alt="<?php echo htmlspecialchars($deal['name']); ?>" class="deal-image">
                                    <div class="deal-offers">
                                        <?php foreach ($deal['offers'] as $offer): ?>
                                        <div class="offer-badge">
                                            <i class="fas fa-<?php echo $offer['icon']; ?>"></i>
                                            <span><?php echo htmlspecialchars($offer['text']); ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if (!empty($deal['badges'])): ?>
                                    <div class="deal-badges">
                                        <?php foreach ($deal['badges'] as $badge): ?>
                                        <span class="mini-badge"><?php echo htmlspecialchars($badge); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="deal-content">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h5 class="deal-name mb-0"><?php echo htmlspecialchars($deal['name']); ?></h5>
                                        <div class="deal-rating">
                                            <i class="fas fa-star text-warning"></i>
                                            <span class="ms-1"><?php echo $deal['rating']; ?></span>
                                            <span class="text-muted small">(<?php echo $deal['reviewCount']; ?>)</span>
                                        </div>
                                    </div>
                                    <div class="deal-meta">
                                        <span class="me-3"><i class="far fa-clock me-1"></i><?php echo $deal['deliveryTime']; ?></span>
                                        <span class="me-3"><i class="fas fa-rupee-sign me-1"></i><?php echo $deal['cuisine']; ?></span>
                                    </div>
                                    <div class="deal-footer mb-2">
                                        <span class="deal-price">
                                            <i class="fas fa-tag me-1"></i>
                                            from ৳<?php echo $deal['minPrice']; ?> with Saver
                                            <i class="fas fa-shipping-fast ms-1 text-primary"></i>
                                        </span>
                                    </div>
                                    <button class="btn btn-sm btn-primary w-100 view-menu" data-restaurant-id="<?php echo $deal['id']; ?>" style="padding: 0.4rem; font-size: 0.85rem;">
                                        <i class="fas fa-utensils me-1"></i>View Menu
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Fast Delivery Section -->
                <div class="mb-4" data-aos="fade-up">
                    <h2 class="section-title mb-1">Fast delivery</h2>
                </div>
                
                <div class="deals-scroll-container">
                    <div class="row g-3 flex-nowrap deals-row">
                        <?php 
                        $fastDelivery = [
                            [
                                'id' => 4,
                                'name' => 'Takeout Dhaka',
                                'category' => 'Fast Food',
                                'rating' => 4.5,
                                'reviewCount' => '2200+',
                                'deliveryTime' => '20-35 min',
                                'minPrice' => 150,
                                'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=400&h=300&fit=crop',
                                'offers' => [
                                    ['text' => '15% off ৳699: foodlover200', 'icon' => 'ticket-alt']
                                ],
                                'badges' => ['Price Match']
                            ],
                            [
                                'id' => 2,
                                'name' => 'Haji Biriyani',
                                'category' => 'Biryani',
                                'rating' => 4.6,
                                'reviewCount' => '5000+',
                                'deliveryTime' => '35-50 min',
                                'minPrice' => 200,
                                'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400&h=300&fit=crop',
                                'offers' => [
                                    ['text' => '15% off ৳699: foodlover200', 'icon' => 'ticket-alt']
                                ],
                                'badges' => ['Price Match']
                            ],
                            [
                                'id' => 8,
                                'name' => 'Chillox',
                                'category' => 'Fast Food',
                                'rating' => 4.5,
                                'reviewCount' => '1800+',
                                'deliveryTime' => '20-35 min',
                                'minPrice' => 200,
                                'image' => 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=400&h=300&fit=crop',
                                'offers' => [
                                    ['text' => '15% off ৳699: foodlover200', 'icon' => 'ticket-alt'],
                                    ['text' => '10% off ৳150', 'icon' => 'percent']
                                ],
                                'badges' => []
                            ],
                            [
                                'id' => 9,
                                'name' => 'Star Kabab',
                                'category' => 'Bengali',
                                'rating' => 4.7,
                                'reviewCount' => '2100+',
                                'deliveryTime' => '25-40 min',
                                'minPrice' => 180,
                                'image' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=400&h=300&fit=crop',
                                'offers' => [
                                    ['text' => '15% off ৳699: foodlover200', 'icon' => 'ticket-alt']
                                ],
                                'badges' => []
                            ]
                        ];
                        
                        foreach ($fastDelivery as $index => $deal): ?>
                        <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                            <div class="deal-card">
                                <div class="deal-image-wrapper">
                                    <img src="<?php echo htmlspecialchars($deal['image']); ?>" alt="<?php echo htmlspecialchars($deal['name']); ?>" class="deal-image">
                                    <div class="deal-offers">
                                        <?php foreach ($deal['offers'] as $offer): ?>
                                        <div class="offer-badge">
                                            <i class="fas fa-<?php echo $offer['icon']; ?>"></i>
                                            <span><?php echo htmlspecialchars($offer['text']); ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if (!empty($deal['badges'])): ?>
                                    <div class="deal-badges">
                                        <?php foreach ($deal['badges'] as $badge): ?>
                                        <span class="mini-badge"><?php echo htmlspecialchars($badge); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="deal-content">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h5 class="deal-name mb-0"><?php echo htmlspecialchars($deal['name']); ?></h5>
                                        <div class="deal-rating">
                                            <i class="fas fa-star text-warning"></i>
                                            <span class="ms-1"><?php echo $deal['rating']; ?></span>
                                            <span class="text-muted small">(<?php echo $deal['reviewCount']; ?>)</span>
                                        </div>
                                    </div>
                                    <div class="deal-meta">
                                        <span class="me-3"><i class="far fa-clock me-1"></i><?php echo $deal['deliveryTime']; ?></span>
                                        <span class="me-3"><i class="fas fa-rupee-sign me-1"></i><?php echo $deal['category']; ?></span>
                                    </div>
                                    <div class="deal-footer mb-2">
                                        <span class="deal-price">
                                            <i class="fas fa-tag me-1"></i>৳<?php echo $deal['minPrice']; ?>
                                        </span>
                                    </div>
                                    <button class="btn btn-sm btn-primary w-100 view-menu" data-restaurant-id="<?php echo $deal['id']; ?>" style="padding: 0.4rem; font-size: 0.85rem;">
                                        <i class="fas fa-utensils me-1"></i>View Menu
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
