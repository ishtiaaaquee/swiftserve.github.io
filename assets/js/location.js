/**
 * Leaflet Maps Location Selector
 * Handles address search and geolocation with OpenStreetMap
 */

let map;
let marker;
let geocoder;

// Initialize autocomplete (not needed for Leaflet, but keeping for compatibility)
function initAutocomplete() {
    const input = document.getElementById('deliveryAddress');
    if (!input) return;
    
    // Simple input handler for manual address entry
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            searchAddress(input.value);
        }
    });
}

// Initialize Map in Modal
function initMap(lat, lng) {
    // Remove existing map if any
    if (map) {
        map.remove();
    }

    // Create map
    map = L.map('map').setView([lat, lng], 15);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // Add draggable marker
    marker = L.marker([lat, lng], {
        draggable: true,
        autoPan: true
    }).addTo(map);

    // Update address when marker is dragged
    marker.on('dragend', function(e) {
        const position = marker.getLatLng();
        reverseGeocode(position.lat, position.lng);
    });

    // Initial reverse geocode
    reverseGeocode(lat, lng);
}

// Reverse geocode to get address from coordinates
function reverseGeocode(lat, lng) {
    const addressDisplay = document.getElementById('mapSelectedAddress');
    addressDisplay.textContent = 'Detecting location...';
    
    // Use Nominatim API for reverse geocoding
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`, {
        headers: {
            'User-Agent': 'SwiftServe Food Delivery App'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Geocoding service unavailable');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.display_name) {
                const address = data.display_name;
                addressDisplay.textContent = address;
                
                // Store temporary coordinates
                window.tempLat = lat;
                window.tempLng = lng;
                window.tempAddress = address;
            } else {
                // Fallback to generic address
                const fallbackAddress = `Location: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                addressDisplay.textContent = fallbackAddress;
                window.tempLat = lat;
                window.tempLng = lng;
                window.tempAddress = fallbackAddress;
            }
        })
        .catch(error => {
            console.error('Geocoding error:', error);
            // Set fallback address instead of error
            const fallbackAddress = `Custom Location (${lat.toFixed(4)}, ${lng.toFixed(4)})`;
            addressDisplay.textContent = fallbackAddress;
            window.tempLat = lat;
            window.tempLng = lng;
            window.tempAddress = fallbackAddress;
        });
}

// Search for address
function searchAddress(address) {
    if (!address) return;
    
    showNotification('Searching for address...', 'info');
    
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1`)
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
                const result = data[0];
                const lat = parseFloat(result.lat);
                const lng = parseFloat(result.lon);
                
                displaySelectedLocation(result.display_name);
                
                localStorage.setItem('deliveryAddress', result.display_name);
                localStorage.setItem('deliveryLat', lat);
                localStorage.setItem('deliveryLng', lng);
                
                showNotification('Address found!', 'success');
            } else {
                showNotification('Address not found. Please try again.', 'warning');
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            showNotification('Error searching address', 'error');
        });
}

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    const getCurrentLocationBtn = document.getElementById('getCurrentLocation');
    const findFoodBtn = document.getElementById('findFoodBtn');
    const confirmLocationBtn = document.getElementById('confirmLocation');
    
    if (getCurrentLocationBtn) {
        getCurrentLocationBtn.addEventListener('click', openMapModal);
    }
    
    if (findFoodBtn) {
        findFoodBtn.addEventListener('click', handleFindFood);
    }

    if (confirmLocationBtn) {
        confirmLocationBtn.addEventListener('click', confirmMapLocation);
    }
    
    // Load saved location
    loadSavedLocation();
    
    // Initialize autocomplete
    initAutocomplete();
});

function openMapModal() {
    const mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
    mapModal.show();

    // Get current location
    if (navigator.geolocation) {
        showNotification('Detecting your location...', 'info');
        
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                // Initialize map with current location
                setTimeout(() => {
                    initMap(lat, lng);
                }, 500);
                
                showNotification('Location detected! Drag the marker to adjust.', 'success');
            },
            (error) => {
                // Use default location if geolocation fails
                let lat = 23.8103; // Dhaka, Bangladesh
                let lng = 90.4125;
                
                // Try to use saved location
                const savedLat = localStorage.getItem('deliveryLat');
                const savedLng = localStorage.getItem('deliveryLng');
                
                if (savedLat && savedLng) {
                    lat = parseFloat(savedLat);
                    lng = parseFloat(savedLng);
                }
                
                setTimeout(() => {
                    initMap(lat, lng);
                }, 500);
                
                let message = 'Using default location. Drag marker to adjust.';
                if (error.code === error.PERMISSION_DENIED) {
                    message = 'Location permission denied. Please drag the marker to your location.';
                }
                showNotification(message, 'warning');
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    } else {
        // Geolocation not supported
        setTimeout(() => {
            initMap(23.8103, 90.4125);
        }, 500);
        showNotification('Geolocation not supported. Please drag the marker to your location.', 'warning');
    }
}

function confirmMapLocation() {
    if (window.tempAddress && window.tempLat && window.tempLng) {
        // Update input field
        document.getElementById('deliveryAddress').value = window.tempAddress;
        
        // Display selected location
        displaySelectedLocation(window.tempAddress);
        
        // Store location
        localStorage.setItem('deliveryAddress', window.tempAddress);
        localStorage.setItem('deliveryLat', window.tempLat);
        localStorage.setItem('deliveryLng', window.tempLng);
        
        // Close modal
        const mapModal = bootstrap.Modal.getInstance(document.getElementById('mapModal'));
        mapModal.hide();
        
        showNotification('Delivery location confirmed!', 'success');
    } else {
        showNotification('Please wait for location to be detected', 'warning');
    }
}

function displaySelectedLocation(address) {
    const locationInfo = document.getElementById('locationInfo');
    const selectedLocation = document.getElementById('selectedLocation');
    
    if (locationInfo && selectedLocation) {
        selectedLocation.textContent = address;
        locationInfo.style.display = 'block';
    }
}

function loadSavedLocation() {
    const savedAddress = localStorage.getItem('deliveryAddress');
    if (savedAddress) {
        const input = document.getElementById('deliveryAddress');
        if (input) {
            input.value = savedAddress;
            displaySelectedLocation(savedAddress);
        }
    }
}

function handleFindFood() {
    const address = document.getElementById('deliveryAddress').value;
    
    if (!address) {
        showNotification('Please enter your delivery address', 'warning');
        return;
    }
    
    // Scroll to restaurants section
    const restaurantsSection = document.getElementById('restaurants');
    if (restaurantsSection) {
        restaurantsSection.scrollIntoView({ behavior: 'smooth' });
        showNotification('Showing available restaurants in your area', 'success');
    }
}

function showNotification(message, type = 'info') {
    // Remove existing notification
    const existing = document.querySelector('.location-notification');
    if (existing) {
        existing.remove();
    }

    // Create notification
    const notification = document.createElement('div');
    notification.className = `location-notification location-notification-${type}`;
    
    const icons = {
        success: 'check-circle',
        error: 'exclamation-circle',
        warning: 'exclamation-triangle',
        info: 'info-circle'
    };
    
    notification.innerHTML = `
        <i class="fas fa-${icons[type]} me-2"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => notification.classList.add('show'), 10);
    
    // Hide and remove after 4 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}
