/**
 * Authentication System
 * Handles user login, signup, and session management
 */

// User authentication state
let currentUser = null;

// Initialize authentication system
document.addEventListener('DOMContentLoaded', () => {
    initAuth();
    setupLoginForm();
    setupSignupForm();
    setupPasswordToggles();
    setupLogout();
    checkAuthState();
});

// Initialize authentication
function initAuth() {
    // Check if user is logged in
    const savedUser = localStorage.getItem('swiftserve_user');
    if (savedUser) {
        currentUser = JSON.parse(savedUser);
        updateUIForLoggedInUser();
    }
}

// Check authentication state
function checkAuthState() {
    return currentUser !== null;
}

// Get current user
function getCurrentUser() {
    return currentUser;
}

// Setup login form
function setupLoginForm() {
    const loginForm = document.getElementById('loginForm');
    if (!loginForm) return;

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;
        const rememberMe = document.getElementById('rememberMe').checked;
        
        // Validate credentials
        if (!email || !password) {
            showAuthNotification('Please fill in all fields', 'error');
            return;
        }

        // Check for admin credentials (trim whitespace)
        if (email.trim() === 'admin@gmail.com' && password.trim() === '12345678') {
            currentUser = {
                name: 'Admin',
                email: 'admin@gmail.com',
                phone: 'Admin Account',
                isAdmin: true,
                loggedInAt: new Date().toISOString()
            };
            
            // Save session
            if (rememberMe) {
                localStorage.setItem('swiftserve_user', JSON.stringify(currentUser));
            } else {
                sessionStorage.setItem('swiftserve_user', JSON.stringify(currentUser));
            }
            
            // Close modal and update UI
            bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
            updateUIForLoggedInUser();
            showAuthNotification('Welcome Admin! You have full access.', 'success');
            
            // Reset form
            loginForm.reset();
            return;
        }

        // Check if user exists in localStorage
        const users = JSON.parse(localStorage.getItem('swiftserve_users') || '[]');
        const user = users.find(u => u.email === email && u.password === password);
        
        if (user) {
            // Successful login
            currentUser = {
                name: user.name,
                email: user.email,
                phone: user.phone,
                loggedInAt: new Date().toISOString()
            };
            
            // Save session
            if (rememberMe) {
                localStorage.setItem('swiftserve_user', JSON.stringify(currentUser));
            } else {
                sessionStorage.setItem('swiftserve_user', JSON.stringify(currentUser));
            }
            
            // Close modal and update UI
            bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
            updateUIForLoggedInUser();
            showAuthNotification('Welcome back, ' + currentUser.name + '!', 'success');
            
            // Reset form
            loginForm.reset();
        } else {
            showAuthNotification('Invalid email or password', 'error');
        }
    });
}

// Setup signup form
function setupSignupForm() {
    const signupForm = document.getElementById('signupForm');
    if (!signupForm) return;

    signupForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const name = document.getElementById('signupName').value;
        const email = document.getElementById('signupEmail').value;
        const phone = document.getElementById('signupPhone').value;
        const password = document.getElementById('signupPassword').value;
        const confirmPassword = document.getElementById('signupConfirmPassword').value;
        const agreeTerms = document.getElementById('agreeTerms').checked;
        
        // Validation
        if (!name || !email || !phone || !password || !confirmPassword) {
            showAuthNotification('Please fill in all fields', 'error');
            return;
        }
        
        if (password.length < 8) {
            showAuthNotification('Password must be at least 8 characters', 'error');
            return;
        }
        
        if (password !== confirmPassword) {
            showAuthNotification('Passwords do not match', 'error');
            return;
        }
        
        if (!agreeTerms) {
            showAuthNotification('Please agree to the terms and conditions', 'error');
            return;
        }
        
        // Check if email already exists
        const users = JSON.parse(localStorage.getItem('swiftserve_users') || '[]');
        if (users.some(u => u.email === email)) {
            showAuthNotification('Email already registered. Please login.', 'error');
            return;
        }
        
        // Create new user
        const newUser = {
            id: Date.now(),
            name: name,
            email: email,
            phone: phone,
            password: password,
            createdAt: new Date().toISOString()
        };
        
        users.push(newUser);
        localStorage.setItem('swiftserve_users', JSON.stringify(users));
        
        // Auto login
        currentUser = {
            name: newUser.name,
            email: newUser.email,
            phone: newUser.phone,
            loggedInAt: new Date().toISOString()
        };
        
        localStorage.setItem('swiftserve_user', JSON.stringify(currentUser));
        
        // Close modal and update UI
        bootstrap.Modal.getInstance(document.getElementById('signupModal')).hide();
        updateUIForLoggedInUser();
        showAuthNotification('Account created successfully! Welcome, ' + currentUser.name + '!', 'success');
        
        // Reset form
        signupForm.reset();
    });
}

// Setup password toggles
function setupPasswordToggles() {
    const toggles = [
        { btn: 'toggleLoginPassword', input: 'loginPassword' },
        { btn: 'toggleSignupPassword', input: 'signupPassword' }
    ];
    
    toggles.forEach(({ btn, input }) => {
        const toggleBtn = document.getElementById(btn);
        const passwordInput = document.getElementById(input);
        
        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', () => {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                toggleBtn.querySelector('i').classList.toggle('fa-eye');
                toggleBtn.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    });
}

// Setup logout
function setupLogout() {
    const logoutBtn = document.getElementById('logoutBtn');
    if (!logoutBtn) return;
    
    logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        logout();
    });
}

// Logout function
function logout() {
    currentUser = null;
    localStorage.removeItem('swiftserve_user');
    sessionStorage.removeItem('swiftserve_user');
    updateUIForLoggedOutUser();
    showAuthNotification('Logged out successfully', 'success');
}

// Update UI for logged in user
function updateUIForLoggedInUser() {
    // Update navigation
    const loginBtnContainer = document.getElementById('loginButtonContainer');
    const userProfileContainer = document.getElementById('userProfileContainer');
    
    if (loginBtnContainer) {
        loginBtnContainer.style.display = 'none';
    }
    
    if (userProfileContainer) {
        userProfileContainer.style.display = 'block';
        
        // Check if admin
        const displayName = currentUser.isAdmin 
            ? '<i class="fas fa-crown text-warning me-1"></i>Admin' 
            : currentUser.name.split(' ')[0];
        
        userProfileContainer.innerHTML = `
            <div class="dropdown">
                <button class="btn btn-user-profile dropdown-toggle" type="button" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-2"></i>
                    <span>${displayName}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuDropdown">
                    ${currentUser.isAdmin ? '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminDashboardModal"><i class="fas fa-tachometer-alt me-2 text-warning"></i>Admin Dashboard</a></li><li><hr class="dropdown-divider"></li>' : ''}
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userProfileModal"><i class="fas fa-user me-2"></i>My Profile</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userProfileModal" data-tab="orders"><i class="fas fa-shopping-bag me-2"></i>My Orders</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userProfileModal" data-tab="favorites"><i class="fas fa-heart me-2"></i>Favorites</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userProfileModal" data-tab="addresses"><i class="fas fa-map-marker-alt me-2"></i>Addresses</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" id="logoutBtn"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        `;
        
        // Re-attach logout listener
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', (e) => {
                e.preventDefault();
                logout();
            });
        }
    }
}

// Update UI for logged out user
function updateUIForLoggedOutUser() {
    const loginBtnContainer = document.getElementById('loginButtonContainer');
    const userProfileContainer = document.getElementById('userProfileContainer');
    
    if (loginBtnContainer) {
        loginBtnContainer.style.display = 'block';
    }
    
    if (userProfileContainer) {
        userProfileContainer.style.display = 'none';
    }
}

// Show authentication notification
function showAuthNotification(message, type = 'info') {
    const existing = document.querySelector('.auth-notification');
    if (existing) {
        existing.remove();
    }

    const notification = document.createElement('div');
    notification.className = `auth-notification auth-notification-${type}`;
    
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
    
    setTimeout(() => notification.classList.add('show'), 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}

// Require authentication before proceeding to checkout
function requireAuth(callback) {
    if (!checkAuthState()) {
        showAuthNotification('Please login to continue', 'warning');
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        return false;
    }
    
    if (callback) {
        callback();
    }
    return true;
}

// Export for use in other files
window.authSystem = {
    checkAuthState,
    getCurrentUser,
    requireAuth,
    logout
};
