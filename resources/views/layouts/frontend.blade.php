<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vedic Botanica - @yield('title', 'Ecommerce')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="font-sans antialiased text-text-main bg-white" x-data="{ mobileMenuOpen: false }">
    
    <!-- Top Header / Nav -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Vedic Botanica Logo" class="h-16 w-auto object-contain">
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ url('/') }}" class="text-sm font-medium hover:text-primary transition-colors uppercase tracking-wider {{ request()->is('/') ? 'text-primary' : 'text-text-main' }}">Home</a>
                    <a href="{{ url('/about') }}" class="text-sm font-medium hover:text-primary transition-colors uppercase tracking-wider {{ request()->is('about') ? 'text-primary' : 'text-text-main' }}">About Us</a>
                    <a href="{{ url('/shop') }}" class="text-sm font-medium hover:text-primary transition-colors uppercase tracking-wider {{ request()->is('shop') ? 'text-primary' : 'text-text-main' }}">Shop</a>
                    <a href="{{ url('/contact') }}" class="text-sm font-medium hover:text-primary transition-colors uppercase tracking-wider {{ request()->is('contact') ? 'text-primary' : 'text-text-main' }}">Contact Us</a>
                </nav>

                <!-- Icons -->
                <div class="flex items-center space-x-4 md:space-x-6">
                    @auth
                        <!-- Authenticated User Dropdown -->
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="text-gray-600 hover:text-primary transition-colors flex items-center focus:outline-none">
                                <i class="fa-regular fa-user text-lg"></i>
                                <span class="ml-1.5 text-xs font-semibold font-sans uppercase tracking-wider hidden sm:inline">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
                            </button>
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-md shadow-lg py-1 z-50" style="display: none;">
                                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors font-sans font-medium">My Dashboard</a>
                                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors font-sans font-medium">My Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-red-650 transition-colors font-sans font-medium">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Guest User Icon -->
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary transition-colors">
                            <i class="fa-regular fa-user text-lg"></i>
                        </a>
                    @endauth
                    <a href="{{ url('/wishlist') }}" class="text-gray-600 hover:text-primary transition-colors relative hidden md:inline-block">
                        <i class="fa-regular fa-heart text-lg"></i>
                        <span id="wishlist-count-badge" class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">{{ count(session()->get('wishlist', [])) }}</span>
                    </a>
                    <a href="{{ url('/cart') }}" class="text-gray-600 hover:text-primary transition-colors relative hidden md:inline-block">
                        <i class="fa-solid fa-cart-shopping text-lg"></i>
                        <span id="cart-count-badge" class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">{{ array_sum(array_column(session()->get('cart', []), 'quantity')) }}</span>
                    </a>
                    
                    <!-- Hamburger Menu Button -->
                    <button @click="mobileMenuOpen = true" class="block md:hidden text-gray-600 hover:text-primary transition-colors focus:outline-none" title="Open Menu">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer Menu Overlay -->
    <div x-show="mobileMenuOpen" 
         class="fixed inset-0 z-50 flex md:hidden" 
         role="dialog" aria-modal="true" 
         style="display: none;">
        
        <!-- Backdrop -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/55 backdrop-blur-sm" 
             @click="mobileMenuOpen = false"></div>

        <!-- Drawer Content -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-2xl border-r border-gray-100">
            
            <!-- Close Button Header -->
            <div class="flex px-4 pt-5 pb-3 justify-between items-center border-b border-gray-50 bg-[#fdfaf6]">
                <img src="{{ asset('images/logo.png') }}" alt="Vedic Botanica Logo" class="h-12 w-auto object-contain">
                <button type="button" @click="mobileMenuOpen = false" class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-400 hover:text-gray-900 border border-gray-100 shadow-sm focus:outline-none">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Links -->
            <div class="space-y-6 px-6 py-6 border-b border-gray-100">
                <a href="{{ url('/') }}" @click="mobileMenuOpen = false" class="block text-base font-serif font-bold text-gray-900 hover:text-primary transition-colors">Home</a>
                <a href="{{ url('/about') }}" @click="mobileMenuOpen = false" class="block text-base font-serif font-bold text-gray-900 hover:text-primary transition-colors">About Us</a>
                <a href="{{ url('/shop') }}" @click="mobileMenuOpen = false" class="block text-base font-serif font-bold text-gray-900 hover:text-primary transition-colors">Shop</a>
                <a href="{{ url('/contact') }}" @click="mobileMenuOpen = false" class="block text-base font-serif font-bold text-gray-900 hover:text-primary transition-colors">Contact Us</a>
            </div>

            <div class="space-y-6 px-6 py-6">
                @auth
                    <p class="text-[10px] font-sans font-bold text-gray-400 uppercase tracking-widest">Account Area</p>
                    <a href="{{ url('/dashboard') }}" @click="mobileMenuOpen = false" class="block text-sm font-medium text-gray-700 hover:text-primary transition-colors">My Dashboard</a>
                    <a href="{{ url('/profile') }}" @click="mobileMenuOpen = false" class="block text-sm font-medium text-gray-700 hover:text-primary transition-colors">My Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="block w-full text-left text-sm font-medium text-red-650 hover:text-red-800 transition-colors">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-primary transition-colors">
                        <i class="fa-regular fa-user text-base"></i>
                        <span>Log In / Register</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile Sticky Bottom Nav Bar -->
    @if(!request()->is('product/*') && !request()->is('checkout') && !request()->is('checkout/*'))
    <div class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-gray-150/70 shadow-[0_-4px_12px_rgba(0,0,0,0.05)] md:hidden flex justify-around items-center h-16 px-2 pb-safe-bottom">
        <a href="{{ url('/') }}" class="flex flex-col items-center justify-center w-12 text-center transition-colors {{ request()->is('/') ? 'text-primary' : 'text-gray-500' }}">
            <i class="fa-solid fa-house text-lg"></i>
            <span class="text-[9px] font-sans font-medium mt-0.5">Home</span>
        </a>
        <a href="{{ url('/shop') }}" class="flex flex-col items-center justify-center w-12 text-center transition-colors {{ request()->is('shop') ? 'text-primary' : 'text-gray-500' }}">
            <i class="fa-solid fa-store text-lg"></i>
            <span class="text-[9px] font-sans font-medium mt-0.5">Shop</span>
        </a>
        <a href="{{ url('/wishlist') }}" class="flex flex-col items-center justify-center w-12 text-center transition-colors relative {{ request()->is('wishlist') ? 'text-primary' : 'text-gray-500' }}">
            <i class="fa-regular fa-heart text-lg"></i>
            <span id="wishlist-count-badge-mobile" class="absolute top-1.5 right-2 bg-primary text-white text-[8px] font-bold rounded-full h-3.5 w-3.5 flex items-center justify-center">{{ count(session()->get('wishlist', [])) }}</span>
            <span class="text-[9px] font-sans font-medium mt-0.5">Wishlist</span>
        </a>
        <a href="{{ url('/cart') }}" class="flex flex-col items-center justify-center w-12 text-center transition-colors relative {{ request()->is('cart') ? 'text-primary' : 'text-gray-500' }}">
            <i class="fa-solid fa-cart-shopping text-lg"></i>
            <span id="cart-count-badge-mobile" class="absolute top-1.5 right-2 bg-primary text-white text-[8px] font-bold rounded-full h-3.5 w-3.5 flex items-center justify-center">{{ array_sum(array_column(session()->get('cart', []), 'quantity')) }}</span>
            <span class="text-[9px] font-sans font-medium mt-0.5">Cart</span>
        </a>
    </div>
    @endif

    <!-- Main Content -->
    <main class="pb-16 md:pb-0">
        @if (session('success') || session('error') || session('warning') || session('status'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                        <span>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="bg-yellow-50 border border-yellow-250 text-yellow-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                        <span>{{ session('warning') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-yellow-600 hover:text-yellow-800 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                @endif
                @if (session('status'))
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                        <span>{{ session('status') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-blue-500 hover:text-blue-700 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-secondary text-white pt-16 pb-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                
                <!-- About -->
                <div>
                    <h3 class="text-lg font-bold mb-4 font-serif">About Our Store</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Welcome to Vedic Botanica – a place where spirituality meets authenticity. We are dedicated to providing genuine, certified, and high-quality premium gou dhoop sticks that bring positivity, balance, and inner peace into your life.
                    </p>
                    <h4 class="text-md font-bold mb-3 font-serif">Follow Us</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="bg-gray-700 hover:bg-primary h-8 w-8 rounded-full flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-primary h-8 w-8 rounded-full flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4 font-serif">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="/" class="text-gray-400 hover:text-primary text-sm transition-colors">Home</a></li>
                        <li><a href="/about" class="text-gray-400 hover:text-primary text-sm transition-colors">About Us</a></li>
                        <li><a href="/shop" class="text-gray-400 hover:text-primary text-sm transition-colors">Shop</a></li>
                        <li><a href="/contact" class="text-gray-400 hover:text-primary text-sm transition-colors">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Helpful Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4 font-serif">Helpful Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-primary text-sm transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-primary text-sm transition-colors">Terms & Conditions</a></li>
                        <li><a href="{{ route('refund') }}" class="text-gray-400 hover:text-primary text-sm transition-colors">Refund Policy</a></li>
                        <li><a href="{{ route('cancellation') }}" class="text-gray-400 hover:text-primary text-sm transition-colors">Cancellation Policy</a></li>
                        <li><a href="{{ route('shipping') }}" class="text-gray-400 hover:text-primary text-sm transition-colors">Shipping Policy</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-bold mb-4 font-serif">Contact Us</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fa-solid fa-phone mt-1 mr-3 text-gray-400 text-sm"></i>
                            <span class="text-gray-400 text-sm">+91 9915978757</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-envelope mt-1 mr-3 text-gray-400 text-sm"></i>
                            <span class="text-gray-400 text-sm">info@vedicbotanica.com</span>
                        </li>
                    </ul>
                </div>

            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 flex justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; 2026 Vedic Botanica All Right Reserved | Created by <a href="https://vivektech.online/index.html" target="_blank" class="text-gray-400 hover:text-white transition-colors underline font-medium">VivekTech</a></p>
                <div class="fixed bottom-6 right-6">
                    <a href="https://wa.me/919915978757" target="_blank" class="bg-green-500 hover:bg-green-600 text-white h-14 w-14 rounded-full flex items-center justify-center shadow-lg transition-transform hover:scale-110">
                        <i class="fa-brands fa-whatsapp text-3xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Quick View Modal -->
    <div id="quickview-modal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-2xl max-w-4xl w-full overflow-hidden shadow-2xl relative border border-gray-100 flex flex-col md:flex-row transform scale-95 transition-transform duration-300">
            <!-- Close Button -->
            <button id="close-quickview" class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 transition-colors z-20 h-10 w-10 flex items-center justify-center rounded-full bg-gray-50 hover:bg-gray-100"><i class="fa-solid fa-xmark text-lg"></i></button>
            
            <!-- Modal Body Image -->
            <div class="w-full md:w-1/2 bg-gray-50 flex items-center justify-center p-8 relative">
                <img id="qv-image" src="" alt="" class="max-h-80 object-contain">
                <span id="qv-sale-badge" class="absolute top-4 left-4 bg-red-500 text-white text-[10px] uppercase font-bold px-2 py-1 rounded hidden">Sale</span>
            </div>
            
            <!-- Modal Body Content -->
            <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
                <p id="qv-category" class="text-xs text-primary uppercase font-bold tracking-widest mb-1"></p>
                <h2 id="qv-name" class="text-2xl font-serif font-bold text-gray-900 mb-3"></h2>
                
                <div class="mb-4">
                    <span id="qv-price-del" class="text-lg text-gray-400 line-through mr-3 hidden"></span>
                    <span id="qv-price" class="text-2xl font-bold text-primary"></span>
                </div>
                
                <p id="qv-description" class="text-gray-500 text-sm mb-6 leading-relaxed"></p>
                
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <div class="flex items-center border border-gray-200 rounded">
                        <button type="button" id="qv-qty-minus" class="w-10 h-10 text-gray-600 hover:bg-gray-100 transition"><i class="fa-solid fa-minus text-xs"></i></button>
                        <input type="number" id="qv-qty-input" class="w-12 h-10 text-center border-none focus:ring-0 text-sm text-gray-900" value="1" min="1">
                        <button type="button" id="qv-qty-plus" class="w-10 h-10 text-gray-600 hover:bg-gray-100 transition"><i class="fa-solid fa-plus text-xs"></i></button>
                    </div>
                    <button type="button" id="qv-add-to-cart" class="flex-1 bg-primary hover:bg-primary-dark text-white font-bold py-3 rounded tracking-wider text-xs shadow transition-colors" style="background-color: #C49A6C; color: white;">
                        ADD TO CART
                    </button>
                </div>
                
                <a id="qv-view-details" href="" class="text-xs text-center text-gray-500 hover:text-primary transition underline font-medium">View Full Details</a>
            </div>
        </div>
    </div>

    <!-- Premium Toast Notification -->
    <div id="toast-notification" class="fixed bottom-6 left-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 bg-white border border-gray-150 rounded-lg p-4 shadow-xl flex items-center space-x-3 max-w-sm w-full pointer-events-none">
        <div id="toast-icon-wrapper" class="bg-green-50 text-green-500 p-2 rounded-full flex items-center justify-center">
            <i id="toast-icon" class="fa-solid fa-check text-lg"></i>
        </div>
        <div>
            <p id="toast-message" class="text-sm font-semibold text-gray-900"></p>
        </div>
    </div>

    <!-- Global Javascript handlers -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // --- Toast Notification Handler ---
            function showToast(message, isSuccess = true) {
                const toast = document.getElementById('toast-notification');
                const toastMsg = document.getElementById('toast-message');
                const iconWrapper = document.getElementById('toast-icon-wrapper');
                const icon = document.getElementById('toast-icon');

                toastMsg.textContent = message;

                if (isSuccess) {
                    iconWrapper.className = 'bg-green-50 text-green-500 p-2 rounded-full flex items-center justify-center';
                    icon.className = 'fa-solid fa-check text-lg';
                } else {
                    iconWrapper.className = 'bg-red-50 text-red-500 p-2 rounded-full flex items-center justify-center';
                    icon.className = 'fa-solid fa-exclamation text-lg';
                }

                toast.classList.remove('translate-y-20', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');

                setTimeout(() => {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('translate-y-20', 'opacity-0');
                }, 3000);
            }

            // --- Wishlist Handler ---
            document.body.addEventListener('click', function(e) {
                const wishlistBtn = e.target.closest('.btn-wishlist');
                if (wishlistBtn) {
                    const productId = wishlistBtn.getAttribute('data-product-id');
                    
                    fetch('/wishlist/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ product_id: productId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Update badge
                            const wishlistBadge = document.getElementById('wishlist-count-badge');
                            if (wishlistBadge) wishlistBadge.textContent = data.wishlist_count;
                            const wishlistBadgeMobile = document.getElementById('wishlist-count-badge-mobile');
                            if (wishlistBadgeMobile) wishlistBadgeMobile.textContent = data.wishlist_count;

                            // Toggle Icon (fa-regular <-> fa-solid)
                            const icon = wishlistBtn.querySelector('i');
                            if (data.in_wishlist) {
                                icon.className = 'fa-solid fa-heart';
                                wishlistBtn.classList.remove('text-gray-800');
                                wishlistBtn.classList.add('text-red-500');
                            } else {
                                icon.className = 'fa-regular fa-heart';
                                wishlistBtn.classList.remove('text-red-500');
                                wishlistBtn.classList.add('text-gray-800');

                                // If we are on the wishlist page itself, remove the card item
                                const card = e.target.closest('.product-wishlist-card');
                                if (card) {
                                    card.remove();
                                    // If no cards left, reload to show empty view
                                    if (document.querySelectorAll('.product-wishlist-card').length === 0) {
                                        location.reload();
                                    }
                                }
                            }
                            showToast(data.message);
                        } else {
                            showToast(data.message || 'Something went wrong.', false);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showToast('Error connecting to server.', false);
                    });
                }
            });

            // --- Add to Cart Handler (Grid Cards) ---
            document.body.addEventListener('click', function(e) {
                const addCartBtn = e.target.closest('.btn-add-to-cart');
                if (addCartBtn) {
                    const productId = addCartBtn.getAttribute('data-product-id');
                    
                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ product_id: productId, quantity: 1 })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const cartBadge = document.getElementById('cart-count-badge');
                            if (cartBadge) cartBadge.textContent = data.cart_count;
                            const cartBadgeMobile = document.getElementById('cart-count-badge-mobile');
                            if (cartBadgeMobile) cartBadgeMobile.textContent = data.cart_count;
                            showToast(data.message);
                        } else {
                            showToast(data.message || 'Could not add to cart.', false);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showToast('Error connecting to server.', false);
                    });
                }
            });

            // --- Product Details Quantity Controls ---
            const qtyInput = document.getElementById('qty-input');
            const qtyPlus = document.getElementById('qty-plus');
            const qtyMinus = document.getElementById('qty-minus');

            if (qtyPlus && qtyMinus && qtyInput) {
                qtyPlus.addEventListener('click', () => {
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                });
                qtyMinus.addEventListener('click', () => {
                    let val = parseInt(qtyInput.value) - 1;
                    if (val < 1) val = 1;
                    qtyInput.value = val;
                });
            }

            // --- Product Details Add to Cart ---
            const detailAddCart = document.getElementById('detail-add-to-cart');
            if (detailAddCart) {
                detailAddCart.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const qty = qtyInput ? parseInt(qtyInput.value) : 1;

                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ product_id: productId, quantity: qty })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const cartBadge = document.getElementById('cart-count-badge');
                            if (cartBadge) cartBadge.textContent = data.cart_count;
                            const cartBadgeMobile = document.getElementById('cart-count-badge-mobile');
                            if (cartBadgeMobile) cartBadgeMobile.textContent = data.cart_count;
                            showToast(data.message);
                        } else {
                            showToast(data.message, false);
                        }
                    })
                    .catch(err => console.error(err));
                });
            }

            // --- Product Details Buy Now ---
            const detailBuyNow = document.getElementById('detail-buy-now');
            if (detailBuyNow) {
                detailBuyNow.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const qty = qtyInput ? parseInt(qtyInput.value) : 1;

                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ product_id: productId, quantity: qty })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = '/cart';
                        } else {
                            showToast(data.message, false);
                        }
                    })
                    .catch(err => console.error(err));
                });
            }

            // --- Quick View Modal Handler ---
            const qvModal = document.getElementById('quickview-modal');
            const qvImage = document.getElementById('qv-image');
            const qvSaleBadge = document.getElementById('qv-sale-badge');
            const qvCategory = document.getElementById('qv-category');
            const qvName = document.getElementById('qv-name');
            const qvPriceDel = document.getElementById('qv-price-del');
            const qvPrice = document.getElementById('qv-price');
            const qvDescription = document.getElementById('qv-description');
            const qvQtyInput = document.getElementById('qv-qty-input');
            const qvAddToCartBtn = document.getElementById('qv-add-to-cart');
            const qvViewDetails = document.getElementById('qv-view-details');
            const closeQvBtn = document.getElementById('close-quickview');

            let activeQvProductId = null;

            // Trigger Quick View
            document.body.addEventListener('click', function(e) {
                const quickViewBtn = e.target.closest('.btn-quickview');
                if (quickViewBtn) {
                    const slug = quickViewBtn.getAttribute('data-product-slug');
                    
                    fetch('/api/product/' + slug)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const p = data.product;
                            activeQvProductId = p.id;

                            // Populate details
                            qvImage.src = p.image;
                            qvImage.alt = p.name;
                            qvCategory.textContent = p.category_name;
                            qvName.textContent = p.name;
                            qvDescription.textContent = p.short_description || p.description;
                            qvQtyInput.value = 1;

                            // Price displaying
                            if (p.sale_price) {
                                qvPriceDel.textContent = '₹' + parseFloat(p.price).toFixed(2);
                                qvPriceDel.classList.remove('hidden');
                                qvPrice.textContent = '₹' + parseFloat(p.sale_price).toFixed(2);
                                qvSaleBadge.classList.remove('hidden');
                            } else {
                                qvPriceDel.classList.add('hidden');
                                qvPrice.textContent = '₹' + parseFloat(p.price).toFixed(2);
                                qvSaleBadge.classList.add('hidden');
                            }

                            // View detail link
                            qvViewDetails.href = '/product/' + p.slug;

                            // Open Modal
                            qvModal.classList.remove('hidden');
                            setTimeout(() => {
                                qvModal.classList.remove('opacity-0');
                                qvModal.classList.add('opacity-100');
                                qvModal.querySelector('div').classList.remove('scale-95');
                                qvModal.querySelector('div').classList.add('scale-100');
                            }, 50);
                        } else {
                            showToast('Failed to load product details.', false);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showToast('Error connecting to server.', false);
                    });
                }
            });

            // Close Quick View
            function closeQuickView() {
                qvModal.classList.remove('opacity-100');
                qvModal.classList.add('opacity-0');
                qvModal.querySelector('div').classList.remove('scale-100');
                qvModal.querySelector('div').classList.add('scale-95');
                setTimeout(() => {
                    qvModal.classList.add('hidden');
                }, 300);
            }

            if (closeQvBtn) closeQvBtn.addEventListener('click', closeQuickView);
            if (qvModal) {
                qvModal.addEventListener('click', function(e) {
                    if (e.target === qvModal) closeQuickView();
                });
            }

            // Modal Quantity controls
            const qvQtyPlus = document.getElementById('qv-qty-plus');
            const qvQtyMinus = document.getElementById('qv-qty-minus');
            if (qvQtyPlus && qvQtyMinus && qvQtyInput) {
                qvQtyPlus.addEventListener('click', () => {
                    qvQtyInput.value = parseInt(qvQtyInput.value) + 1;
                });
                qvQtyMinus.addEventListener('click', () => {
                    let val = parseInt(qvQtyInput.value) - 1;
                    if (val < 1) val = 1;
                    qvQtyInput.value = val;
                });
            }

            // Modal Add to Cart
            if (qvAddToCartBtn) {
                qvAddToCartBtn.addEventListener('click', function() {
                    if (!activeQvProductId) return;
                    const qty = qvQtyInput ? parseInt(qvQtyInput.value) : 1;

                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ product_id: activeQvProductId, quantity: qty })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const cartBadge = document.getElementById('cart-count-badge');
                            if (cartBadge) cartBadge.textContent = data.cart_count;
                            const cartBadgeMobile = document.getElementById('cart-count-badge-mobile');
                            if (cartBadgeMobile) cartBadgeMobile.textContent = data.cart_count;
                            showToast(data.message);
                            closeQuickView();
                        } else {
                            showToast(data.message, false);
                        }
                    })
                    .catch(err => console.error(err));
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
