@extends('layouts.frontend')

@section('title', 'My Cart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3.5 border-b border-slate-100">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight" style="font-family: 'Outfit', sans-serif;">My Account</h1>
                <p class="text-[10px] text-slate-450 mt-1 flex items-center gap-1.5 font-bold uppercase tracking-wider">
                    <a href="/" class="hover:text-primary transition-colors">Home</a> 
                    <span class="text-slate-300">/</span> 
                    @auth
                        <a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a> 
                        <span class="text-slate-300">/</span> 
                    @endauth
                    <span class="text-slate-800">Cart</span>
                </p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold bg-primary/10 text-primary border border-primary/20 uppercase tracking-widest w-fit">
                <span class="relative flex h-1.5 w-1.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-primary"></span>
                </span>
                Customer Portal
            </span>
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
                            <span class="text-[8px] text-slate-400 font-extrabold uppercase tracking-wider mt-0.5 block flex items-center gap-1.5">
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

            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Cart list -->
                <div class="w-full {{ empty($cart) ? 'w-full' : 'lg:w-[65%]' }}">
                    @if(empty($cart))
                        <div class="text-center py-16 bg-[#f5faf7]/40 rounded-xl border border-dashed border-primary/20">
                            <i class="fa-solid fa-cart-shopping text-5xl text-gray-300 mb-4"></i>
                            <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-tight mb-1" style="font-family: 'Outfit', sans-serif;">Your Cart is Empty</h2>
                            <p class="text-slate-500 text-xs mb-6 max-w-xs mx-auto">Browse our shop to add premium grocery and daily essential items to your cart.</p>
                            <a href="/shop" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2.5 rounded-lg text-xs tracking-wider transition">
                                Start Shopping
                            </a>
                        </div>
                    @else
                        <div class="bg-white border border-slate-150 rounded-2xl p-4 shadow-sm divide-y divide-slate-100">
                            @foreach($cart as $id => $item)
                                @php
                                    $liveProduct = \App\Models\Product::find($id);
                                    $itemName = $liveProduct ? $liveProduct->name : $item['name'];
                                    $itemPrice = $liveProduct ? ($liveProduct->sale_price ?? $liveProduct->price) : $item['price'];
                                    $itemImage = $liveProduct ? $liveProduct->primary_image_url : $item['image'];
                                @endphp
                                <div class="py-3.5 flex gap-3.5 {{ $loop->first ? 'pt-0' : '' }} {{ $loop->last ? 'pb-0' : '' }}">
                                    <!-- Image Container -->
                                    <div class="w-16 h-16 bg-[#f5faf7] border border-slate-100 rounded-xl p-1 flex items-center justify-center flex-shrink-0 shadow-xs">
                                        <img src="{{ $itemImage }}" alt="{{ $itemName }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1 min-w-0 flex flex-col justify-between">
                                        <!-- Title and Price Row -->
                                        <div class="flex items-start justify-between gap-2">
                                            <h4 class="font-bold text-slate-800 text-xs sm:text-sm truncate leading-tight">{{ $itemName }}</h4>
                                            <span class="font-extrabold text-slate-900 text-xs sm:text-sm whitespace-nowrap">₹{{ number_format($itemPrice * $item['quantity'], 2) }}</span>
                                        </div>
                                        
                                        <p class="text-[10px] text-slate-400 font-semibold mt-0.5">₹{{ number_format($itemPrice, 2) }} each</p>
                                        
                                        <!-- Stepper and Actions Row -->
                                        <div class="flex flex-wrap items-center justify-between gap-3 mt-2.5">
                                            <!-- Stepper -->
                                            <div class="flex items-center bg-slate-50 border border-slate-200/80 rounded-lg h-7.5 overflow-hidden">
                                                <button type="button" class="w-7.5 h-full text-slate-500 hover:bg-slate-100 text-xs flex items-center justify-center font-extrabold transition-colors cursor-pointer" onclick="updateCartQty('{{ $id }}', {{ $item['quantity'] - 1 }})">
                                                    <i class="fa-solid fa-minus text-[9px]"></i>
                                                </button>
                                                <span class="w-8 text-center text-xs font-extrabold text-slate-800">{{ $item['quantity'] }}</span>
                                                <button type="button" class="w-7.5 h-full text-slate-500 hover:bg-slate-100 text-xs flex items-center justify-center font-extrabold transition-colors cursor-pointer" onclick="updateCartQty('{{ $id }}', {{ $item['quantity'] + 1 }})">
                                                    <i class="fa-solid fa-plus text-[9px]"></i>
                                                </button>
                                            </div>
                                            
                                            <!-- Remove button -->
                                            <button type="button" class="text-[10px] text-red-500 hover:text-red-700 font-bold flex items-center gap-1 cursor-pointer transition-colors" onclick="removeCartItem('{{ $id }}')">
                                                <i class="fa-solid fa-trash-can text-[9px]"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Order summary -->
                @if(!empty($cart))
                    @php 
                        $subtotal = array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart));
                        $delivery = 0; // Free delivery matching checkout config
                        $total = $subtotal;
                    @endphp
                    <div class="w-full lg:w-[35%]">
                        <div class="bg-white border border-slate-150 rounded-2xl p-4 shadow-sm sticky top-24">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 mb-3 border-b border-slate-100 pb-2.5" style="font-family: 'Outfit', sans-serif;">Order Summary</h3>
                            
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between text-slate-500 text-xs">
                                    <span class="font-medium">Subtotal</span>
                                    <span class="font-extrabold text-slate-800 font-sans">₹{{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-slate-500 text-xs">
                                    <span class="font-medium">Shipping</span>
                                    <span class="text-green-600 font-extrabold uppercase text-[9px] tracking-wider">Free</span>
                                </div>
                                <hr class="border-slate-100">
                                <div class="flex justify-between text-xs font-bold text-slate-900 pt-1">
                                    <span>Total Amount</span>
                                    <span class="text-slate-900 font-extrabold">₹{{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-2.5 rounded-xl tracking-wider text-[11px] transition-all duration-300 shadow-md cursor-pointer hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center gap-1">
                                Proceed to Checkout <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        @auth
        </div>
        </div>
        @endauth
    </div>

    <!-- Scripting for cart dynamics -->
    <script>
        function updateCartQty(productId, qty) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/cart/update', {
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
                    location.reload();
                } else {
                    alert(data.message || 'Error updating cart.');
                }
            })
            .catch(err => console.error(err));
        }

        function removeCartItem(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (confirm('Are you sure you want to remove this item?')) {
                fetch('/cart/remove', {
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
                        location.reload();
                    } else {
                        alert(data.message || 'Error removing item.');
                    }
                })
                .catch(err => console.error(err));
            }
        }
    </script>
@endsection
