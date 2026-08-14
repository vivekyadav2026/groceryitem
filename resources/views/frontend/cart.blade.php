@extends('layouts.frontend')

@section('title', 'My Cart')

@section('content')
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-4 md:py-6">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-4 flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 pb-2">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight" style="font-family: 'Outfit', sans-serif;">My Cart</h1>
                <p class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">
                    <a href="/" class="hover:text-primary transition">Home</a> / 
                    @auth
                        <a href="/dashboard" class="hover:text-primary transition">Dashboard</a> /
                    @endauth
                    <span class="text-gray-900 font-medium">Cart</span>
                </p>
            </div>
            <span class="text-[9px] text-primary font-bold bg-primary/10 px-2 py-0.5 rounded uppercase tracking-wider">Shopping Cart</span>
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
                            <h4 class="font-bold text-gray-900 text-sm leading-tight">{{ Auth::user()->name }}</h4>
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

                    <a href="{{ url('/wishlist') }}" class="flex flex-col items-center justify-center p-2 border border-gray-150 bg-white rounded-lg text-center shadow-xs text-gray-600 transition">
                        <i class="fa-solid fa-heart text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Wishlist</span>
                    </a>

                    <a href="{{ url('/cart') }}" class="flex flex-col items-center justify-center p-2 border rounded-lg text-center shadow-xs transition border-primary bg-primary/5 text-primary">
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

            <div class="flex flex-col md:flex-row gap-5 lg:gap-8">
                <!-- Cart list -->
                <div class="w-full lg:w-[65%]">
                    @if(empty($cart))
                        <div class="text-center py-16 bg-[#f5faf7]/40 rounded-xl border border-dashed border-primary/20">
                            <i class="fa-solid fa-cart-shopping text-5xl text-gray-300 mb-4"></i>
                            <h2 class="text-lg font-serif font-bold text-gray-900 mb-1">Your Cart is Empty</h2>
                            <p class="text-gray-500 text-xs mb-6 max-w-xs mx-auto">Browse our shop to add premium grocery and daily essential items to your cart.</p>
                            <a href="/shop" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2.5 rounded-lg text-xs tracking-wider transition">
                                Start Shopping
                            </a>
                        </div>
                    @else
                        <div class="bg-white border border-gray-100 rounded-xl p-3 sm:p-4 shadow-sm divide-y divide-gray-100">
                            @foreach($cart as $id => $item)
                                @php
                                    $liveProduct = \App\Models\Product::find($id);
                                    $itemName = $liveProduct ? $liveProduct->name : $item['name'];
                                    $itemPrice = $liveProduct ? ($liveProduct->sale_price ?? $liveProduct->price) : $item['price'];
                                    $itemImage = $liveProduct ? $liveProduct->primary_image_url : $item['image'];
                                @endphp
                                <div class="py-3 flex items-center gap-3 {{ $loop->first ? 'pt-0' : '' }} {{ $loop->last ? 'pb-0' : '' }}">
                                    <!-- Image -->
                                    <div class="w-12 h-12 flex-shrink-0 bg-[#f5faf7] border border-gray-100 rounded-lg p-1 flex items-center justify-center">
                                        <img src="{{ $itemImage }}" alt="{{ $itemName }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <!-- Details -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-gray-900 text-xs truncate leading-tight">{{ $itemName }}</h4>
                                        <p class="text-[10px] text-gray-400 mt-0.5">₹{{ number_format($itemPrice, 2) }} each</p>
                                        
                                        <!-- Controls row -->
                                        <div class="flex items-center gap-4 mt-2">
                                            <!-- Stepper -->
                                            <div class="flex items-center border border-gray-200 rounded h-7">
                                                <button type="button" class="w-7 h-full text-gray-500 hover:bg-gray-50 text-xs flex items-center justify-center font-bold" onclick="updateCartQty('{{ $id }}', {{ $item['quantity'] - 1 }})"><i class="fa-solid fa-minus text-[9px]"></i></button>
                                                <span class="w-7 text-center text-xs font-semibold text-gray-800">{{ $item['quantity'] }}</span>
                                                <button type="button" class="w-7 h-full text-gray-500 hover:bg-gray-50 text-xs flex items-center justify-center font-bold" onclick="updateCartQty('{{ $id }}', {{ $item['quantity'] + 1 }})"><i class="fa-solid fa-plus text-[9px]"></i></button>
                                            </div>
                                            <!-- Remove button -->
                                            <button type="button" class="text-[10px] text-red-500 hover:text-red-700 font-semibold flex items-center gap-1 cursor-pointer" onclick="removeCartItem('{{ $id }}')">
                                                <i class="fa-solid fa-trash-can text-[9px]"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Total -->
                                    <div class="text-right">
                                        <span class="font-bold text-gray-900 text-xs block">₹{{ number_format($itemPrice * $item['quantity'], 2) }}</span>
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
                        <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-md sticky top-24">
                            <h3 class="text-base font-serif font-bold text-gray-900 mb-3 border-b border-gray-100 pb-2" style="font-family: 'Outfit', sans-serif;">Order Summary</h3>
                            
                            <div class="space-y-2 mb-3">
                                <div class="flex justify-between text-gray-500 text-xs">
                                    <span>Subtotal</span>
                                    <span class="font-semibold text-gray-900 font-sans">₹{{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-500 text-xs">
                                    <span>Shipping</span>
                                    <span class="text-green-600 font-semibold uppercase text-[9px] tracking-wider">Free</span>
                                </div>
                                <hr class="border-gray-100">
                                <div class="flex justify-between text-xs font-bold text-gray-900">
                                    <span>Total Amount</span>
                                    <span>₹{{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-2.5 rounded-lg tracking-wider text-[11px] transition-all duration-300 shadow-md cursor-pointer hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center gap-1">
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
