@extends('layouts.frontend')

@section('title', 'My Wishlist')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-1 flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3.5 border-b border-slate-100">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight" style="font-family: 'Outfit', sans-serif;">My Account</h1>
                <p class="text-[10px] text-slate-450 mt-1 flex items-center gap-1.5 font-bold uppercase tracking-wider">
                    <a href="/" class="hover:text-primary transition-colors">Home</a> 
                    <span class="text-slate-300">/</span> 
                    @auth
                        <a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a> 
                        <span class="text-slate-300">/</span> 
                    @endauth
                    <span class="text-slate-800">Wishlist</span>
                </p>
            </div>
        </div>

        @auth
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Sidebar Navigation (Desktop only) -->
            <div class="hidden lg:block w-full lg:w-1/4">
                <div class="bg-white border border-slate-150 rounded-2xl p-4 shadow-sm space-y-1">
                    <div class="flex items-center space-x-3 mb-4 pb-4 border-b border-slate-100/85">
                        <div class="relative">
                            <div class="bg-gradient-to-tr from-primary to-[#14836b] text-white h-10 w-10 rounded-full flex items-center justify-center font-extrabold text-sm shadow-sm select-none">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-xs tracking-tight">{{ Auth::user()->name }}</h4>
                            <span class="text-[8px] text-slate-450 font-extrabold uppercase tracking-wider mt-0.5 block flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-primary text-[9px]"></i> Verified Account
                            </span>
                        </div>
                    </div>
                    
                    <a href="{{ url('/dashboard') }}" class="group relative w-full px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('dashboard') ? 'bg-primary/5 text-primary' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}" style="color: {{ request()->is('dashboard') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            @if(request()->is('dashboard'))
                                <span class="absolute left-0 top-2 bottom-2 w-0.75 bg-primary rounded-r-md"></span>
                            @endif
                            <i class="fa-solid fa-chart-line mr-2.5 text-sm transition-transform group-hover:scale-105" style="color: {{ request()->is('dashboard') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Dashboard Overview
                        </span>
                        <i class="fa-solid fa-chevron-right text-[7px] text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    
                    <a href="{{ url('/wishlist') }}" class="group relative w-full px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('wishlist') ? 'bg-primary/5 text-primary' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}" style="color: {{ request()->is('wishlist') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            @if(request()->is('wishlist'))
                                <span class="absolute left-0 top-2 bottom-2 w-0.75 bg-primary rounded-r-md"></span>
                            @endif
                            <i class="fa-solid fa-heart mr-2.5 text-sm transition-transform group-hover:scale-105" style="color: {{ request()->is('wishlist') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            My Wishlist
                        </span>
                        <i class="fa-solid fa-chevron-right text-[7px] text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    
                    <a href="{{ url('/cart') }}" class="group relative w-full px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('cart') ? 'bg-primary/5 text-primary font-bold' : 'text-black hover:bg-slate-50 hover:text-slate-900' }}" style="color: {{ request()->is('cart') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            @if(request()->is('cart'))
                                <span class="absolute left-0 top-2 bottom-2 w-0.75 bg-primary rounded-r-md"></span>
                            @endif
                            <i class="fa-solid fa-cart-shopping mr-2.5 text-sm transition-transform group-hover:scale-105" style="color: {{ request()->is('cart') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            My Shopping Cart
                        </span>
                        <i class="fa-solid fa-chevron-right text-[7px] text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="group relative w-full px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('profile') ? 'bg-primary/5 text-primary' : 'text-slate-700 hover:bg-slate-50' }}" style="color: {{ request()->is('profile') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            @if(request()->is('profile'))
                                <span class="absolute left-0 top-2 bottom-2 w-0.75 bg-primary rounded-r-md"></span>
                            @endif
                            <i class="fa-solid fa-user-gear mr-2.5 text-sm transition-transform group-hover:scale-105" style="color: {{ request()->is('profile') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Account Settings
                        </span>
                        <i class="fa-solid fa-chevron-right text-[7px] text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    
                    <a href="{{ url('/contact') }}" class="group relative w-full px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('contact') ? 'bg-primary/5 text-primary font-bold' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('contact') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            @if(request()->is('contact'))
                                <span class="absolute left-0 top-2 bottom-2 w-0.75 bg-primary rounded-r-md"></span>
                            @endif
                            <i class="fa-solid fa-headset mr-2.5 text-sm transition-transform group-hover:scale-105" style="color: {{ request()->is('contact') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            Support & Help
                        </span>
                        <i class="fa-solid fa-chevron-right text-[7px] text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="pt-2.5 border-t border-slate-100 mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-3.5 py-2 rounded-xl text-xs font-bold text-red-500 hover:bg-red-50 transition-all flex items-center cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2.5 text-sm text-red-400"></i> Log Out
                        </button>
                    </form>

                    <!-- Premium Promo Banner inside Sidebar -->
                    <div class="mt-5 p-3.5 bg-gradient-to-br from-slate-50 to-slate-100/60 border border-slate-200/50 rounded-xl relative overflow-hidden">
                        <span class="text-[8px] font-extrabold text-primary uppercase tracking-widest block mb-1">Premium Member</span>
                        <p class="text-[10px] text-slate-500 leading-normal font-semibold mb-2">Free shipping & priority support active.</p>
                        <a href="{{ url('/contact') }}" class="inline-flex items-center justify-center bg-white hover:bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1 text-[9px] font-extrabold text-slate-800 transition-all shadow-2xs">
                            Get Help Fast
                        </a>
                    </div>
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
                                <p class="text-sm font-bold text-primary">${{ number_format($product->sale_price) }}</p>
                                <p class="text-[10px] font-medium text-gray-400 line-through">${{ number_format($product->price) }}</p>
                            </div>
                            @else
                            <p class="text-sm font-bold text-primary mt-1">${{ number_format($product->price) }}</p>
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
