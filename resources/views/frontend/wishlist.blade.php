@extends('layouts.frontend')

@section('title', 'My Wishlist')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-3 flex flex-wrap items-center justify-between gap-2 border-b border-gray-200 pb-2">
            <div>
                <h1 class="text-lg font-bold text-slate-900 tracking-tight" style="font-family: 'Outfit', sans-serif;">My Wishlist</h1>
                <p class="text-[10px] md:text-[11px] text-gray-500 mt-0.5">
                    <a href="/" class="hover:text-primary text-black transition">Home</a> / 
                    @auth
                        <a href="/dashboard" class="hover:text-primary text-black transition">Dashboard</a> /
                    @endauth
                    <span class="text-black font-medium">Wishlist</span>
                </p>
            </div>
            <span class="text-[9px] text-primary font-bold bg-primary/10 px-2 py-0.5 rounded uppercase tracking-wider">Favorites</span>
        </div>

        @auth
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Sidebar Navigation (Desktop only) -->
            <div class="hidden lg:block w-full lg:w-1/4">
                <div class="bg-white border border-slate-150 rounded-2xl p-4 shadow-xs space-y-1">
                    <div class="flex items-center space-x-3 mb-3.5 pb-3 border-b border-slate-100">
                        <div class="bg-primary/10 text-primary h-9 w-9 rounded-full flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-xs leading-tight">{{ Auth::user()->name }}</h4>
                            <span class="text-[9px] text-slate-450 font-bold uppercase tracking-widest mt-0.5 block">Customer Portal</span>
                        </div>
                    </div>
                    
                    <a href="{{ url('/dashboard') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('dashboard') ? 'bg-primary/10 text-primary' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('dashboard') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-chart-line mr-2.5 text-sm" style="color: {{ request()->is('dashboard') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Dashboard Overview
                        </span>
                        @if(request()->is('dashboard'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/wishlist') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('wishlist') ? 'bg-primary/10 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('wishlist') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-heart mr-2.5 text-sm" style="color: {{ request()->is('wishlist') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            My Wishlist
                        </span>
                        @if(request()->is('wishlist'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/cart') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('cart') ? 'bg-primary/10 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('cart') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-cart-shopping mr-2.5 text-sm" style="color: {{ request()->is('cart') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            My Shopping Cart
                        </span>
                        @if(request()->is('cart'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('profile') ? 'bg-primary/10 text-primary' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('profile') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-user-gear mr-2.5 text-sm" style="color: {{ request()->is('profile') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Account Settings
                        </span>
                        @if(request()->is('profile'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/contact') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('contact') ? 'bg-primary/10 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('contact') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-headset mr-2.5 text-sm" style="color: {{ request()->is('contact') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Support & Help
                        </span>
                        @if(request()->is('contact'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="pt-2.5 border-t border-slate-100 mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-xl text-xs font-bold text-red-500 hover:bg-red-50 transition-all flex items-center cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2.5 text-sm text-red-400"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile Collapsible Navigation (Mobile only) -->
            <div class="block lg:hidden w-full mb-3.5" x-data="{ expanded: false }">
                <!-- Header trigger bar -->
                <div class="flex items-center justify-between bg-white border border-slate-150 rounded-xl p-2 shadow-xs">
                    <div class="flex items-center gap-2">
                        <div class="bg-primary/10 text-primary h-7 w-7 rounded-full flex items-center justify-center font-bold text-xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Active Page</span>
                            <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                @if(request()->is('dashboard'))
                                    <i class="fa-solid fa-chart-line text-[10px] text-primary"></i> Overview
                                @elseif(request()->is('wishlist'))
                                    <i class="fa-solid fa-heart text-[10px] text-primary"></i> Wishlist
                                @elseif(request()->is('cart'))
                                    <i class="fa-solid fa-cart-shopping text-[10px] text-primary"></i> Cart
                                @elseif(request()->is('profile'))
                                    <i class="fa-solid fa-user-gear text-[10px] text-primary"></i> Profile
                                @elseif(request()->is('contact'))
                                    <i class="fa-solid fa-headset text-[10px] text-primary"></i> Support
                                @else
                                    <i class="fa-solid fa-circle text-[10px] text-primary"></i> Menu
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <!-- Toggle Button -->
                    <button type="button" @click="expanded = !expanded" class="flex items-center gap-1 bg-slate-50 border border-slate-200 hover:bg-slate-100 rounded-lg px-2.5 py-1 text-[10px] font-bold text-slate-700 transition cursor-pointer">
                        <i class="fa-solid fa-bars text-[9px]" x-show="!expanded"></i>
                        <i class="fa-solid fa-xmark text-[9px]" x-show="expanded"></i>
                        <span>Menu</span>
                        <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="expanded ? 'rotate-180' : ''"></i>
                    </button>
                </div>

                <!-- Collapsible Vertical Links Menu -->
                <div x-show="expanded" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-2 bg-white border border-slate-150 rounded-xl p-2 shadow-xs space-y-1"
                     style="display: none;">
                    
                    <a href="{{ url('/dashboard') }}" class="group w-full px-3 py-2 rounded-lg text-xs font-bold transition-all flex items-center justify-between {{ request()->is('dashboard') ? 'bg-primary/10 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('dashboard') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-chart-line mr-2 text-xs" style="color: {{ request()->is('dashboard') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Dashboard Overview
                        </span>
                        @if(request()->is('dashboard'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/wishlist') }}" class="group w-full px-3 py-2 rounded-lg text-xs font-bold transition-all flex items-center justify-between {{ request()->is('wishlist') ? 'bg-primary/10 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('wishlist') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-heart mr-2 text-xs" style="color: {{ request()->is('wishlist') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            My Wishlist
                        </span>
                        @if(request()->is('wishlist'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/cart') }}" class="group w-full px-3 py-2 rounded-lg text-xs font-bold transition-all flex items-center justify-between {{ request()->is('cart') ? 'bg-primary/10 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('cart') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-cart-shopping mr-2 text-xs" style="color: {{ request()->is('cart') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            My Shopping Cart
                        </span>
                        @if(request()->is('cart'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="group w-full px-3 py-2 rounded-lg text-xs font-bold transition-all flex items-center justify-between {{ request()->is('profile') ? 'bg-primary/10 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('profile') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-user-gear mr-2 text-xs" style="color: {{ request()->is('profile') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Account Settings
                        </span>
                        @if(request()->is('profile'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/contact') }}" class="group w-full px-3 py-2 rounded-lg text-xs font-bold transition-all flex items-center justify-between {{ request()->is('contact') ? 'bg-primary/10 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('contact') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-headset mr-2 text-xs" style="color: {{ request()->is('contact') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Support & Help
                        </span>
                        @if(request()->is('contact'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-slate-100 mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-xs font-bold text-red-500 hover:bg-red-50 transition-all flex items-center cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2 text-xs text-red-400"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="w-full lg:w-3/4">
        @else
            <div class="w-full">
        @endauth
            @if($products->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($products as $product)
                    <div class="group border border-gray-200 bg-white rounded-xl p-3 transition-all duration-300 hover:shadow flex flex-col h-full product-wishlist-card" data-id="{{ $product->id }}">
                        <div class="w-full bg-white rounded-xl flex items-center justify-center relative overflow-hidden aspect-square border border-gray-100">
                            <!-- Product Image -->
                            <a href="/product/{{ $product->slug }}" class="w-full h-full flex items-center justify-center p-2">
                                <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain">
                            </a>
                            
                            <!-- Sale Badge -->
                            @if($product->sale_price)
                            <div class="absolute top-2 left-2 bg-red-500 text-white text-[8px] uppercase font-bold px-1.5 py-0.5 rounded z-10">Sale</div>
                            @endif
                            
                            <!-- Right Icons -->
                            <div class="flex flex-col space-y-1.5 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300 z-10" style="position: absolute; top: 8px; right: 8px; left: auto;">
                                <button class="bg-white text-red-500 p-1.5 rounded-full shadow border border-gray-100 hover:bg-gray-50 transition w-8 h-8 flex items-center justify-center text-xs btn-wishlist" data-product-id="{{ $product->id }}" title="Remove from Wishlist"><i class="fa-solid fa-heart"></i></button>
                                <button class="bg-white text-gray-800 p-1.5 rounded-full shadow border border-gray-100 hover:text-primary hover:bg-gray-50 transition w-8 h-8 flex items-center justify-center text-xs btn-quickview" data-product-slug="{{ $product->slug }}" title="Quick View"><i class="fa-regular fa-eye"></i></button>
                                <button class="bg-white text-gray-800 p-1.5 rounded-full shadow border border-gray-100 hover:text-primary hover:bg-gray-50 transition w-8 h-8 flex items-center justify-center text-xs btn-add-to-cart md:hidden" data-product-id="{{ $product->id }}" title="Add to Cart">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </div>
                            
                            <!-- Add to Cart Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 translate-y-full group-hover:translate-y-0 transition-transform duration-300 z-10 hidden md:block">
                                <button class="w-full bg-[#C49A6C] hover:bg-primary-dark text-white font-semibold py-2.5 tracking-wider text-xs uppercase btn-add-to-cart transition-colors duration-300 cursor-pointer" data-product-id="{{ $product->id }}">ADD TO CART</button>
                            </div>
                        </div>
                        
                        <div class="pt-3 text-left flex-1 flex flex-col justify-between">
                            <h3 class="text-xs sm:text-sm font-sans font-medium text-black leading-snug">
                                <a href="/product/{{ $product->slug }}" class="hover:text-primary transition">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            @if($product->sale_price)
                            <div class="flex items-center space-x-1.5 mt-1">
                                <p class="text-sm font-bold text-primary">₹{{ number_format($product->sale_price) }}</p>
                                <p class="text-[10px] font-medium text-gray-400 line-through">₹{{ number_format($product->price) }}</p>
                            </div>
                            @else
                            <p class="text-sm font-bold text-primary mt-1">₹{{ number_format($product->price) }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-[#f5faf7]/40 rounded-xl border border-dashed border-primary/20">
                    <i class="fa-regular fa-heart text-5xl text-gray-300 mb-4"></i>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-tight mb-1" style="font-family: 'Outfit', sans-serif;">Your Wishlist is Empty</h2>
                    <p class="text-slate-500 text-xs mb-6 max-w-xs mx-auto">Add items that you like to your wishlist so you can find them easily later.</p>
                    <a href="/shop" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2.5 rounded-lg text-xs tracking-wider transition">
                        BROWSE PRODUCTS
                    </a>
                </div>
            @endif
        </div>

        @auth
        </div>
        </div>
        @endauth
    </div>
@endsection
