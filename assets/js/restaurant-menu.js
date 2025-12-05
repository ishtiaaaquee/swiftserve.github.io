/**
 * Restaurant Menu System
 * Handles restaurant menus, details, and menu item display
 */

// Restaurant Menu Data
const RESTAURANT_MENUS = {
    1: { // Kacchi Bhai
        name: "Kacchi Bhai",
        cuisine: "Biryani",
        rating: 4.7,
        reviewCount: 2500,
        deliveryTime: "30-45 min",
        minOrder: 250,
        description: "Famous for authentic Kacchi Biryani with premium basmati rice and tender meat",
        address: "Dhanmondi, Dhaka",
        phone: "+880 1712-345678",
        categories: [
            {
                name: "Signature Biryani",
                items: [
                    { id: 101, name: "Kacchi Biryani (Mutton)", price: 350, description: "Premium mutton with fragrant basmati rice, potato & boiled egg", image: "https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=300&h=200&fit=crop", popular: true },
                    { id: 102, name: "Kacchi Biryani (Beef)", price: 280, description: "Tender beef with aromatic spices and saffron rice", image: "https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=300&h=200&fit=crop", popular: true },
                    { id: 103, name: "Chicken Biryani", price: 220, description: "Juicy chicken pieces with special blend of spices", image: "https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=300&h=200&fit=crop" },
                    { id: 104, name: "Special Morog Polao", price: 250, description: "Traditional chicken pulao with ghee and mild spices", image: "https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=300&h=200&fit=crop" }
                ]
            },
            {
                name: "Kebabs & Starters",
                items: [
                    { id: 105, name: "Shahi Chicken Tikka", price: 180, description: "Marinated chicken grilled to perfection", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop" },
                    { id: 106, name: "Beef Sheek Kebab", price: 200, description: "Spiced minced beef grilled on skewers", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop" },
                    { id: 107, name: "Chicken Reshmi Kebab", price: 190, description: "Creamy marinated boneless chicken", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop" }
                ]
            },
            {
                name: "Beverages",
                items: [
                    { id: 108, name: "Borhani", price: 40, description: "Traditional yogurt drink", image: "https://images.unsplash.com/photo-1587080266227-677cc2a4e76e?w=300&h=200&fit=crop" },
                    { id: 109, name: "Soft Drink", price: 35, description: "Coca Cola/Pepsi/Sprite", image: "https://images.unsplash.com/photo-1581006852262-e4307cf6283a?w=300&h=200&fit=crop" }
                ]
            }
        ]
    },
    2: { // Haji Biriyani
        name: "Haji Biriyani",
        cuisine: "Biryani",
        rating: 4.6,
        reviewCount: 5000,
        deliveryTime: "35-50 min",
        minOrder: 200,
        description: "Legendary Old Dhaka biryani since 1939",
        address: "Nazira Bazar, Old Dhaka",
        phone: "+880 1712-234567",
        categories: [
            {
                name: "Classic Biryani",
                items: [
                    { id: 201, name: "Haji Beef Biryani", price: 250, description: "Signature Old Dhaka style beef biryani", image: "https://images.unsplash.com/photo-1642821373181-696a54913e93?w=300&h=200&fit=crop", popular: true },
                    { id: 202, name: "Haji Mutton Biryani", price: 320, description: "Traditional mutton biryani with authentic spices", image: "https://images.unsplash.com/photo-1642821373181-696a54913e93?w=300&h=200&fit=crop", popular: true },
                    { id: 203, name: "Chicken Roast", price: 180, description: "Spicy chicken curry with potatoes", image: "https://images.unsplash.com/photo-1603894584373-5ac82b2fb598?w=300&h=200&fit=crop" }
                ]
            }
        ]
    },
    3: { // Kasturi Restaurant
        name: "Kasturi Restaurant",
        cuisine: "Bengali",
        rating: 4.8,
        reviewCount: 3200,
        deliveryTime: "25-40 min",
        minOrder: 300,
        description: "Traditional Bengali cuisine with authentic homestyle flavors",
        address: "Bailey Road, Dhaka",
        phone: "+880 1712-456789",
        categories: [
            {
                name: "Bengali Specials",
                items: [
                    { id: 301, name: "Ilish Bhapa", price: 450, description: "Steamed hilsa fish with mustard paste", image: "https://images.unsplash.com/photo-1601050690597-df0568f70950?w=300&h=200&fit=crop", popular: true },
                    { id: 302, name: "Chingri Malai Curry", price: 420, description: "Prawns in coconut milk curry", image: "https://images.unsplash.com/photo-1601050690597-df0568f70950?w=300&h=200&fit=crop", popular: true },
                    { id: 303, name: "Begun Bhaja", price: 80, description: "Crispy fried eggplant slices", image: "https://images.unsplash.com/photo-1601050690597-df0568f70950?w=300&h=200&fit=crop" },
                    { id: 304, name: "Dal Bhuna", price: 120, description: "Lentils cooked with aromatic spices", image: "https://images.unsplash.com/photo-1601050690597-df0568f70950?w=300&h=200&fit=crop" }
                ]
            },
            {
                name: "Rice & Bread",
                items: [
                    { id: 305, name: "Plain Rice", price: 60, description: "Steamed white rice", image: "https://images.unsplash.com/photo-1516684732162-798a0062be99?w=300&h=200&fit=crop" },
                    { id: 306, name: "Paratha", price: 35, description: "Flaky layered flatbread", image: "https://images.unsplash.com/photo-1601050690597-df0568f70950?w=300&h=200&fit=crop" }
                ]
            }
        ]
    },
    4: { // Takeout Dhaka
        name: "Takeout Dhaka",
        cuisine: "Fast Food",
        rating: 4.5,
        reviewCount: 2200,
        deliveryTime: "20-35 min",
        minOrder: 150,
        description: "Burgers, fries and American fast food favorites",
        address: "Gulshan Avenue, Dhaka",
        phone: "+880 1712-567890",
        categories: [
            {
                name: "Burgers",
                items: [
                    { id: 401, name: "Classic Beef Burger", price: 350, description: "Juicy beef patty with cheese, lettuce, tomato", image: "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&h=200&fit=crop", popular: true },
                    { id: 402, name: "Chicken Burger", price: 280, description: "Crispy fried chicken with special sauce", image: "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&h=200&fit=crop" },
                    { id: 403, name: "Double Decker Burger", price: 480, description: "Two beef patties with extra cheese", image: "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&h=200&fit=crop", popular: true }
                ]
            },
            {
                name: "Sides",
                items: [
                    { id: 404, name: "French Fries", price: 120, description: "Crispy golden fries", image: "https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=300&h=200&fit=crop" },
                    { id: 405, name: "Onion Rings", price: 140, description: "Beer-battered onion rings", image: "https://images.unsplash.com/photo-1639024471283-03518883512d?w=300&h=200&fit=crop" },
                    { id: 406, name: "Chicken Wings (6pcs)", price: 250, description: "Spicy buffalo wings", image: "https://images.unsplash.com/photo-1567620832903-9fc6debc209f?w=300&h=200&fit=crop" }
                ]
            }
        ]
    },
    5: { // Spice & Rice
        name: "Spice & Rice",
        cuisine: "Chinese",
        rating: 4.7,
        reviewCount: 1800,
        deliveryTime: "30-45 min",
        minOrder: 280,
        description: "Thai and Chinese fusion cuisine",
        address: "Banani, Dhaka",
        phone: "+880 1712-678901",
        categories: [
            {
                name: "Noodles & Rice",
                items: [
                    { id: 501, name: "Thai Fried Rice", price: 320, description: "Spicy fried rice with vegetables and egg", image: "https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=300&h=200&fit=crop", popular: true },
                    { id: 502, name: "Pad Thai", price: 380, description: "Stir-fried rice noodles with shrimp", image: "https://images.unsplash.com/photo-1559314809-0d155014e29e?w=300&h=200&fit=crop", popular: true },
                    { id: 503, name: "Chow Mein", price: 280, description: "Stir-fried noodles with vegetables", image: "https://images.unsplash.com/photo-1585032226651-759b368d7246?w=300&h=200&fit=crop" }
                ]
            },
            {
                name: "Main Course",
                items: [
                    { id: 504, name: "Sweet & Sour Chicken", price: 350, description: "Crispy chicken in tangy sauce", image: "https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=300&h=200&fit=crop" },
                    { id: 505, name: "Kung Pao Chicken", price: 380, description: "Spicy chicken with peanuts", image: "https://images.unsplash.com/photo-1525755662778-989d0524087e?w=300&h=200&fit=crop", popular: true }
                ]
            }
        ]
    },
    6: { // Khana's
        name: "Khana's",
        cuisine: "Indian",
        rating: 4.6,
        reviewCount: 1500,
        deliveryTime: "25-40 min",
        minOrder: 250,
        description: "North Indian cuisine and tandoor specialties",
        address: "Dhanmondi, Dhaka",
        phone: "+880 1712-789012",
        categories: [
            {
                name: "Tandoori",
                items: [
                    { id: 601, name: "Chicken Tikka Masala", price: 380, description: "Grilled chicken in creamy tomato sauce", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop", popular: true },
                    { id: 602, name: "Butter Chicken", price: 420, description: "Tender chicken in rich butter sauce", image: "https://images.unsplash.com/photo-1603894584373-5ac82b2fb598?w=300&h=200&fit=crop", popular: true },
                    { id: 603, name: "Tandoori Chicken (Full)", price: 550, description: "Whole chicken marinated in yogurt and spices", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop" }
                ]
            },
            {
                name: "Breads",
                items: [
                    { id: 604, name: "Butter Naan", price: 45, description: "Soft flatbread with butter", image: "https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=300&h=200&fit=crop" },
                    { id: 605, name: "Garlic Naan", price: 55, description: "Naan topped with garlic", image: "https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=300&h=200&fit=crop" }
                ]
            }
        ]
    },
    7: { // Coopers Chocolate House
        name: "Coopers Chocolate House",
        cuisine: "Desserts",
        rating: 4.8,
        reviewCount: 900,
        deliveryTime: "15-30 min",
        minOrder: 120,
        description: "Premium desserts and chocolates",
        address: "Banani, Dhaka",
        phone: "+880 1712-890123",
        categories: [
            {
                name: "Signature Desserts",
                items: [
                    { id: 701, name: "Chocolate Fudge Cake", price: 280, description: "Rich chocolate cake with fudge frosting", image: "https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=300&h=200&fit=crop", popular: true },
                    { id: 702, name: "Chocolate Brownie", price: 180, description: "Warm brownie with vanilla ice cream", image: "https://images.unsplash.com/photo-1564355808539-22fda35bed7e?w=300&h=200&fit=crop" },
                    { id: 703, name: "Cheesecake", price: 250, description: "New York style cheesecake", image: "https://images.unsplash.com/photo-1524351199678-941a58a3df50?w=300&h=200&fit=crop", popular: true }
                ]
            },
            {
                name: "Ice Cream",
                items: [
                    { id: 704, name: "Chocolate Sundae", price: 200, description: "Triple chocolate ice cream with toppings", image: "https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=300&h=200&fit=crop" },
                    { id: 705, name: "Belgian Waffle", price: 220, description: "Crispy waffle with ice cream and chocolate", image: "https://images.unsplash.com/photo-1551024506-0bccd828d307?w=300&h=200&fit=crop" }
                ]
            }
        ]
    },
    8: { // Chillox
        name: "Chillox",
        cuisine: "Fast Food",
        rating: 4.5,
        reviewCount: 1800,
        deliveryTime: "20-35 min",
        minOrder: 200,
        description: "Popular local burger joint",
        address: "Uttara, Dhaka",
        phone: "+880 1712-901234",
        categories: [
            {
                name: "Burgers & Sandwiches",
                items: [
                    { id: 801, name: "Chillox Special Burger", price: 380, description: "Signature beef burger with special sauce", image: "https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=300&h=200&fit=crop", popular: true },
                    { id: 802, name: "Grilled Chicken Sandwich", price: 290, description: "Grilled chicken with veggies", image: "https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=300&h=200&fit=crop" },
                    { id: 803, name: "Club Sandwich", price: 320, description: "Triple decker with chicken and egg", image: "https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=300&h=200&fit=crop" }
                ]
            }
        ]
    },
    9: { // Star Kabab
        name: "Star Kabab",
        cuisine: "Bengali",
        rating: 4.7,
        reviewCount: 2100,
        deliveryTime: "25-40 min",
        minOrder: 180,
        description: "Grilled kebabs and BBQ specials",
        address: "Mohammadpur, Dhaka",
        phone: "+880 1712-012345",
        categories: [
            {
                name: "Grilled Specials",
                items: [
                    { id: 901, name: "Mixed Grill Platter", price: 650, description: "Assorted kebabs with naan and salad", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop", popular: true },
                    { id: 902, name: "Chicken Tikka", price: 280, description: "Marinated grilled chicken pieces", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop", popular: true },
                    { id: 903, name: "Beef Boti Kebab", price: 320, description: "Tender beef chunks grilled to perfection", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop" },
                    { id: 904, name: "Seekh Kebab", price: 250, description: "Spiced minced meat on skewers", image: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=300&h=200&fit=crop" }
                ]
            }
        ]
    }
};

// Restaurant Menu Modal Class
class RestaurantMenuModal {
    constructor() {
        this.currentRestaurant = null;
        this.init();
        console.log('RestaurantMenuModal initialized');
    }

    init() {
        // Listen for View Menu button clicks with event delegation
        document.body.addEventListener('click', (e) => {
            const viewMenuBtn = e.target.closest('.view-menu');
            if (viewMenuBtn) {
                e.preventDefault();
                e.stopPropagation();
                const restaurantId = parseInt(viewMenuBtn.getAttribute('data-restaurant-id'));
                console.log('View Menu clicked for restaurant ID:', restaurantId);
                this.showMenu(restaurantId);
            }
        });
        console.log('Event listener attached to body for .view-menu buttons');
    }

    showMenu(restaurantId) {
        console.log('showMenu called with ID:', restaurantId);
        const restaurant = RESTAURANT_MENUS[restaurantId];
        if (!restaurant) {
            console.error('Restaurant not found:', restaurantId);
            console.log('Available restaurant IDs:', Object.keys(RESTAURANT_MENUS));
            alert('Restaurant menu not available for ID: ' + restaurantId + '. Please try another restaurant.');
            return;
        }

        console.log('Showing menu for:', restaurant.name);
        this.currentRestaurant = restaurant;
        this.createModal();
    }

    createModal() {
        const restaurant = this.currentRestaurant;
        
        // Remove existing modal if any
        const existingModal = document.getElementById('restaurantMenuModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Generate menu HTML
        const menuHTML = this.renderCategories(restaurant.categories);

        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'restaurantMenuModal';
        modal.innerHTML = `
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;">
                        <div class="w-100">
                            <h4 class="modal-title mb-1">${restaurant.name}</h4>
                            <div class="d-flex align-items-center gap-3 small">
                                <span><i class="fas fa-star"></i> ${restaurant.rating} (${restaurant.reviewCount}+ reviews)</span>
                                <span><i class="fas fa-clock"></i> ${restaurant.deliveryTime}</span>
                                <span><i class="fas fa-utensils"></i> ${restaurant.cuisine}</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- Restaurant Info -->
                        <div class="p-4 border-bottom bg-light">
                            <p class="mb-2">${restaurant.description}</p>
                            <div class="row small text-muted">
                                <div class="col-md-6"><i class="fas fa-map-marker-alt me-2"></i>${restaurant.address}</div>
                                <div class="col-md-6"><i class="fas fa-phone me-2"></i>${restaurant.phone}</div>
                            </div>
                            <div class="alert alert-info mt-3 mb-0 small">
                                <i class="fas fa-info-circle me-2"></i>Minimum order: ৳${restaurant.minOrder}
                            </div>
                        </div>
                        
                        <!-- Menu Categories -->
                        <div class="p-4" id="menuCategoriesContainer" style="display: block !important; visibility: visible !important; opacity: 1 !important; background: #f8f9fa !important;">
                            ${menuHTML}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="viewCartFromModal">
                            <i class="fas fa-shopping-cart me-2"></i>View Cart (<span id="modalCartCount">0</span>)
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        console.log('Modal HTML added to body');
        
        // Update modal cart count
        const updateModalCartCount = () => {
            const modalCartCount = document.getElementById('modalCartCount');
            if (modalCartCount && window.cart) {
                modalCartCount.textContent = window.cart.getItemCount();
            }
        };
        updateModalCartCount();
        
        // View Cart button handler
        const viewCartBtn = document.getElementById('viewCartFromModal');
        if (viewCartBtn) {
            viewCartBtn.addEventListener('click', () => {
                // Close the menu modal
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
                
                // Open cart sidebar
                setTimeout(() => {
                    const cartSidebar = document.getElementById('cartSidebar');
                    if (cartSidebar) {
                        cartSidebar.classList.add('active');
                    }
                }, 300);
            });
        }
        
        // Listen for cart updates to refresh modal count
        const originalAddItem = window.cart?.addItem;
        if (window.cart && originalAddItem) {
            window.cart.addItem = function(item) {
                originalAddItem.call(this, item);
                updateModalCartCount();
            };
        }
        
        // Debug: Check if menu content was actually rendered
        setTimeout(() => {
            const menuContainer = document.getElementById('menuCategoriesContainer');
            if (menuContainer) {
                console.log('✓ Menu container found and rendered successfully');
            }
        }, 100);
        
        // Check if Bootstrap is available
        if (typeof bootstrap === 'undefined') {
            console.warn('Bootstrap not found, using fallback modal display');
            // Fallback: show modal without Bootstrap
            modal.classList.add('show');
            modal.style.display = 'block';
            modal.setAttribute('role', 'dialog');
            modal.setAttribute('aria-modal', 'true');
            
            // Add backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            document.body.appendChild(backdrop);
            document.body.classList.add('modal-open');
            
            // Close button handlers
            const closeButtons = modal.querySelectorAll('.btn-close, [data-bs-dismiss="modal"]');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    setTimeout(() => {
                        modal.remove();
                        backdrop.remove();
                        document.body.classList.remove('modal-open');
                    }, 150);
                });
            });
            
            // Click backdrop to close
            backdrop.addEventListener('click', () => {
                modal.classList.remove('show');
                modal.style.display = 'none';
                setTimeout(() => {
                    modal.remove();
                    backdrop.remove();
                    document.body.classList.remove('modal-open');
                }, 150);
            });
            
            console.log('✓ Modal shown with fallback (no Bootstrap)');
            return;
        }
        
        try {
            const bsModal = new bootstrap.Modal(modal, {
                backdrop: 'static',  // Prevent closing when clicking outside
                keyboard: true,      // Allow ESC key to close
                focus: true
            });
            
            // Prevent immediate closing
            modal.addEventListener('hide.bs.modal', (e) => {
                console.log('Modal hide event triggered');
            });
            
            modal.addEventListener('hidden.bs.modal', (e) => {
                console.log('Modal hidden event triggered');
            });
            
            bsModal.show();
            console.log('✓ Modal shown successfully with Bootstrap');
            
            // Store modal instance
            modal._bsModal = bsModal;
            
        } catch (error) {
            console.error('Error showing modal with Bootstrap:', error);
            // Try fallback
            modal.classList.add('show');
            modal.style.display = 'block';
            console.log('Fell back to manual display');
        }

        // Cleanup on hide - but don't auto-remove
        modal.addEventListener('hidden.bs.modal', () => {
            console.log('Modal hidden, removing from DOM');
            setTimeout(() => modal.remove(), 100);
        });
    }

    renderCategories(categories) {
        if (!categories || categories.length === 0) {
            return '<p class="text-center text-muted py-5">No menu items available</p>';
        }
        
        let html = '<div style="padding: 1.5rem;">';
        
        categories.forEach((category, index) => {
            html += `
                <div style="margin-bottom: 2.5rem;">
                    <h3 style="color: #ff6b35; font-size: 1.5rem; font-weight: 600; margin-bottom: 1.25rem; padding-bottom: 0.75rem; border-bottom: 2px solid #ff6b35; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-utensils"></i> ${category.name}
                    </h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.25rem;">
            `;
            
            category.items.forEach(item => {
                const popularBadge = item.popular ? '<span style="position: absolute; top: 10px; right: 10px; background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; box-shadow: 0 2px 8px rgba(255,107,53,0.3);"><i class="fas fa-fire"></i> Popular</span>' : '';
                
                html += `
                    <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer; position: relative;" 
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.15)';" 
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)';">
                        ${popularBadge}
                        <img src="${item.image}" alt="${item.name}" 
                             style="width: 100%; height: 200px; object-fit: cover; display: block;">
                        <div style="padding: 1.25rem;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                                <h4 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: #2b2d42; line-height: 1.3; flex: 1;">${item.name}</h4>
                                <span style="font-size: 1.25rem; font-weight: 700; color: #ff6b35; white-space: nowrap; margin-left: 0.75rem;">৳${item.price}</span>
                            </div>
                            <p style="color: #6c757d; font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem;">${item.description}</p>
                            <button class="add-to-cart" 
                                    data-id="${item.id}" 
                                    data-name="${item.name}" 
                                    data-price="${item.price}"
                                    data-image="${item.image}"
                                    style="width: 100%; background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.5rem;"
                                    onmouseover="this.style.background='linear-gradient(135deg, #f7931e, #ff6b35)'; this.style.transform='scale(1.02)';" 
                                    onmouseout="this.style.background='linear-gradient(135deg, #ff6b35, #f7931e)'; this.style.transform='scale(1)';">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                `;
            });
            
            html += `
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        return html;
    }


}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, initializing RestaurantMenuModal...');
    try {
        window.restaurantMenuModal = new RestaurantMenuModal();
        console.log('RestaurantMenuModal instance created and stored in window.restaurantMenuModal');
        
        // Test function
        window.testMenu = function(id) {
            console.log('Testing menu for ID:', id);
            window.restaurantMenuModal.showMenu(id);
        };
        
        console.log('✓ Menu system ready. Type testMenu(1) to test.');
    } catch (error) {
        console.error('Error initializing RestaurantMenuModal:', error);
    }
});

// Also try immediate initialization if DOM is already loaded
if (document.readyState !== 'loading') {
    console.log('Document already loaded, initializing immediately...');
    try {
        window.restaurantMenuModal = new RestaurantMenuModal();
    } catch (error) {
        console.error('Error in immediate initialization:', error);
    }
}

// Add hover effect style for menu items
const menuStyle = document.createElement('style');
menuStyle.textContent = `
    .hover-shadow:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    
    .modal.show {
        display: block !important;
    }
    
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: #000;
    }
    
    .modal-backdrop.show {
        opacity: 0.5;
    }
    
    body.modal-open {
        overflow: hidden;
    }
    
    /* Fix for menu items visibility */
    #restaurantMenuModal .modal-body {
        max-height: 70vh !important;
        overflow-y: auto !important;
        display: block !important;
        position: relative !important;
    }
    
    #menuCategoriesContainer {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        min-height: 200px !important;
        padding: 20px !important;
    }
    
    #menuCategoriesContainer .menu-category {
        display: block !important;
        visibility: visible !important;
        margin-bottom: 2rem !important;
    }
    
    #menuCategoriesContainer .row {
        display: flex !important;
        flex-wrap: wrap !important;
        margin: 0 -0.5rem !important;
    }
    
    #menuCategoriesContainer .col-md-6 {
        display: block !important;
        visibility: visible !important;
        padding: 0.5rem !important;
    }
    
    .menu-item-card-modal {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .menu-category h5 {
        display: block !important;
        visibility: visible !important;
    }
`;
document.head.appendChild(menuStyle);

console.log('✓ restaurant-menu.js loaded successfully');
