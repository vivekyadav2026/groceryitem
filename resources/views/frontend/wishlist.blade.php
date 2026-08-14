@extends('layouts.frontend')

@section('title', 'My Wishlist')

@section('content')
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-4 md:py-6">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-4 flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 pb-2">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight" style="font-family: 'Outfit', sans-serif;">My Wishlist</h1>
                <p class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">
                    <a href="/" class="hover:text-primary transition">Home</a> / 
                    @auth
                        <a href="/dashboard" class="hover:text-primary transition">Dashboard</a> /
                    @endauth
                    <span class="text-gray-900 font-medium">Wishlist</span>
                </p>
            </div>
            <span class="text-[9px] text-primary font-bold bg-primary/10 px-2 py-0.5 rounded uppercase tracking-wider">Favorites</span>
        </div>

        @auth
        <div class="flex flex-col lg:flex-row gap-5 lg:gap-8">
            <!-- Sidebar Navigation (Desktop only) -->
            <div class="hidden lg:block w-full lg:w-1/4">
                <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm space-y-1">
                    <div class="flex items-center space-x-3 mb-4 pb-3.5 border-b border-gray-100">
                        <div class="bg-primary/10 text-primary h-10 w-10 rounded-full flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-xs leading-tight">{{ Auth::user()->name }}</h4>
                            <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 block">Customer Portal</span>
                        </div>
                    </div>
                    
                    <a href="{{ url('/dashboard') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('dashboard') ? 'bg-primary/10 text-gray-900' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-chart-line mr-2.5 text-sm {{ request()->is('dashboard') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            Dashboard Overview
                        </span>
                        @if(request()->is('dashboard'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/wishlist') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('wishlist') ? 'bg-primary/10 text-gray-900' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-heart mr-2.5 text-sm {{ request()->is('wishlist') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            My Wishlist
                        </span>
                        @if(request()->is('wishlist'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/cart') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('cart') ? 'bg-primary/10 text-gray-900' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-cart-shopping mr-2.5 text-sm {{ request()->is('cart') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            My Shopping Cart
                        </span>
                        @if(request()->is('cart'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('profile') ? 'bg-primary/10 text-gray-900' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-user-gear mr-2.5 text-sm {{ request()->is('profile') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            Account Settings
                        </span>
                        @if(request()->is('profile'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/contact') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('contact') ? 'bg-primary/10 text-gray-900' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-headset mr-2.5 text-sm {{ request()->is('contact') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            Support & Help
                        </span>
                        @if(request()->is('contact'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="pt-2.5 border-t border-gray-100 mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-xl text-xs font-bold text-red-500 hover:bg-red-50/60 transition-all duration-150 flex items-center cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2.5 text-sm text-red-400"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile Account Shortcuts Grid (Mobile only) -->
            <div class="block lg:hidden w-full mb-4">
                <!-- User welcome panel -->
                <div class="bg-[#f5faf7]/40 border border-gray-100 rounded-xl p-3.5 mb-3 flex items-center space-x-3 shadow-sm">
                    <div class="bg-primary text-white h-9 w-9 rounded-full flex items-center justify-center font-bold text-sm shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm leading-tight">{{ Auth::user()->name }}</h4>
                        <p class="text-[10px] text-gray-400 font-sans mt-0.5">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- 2x3 Grid of Actions -->
                <div class="grid grid-cols-3 gap-2">
                    <a href="{{ url('/dashboard') }}" class="flex flex-col items-center justify-center p-2 border border-gray-150 bg-white rounded-lg text-center shadow-xs text-gray-600 transition">
                        <i class="fa-solid fa-chart-line text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Overview</span>
                    </a>

                    <a href="{{ url('/wishlist') }}" class="flex flex-col items-center justify-center p-2 border rounded-lg text-center shadow-xs transition border-primary bg-primary/5 text-primary">
                        <i class="fa-solid fa-heart text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Wishlist</span>
                    </a>

                    <a href="{{ url('/cart') }}" class="flex flex-col items-center justify-center p-2 border border-gray-150 bg-white rounded-lg text-center shadow-xs text-gray-600 transition">
                        <i class="fa-solid fa-cart-shopping text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Cart</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-2 border border-gray-150 bg-white rounded-lg text-center shadow-xs text-gray-600 transition">
                        <i class="fa-solid fa-user-gear text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Profile</span>
                    </a>

                    <a href="{{ url('/contact') }}" class="flex flex-col items-center justify-center p-2 border border-gray-150 bg-white rounded-lg text-center shadow-xs text-gray-600 transition">
                        <i class="fa-solid fa-headset text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Support</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="w-full h-full flex flex-col items-center justify-center p-2 border border-gray-150 bg-white rounded-lg text-center shadow-xs text-red-500 cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs mb-1"></i>
                            <span class="text-[9px] font-bold">Log Out</span>
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
                    <div class="group border border-gray-100 bg-[#f5faf7]/20 rounded-2xl p-3.5 transition-all duration-300 hover:shadow-md flex flex-col h-full product-wishlist-card" data-id="{{ $product->id }}">
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
                            <h3 class="text-xs sm:text-sm font-sans font-medium text-gray-800 leading-snug">
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
                    <h2 class="text-lg font-serif font-bold text-gray-900 mb-1">Your Wishlist is Empty</h2>
                    <p class="text-gray-500 text-xs mb-6 max-w-xs mx-auto">Add items that you like to your wishlist so you can find them easily later.</p>
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
