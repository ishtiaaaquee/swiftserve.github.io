/**
 * Restaurant Category Filter
 * Filters restaurants by cuisine type
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔍 Restaurant filter script loaded');
    
    const filterButtons = document.querySelectorAll('.filter-btn');
    const restaurantCards = document.querySelectorAll('.restaurant-card');
    
    console.log('Found filter buttons:', filterButtons.length);
    console.log('Found restaurant cards:', restaurantCards.length);
    
    // Add click handlers to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            console.log('Filter clicked:', category);
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter restaurants
            filterRestaurants(category);
        });
    });
    
    function filterRestaurants(category) {
        console.log('🎯 Filtering by category:', category);
        
        restaurantCards.forEach((card, index) => {
            const restaurantCol = card.closest('.col-12');
            const cuisineElement = card.querySelector('.cuisine-type');
            
            if (!cuisineElement) {
                console.error('❌ No cuisine-type element found in card', index);
                return;
            }
            
            const cuisineType = cuisineElement.textContent.trim().toLowerCase();
            console.log(`Restaurant ${index}: cuisine="${cuisineType}"`);
            
            if (category === 'all') {
                // Show all restaurants
                restaurantCol.style.display = 'block';
                setTimeout(() => {
                    restaurantCol.style.opacity = '1';
                    restaurantCol.style.transform = 'scale(1)';
                }, 10);
            } else {
                // Check if cuisine matches the selected category
                const categoryMatch = matchCategory(cuisineType, category);
                console.log(`  Match result: ${categoryMatch}`);
                
                if (categoryMatch) {
                    restaurantCol.style.display = 'block';
                    setTimeout(() => {
                        restaurantCol.style.opacity = '1';
                        restaurantCol.style.transform = 'scale(1)';
                    }, 10);
                } else {
                    restaurantCol.style.opacity = '0';
                    restaurantCol.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        restaurantCol.style.display = 'none';
                    }, 300);
                }
            }
        });
    }
    
    function matchCategory(cuisine, category) {
        // Remove icon and clean text
        cuisine = cuisine.replace(/[^\w\s]/g, '').trim().toLowerCase();
        category = category.toLowerCase();
        
        // Direct match
        if (cuisine.includes(category)) {
            return true;
        }
        
        // Category mappings
        const categoryMap = {
            'biryani': ['biryani', 'biriyani', 'kacchi'],
            'bengali': ['bengali', 'traditional', 'kebab', 'kabab'],
            'fast-food': ['fast food', 'burger', 'american', 'fries'],
            'chinese': ['chinese', 'thai', 'fusion', 'rice'],
            'indian': ['indian', 'north indian', 'tandoor'],
            'desserts': ['desserts', 'chocolate', 'sweet']
        };
        
        if (categoryMap[category]) {
            return categoryMap[category].some(keyword => cuisine.includes(keyword));
        }
        
        return false;
    }
    
    // Add transition styles to restaurant cards
    restaurantCards.forEach(card => {
        const col = card.closest('.col-12');
        col.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
    });
});
