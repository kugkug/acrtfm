<!-- Tech Dispatch Header Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <!-- Brand/Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('tech-dispatch') }}">
            <i class="fa-solid fa-truck-fast me-2"></i>
            <span class="d-none d-sm-inline">Tech Dispatch</span>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#techDispatchNav" 
                aria-controls="techDispatchNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="techDispatchNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('tech-dispatch') }}">
                        <i class="fa-solid fa-chart-line me-2"></i>
                        <span class="d-none d-lg-inline">Dashboard</span>
                    </a>
                </li>

                <!-- Customers -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('tech-dispatch.customers') }}">
                        <i class="fa-solid fa-users me-2"></i>
                        <span class="d-none d-lg-inline">Customers</span>
                    </a>
                </li>

                <!-- Work Orders -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('tech-dispatch.work-orders') }}">
                        <i class="fa-solid fa-clipboard-list me-2"></i>
                        <span class="d-none d-lg-inline">Work Orders</span>
                    </a>
                </li>

                <!-- Quotes -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('tech-dispatch.quotes') }}">
                        <i class="fa-solid fa-file-invoice-dollar me-2"></i>
                        <span class="d-none d-lg-inline">Quotes</span>
                    </a>
                </li>

                <!-- Calendar -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('tech-dispatch.calendar') }}">
                        <i class="fa-solid fa-calendar-days me-2"></i>
                        <span class="d-none d-lg-inline">Calendar</span>
                    </a>
                </li>
            </ul>

            <!-- Right Side Actions -->
            <ul class="navbar-nav">
                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread notifications</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                        <li><h6 class="dropdown-header">Notifications</h6></li>
                        <li><a class="dropdown-item" href="#">New work order assigned</a></li>
                        <li><a class="dropdown-item" href="#">Customer quote approved</a></li>
                        <li><a class="dropdown-item" href="#">Schedule conflict detected</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">View all notifications</a></li>
                    </ul>
                </li>

                <!-- User Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" 
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-circle me-2"></i>
                        <span class="d-none d-sm-inline">Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fa-solid fa-user me-2"></i>Profile</a></li>
                        {{-- <li><a class="dropdown-item" href="#"><i class="fa-solid fa-cog me-2"></i>Settings</a></li> --}}
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Additional CSS for Tech Dispatch Header -->
<style>
    .navbar-brand {
        font-weight: 600;
        font-size: 1.25rem;
    }
    
    .nav-link {
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 0.375rem;
        margin: 0 0.25rem;
    }
    
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-1px);
    }
    
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        font-weight: 600;
    }
    
    .navbar-nav .nav-item {
        position: relative;
    }
    
    /* Mobile specific styles */
    @media (max-width: 991.98px) {
        .navbar-nav .nav-link {
            padding: 0.75rem 1rem;
            justify-content: center;
        }
        
        .navbar-nav .nav-link i {
            font-size: 1.25rem;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    }
    
    /* Desktop specific styles */
    @media (min-width: 992px) {
        .nav-link {
            padding: 0.5rem 1rem;
        }
        
        .nav-link i {
            font-size: 1rem;
        }
    }
    
    /* Badge positioning for notifications */
    .badge {
        font-size: 0.65rem;
        min-width: 1.2rem;
        height: 1.2rem;
        line-height: 1.2rem;
    }
    
    /* Smooth transitions */
    .navbar-collapse {
        transition: all 0.3s ease;
    }
    
    /* Active state indicator */
    .nav-item.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 2px;
        background-color: #fff;
        border-radius: 1px;
    }
    
    /* Dropdown menu styling */
    .dropdown-menu {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
        padding: 0.5rem 0;
        min-width: 200px;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #007bff;
        transform: translateX(5px);
    }
    
    .dropdown-item i {
        width: 16px;
        text-align: center;
    }
    
    .dropdown-divider {
        margin: 0.5rem 0;
        border-color: #e9ecef;
    }
    
    /* Dropdown toggle arrow */
    .dropdown-toggle::after {
        margin-left: 0.5rem;
        vertical-align: middle;
    }
    
    /* Mobile dropdown adjustments */
    @media (max-width: 991.98px) {
        .dropdown-menu {
            position: static !important;
            transform: none !important;
            box-shadow: none;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
        }
        
        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            transform: none;
        }
    }
</style>

<!-- JavaScript for active state management -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get current page URL
    const currentPath = window.location.pathname;
    
    // Remove active class from all nav items
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Add active class to current page nav item and parent dropdown
    const navLinks = document.querySelectorAll('.nav-link, .dropdown-item');
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && (href === currentPath || 
            (currentPath.includes('tech-dispatch') && href.includes('tech-dispatch')))) {
            
            // If it's a dropdown item, also activate the parent dropdown
            if (link.classList.contains('dropdown-item')) {
                const parentDropdown = link.closest('.dropdown');
                if (parentDropdown) {
                    parentDropdown.classList.add('active');
                }
            } else {
                link.closest('.nav-item').classList.add('active');
            }
        }
    });
    
    // Handle mobile menu toggle
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navbarToggler.contains(event.target) && !navbarCollapse.contains(event.target)) {
                navbarCollapse.classList.remove('show');
            }
        });
    }
    
    // Handle dropdown hover effects on desktop
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        if (toggle && menu) {
            // Show dropdown on hover for desktop
            dropdown.addEventListener('mouseenter', function() {
                if (window.innerWidth >= 992) {
                    menu.classList.add('show');
                }
            });
            
            dropdown.addEventListener('mouseleave', function() {
                if (window.innerWidth >= 992) {
                    menu.classList.remove('show');
                }
            });
        }
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
});
</script>
