@extends('layouts.frontend')

@section('title', 'My Dashboard')

@section('content')
    <!-- Dashboard Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-3 flex flex-wrap items-center justify-between gap-3 border-b border-gray-200 pb-2">
            <div>
                <h1 class="text-lg font-bold text-gray-900 tracking-tight" style="font-family: 'Outfit', sans-serif;">My Account</h1>
                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1.5">
                    <a href="/" class="hover:text-primary transition font-medium">Home</a> 
                    <span class="text-gray-300">/</span> 
                    <span class="text-gray-900 font-semibold">Dashboard</span>
                </p>
            </div>
            <span class="text-[10px] text-primary font-bold bg-primary/10 px-3 py-1 rounded-sm uppercase tracking-wider">Customer Portal</span>
        </div>

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
                    
                    <a href="{{ url('/wishlist') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('wishlist') ? 'bg-primary/10 text-primary' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('wishlist') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
                        <span class="flex items-center">
                            <i class="fa-solid fa-heart mr-2.5 text-sm" style="color: {{ request()->is('wishlist') ? 'var(--pl-primary, #0e6b57)' : '#94a3b8' }} !important;"></i>
                            My Wishlist
                        </span>
                        @if(request()->is('wishlist'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/cart') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-between {{ request()->is('cart') ? 'bg-primary/10 text-primary' : 'text-black hover:bg-slate-50' }}" style="color: {{ request()->is('cart') ? 'var(--pl-primary, #0e6b57)' : 'black' }} !important;">
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

            <!-- Content Area: Dashboard Overview -->
            <div class="w-full lg:w-3/4">
                <div class="max-w-3xl mx-auto space-y-3.5">
                    
                    <!-- Welcome Banner -->
                    <div class="bg-white border border-slate-150 rounded-2xl p-4.5 shadow-sm flex flex-col justify-between items-start gap-1">
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-[9px] font-extrabold text-primary uppercase tracking-widest">Welcome Back</span>
                                <span class="text-[8px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-bold uppercase tracking-wider">Member Since {{ Auth::user()->created_at ? Auth::user()->created_at->format('M Y') : 'Aug 2026' }}</span>
                            </div>
                            <h2 class="text-base sm:text-lg font-bold text-slate-800 mt-1" style="font-family: 'Outfit', sans-serif;">Namaste, {{ Auth::user()->name }}!</h2>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Manage your orders, wishlist items, and profile settings — all in one place.</p>
                        </div>
                    </div>

                    <!-- Stats Summary Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3.5">
                        <!-- Total Orders -->
                        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm flex items-center gap-3 hover:border-primary/20 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-box text-base text-primary"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-bold text-slate-800 leading-none">{{ count($orders) }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mt-1.5">Total Orders</span>
                            </div>
                        </div>

                        <!-- Total Spent -->
                        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm flex items-center gap-3 hover:border-primary/20 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-wallet text-base text-primary"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-bold text-slate-800 leading-none">₹{{ number_format($orders->where('payment_status', 'completed')->sum('total_amount'), 2) }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mt-1.5">Total Spent</span>
                            </div>
                        </div>

                        <!-- Wishlist Items -->
                        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm flex items-center gap-3 hover:border-primary/20 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-heart text-base text-primary"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-bold text-slate-800 leading-none">{{ count(session()->get('wishlist', [])) }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mt-1.5">Wishlist Items</span>
                            </div>
                        </div>

                        <!-- Last Order -->
                        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm flex items-center gap-3 hover:border-primary/20 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-clock-rotate-left text-base text-primary"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-slate-800 truncate max-w-[100px] leading-none mt-0.5">
                                    {{ $orders->first() ? $orders->first()->created_at->format('M d, Y') : 'None' }}
                                </span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mt-1.5">Last Order</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Shopping Cart Card -->
                        <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:shadow-md transition-all duration-300">
                            <div>
                                <div class="flex items-center gap-2.5 mb-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xs">
                                        <i class="fa-solid fa-cart-shopping text-primary"></i>
                                    </div>
                                    <h5 class="text-sm font-bold text-slate-800">Shopping Cart</h5>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed mb-4">Review items in your shopping cart, update quantities, and proceed to secure checkout to place your order.</p>
                            </div>
                            <a href="{{ url('/cart') }}" class="inline-flex items-center gap-1.5 border border-primary/20 hover:border-primary text-primary hover:bg-primary/5 px-3 py-1.5 rounded-lg text-xs font-semibold w-fit transition-colors">
                                View Cart <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>

                        <!-- Wishlist Card -->
                        <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:shadow-md transition-all duration-300">
                            <div>
                                <div class="flex items-center gap-2.5 mb-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xs">
                                        <i class="fa-solid fa-heart text-primary"></i>
                                    </div>
                                    <h5 class="text-sm font-bold text-slate-800">My Wishlist</h5>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed mb-4">View your saved favorites, check for stock updates or discounts, and quickly add them to your shopping cart.</p>
                            </div>
                            <a href="{{ url('/wishlist') }}" class="inline-flex items-center gap-1.5 border border-primary/20 hover:border-primary text-primary hover:bg-primary/5 px-3 py-1.5 rounded-lg text-xs font-semibold w-fit transition-colors">
                                View Wishlist <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Orders Section -->
                    <div>
                        <div class="flex items-center justify-between mb-3.5 border-b border-slate-100 pb-2">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-clock-rotate-left text-slate-400 text-xs"></i>
                                <h2 class="text-xs font-bold uppercase tracking-wider text-slate-800" style="font-family: 'Outfit', sans-serif;">Recent Orders</h2>
                            </div>
                            <a href="{{ url('/shop') }}" class="text-xs text-primary font-bold hover:underline uppercase tracking-wider text-[10px]">Shop Now</a>
                        </div>
                        
                        @if($orders->isEmpty())
                            <div class="p-8 text-center bg-white border border-slate-100 rounded-2xl shadow-xs">
                                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-3">
                                    <i class="fa-solid fa-basket-shopping text-slate-300 text-lg"></i>
                                </div>
                                <h4 class="font-bold text-slate-800 text-sm mb-1">You haven't placed any orders yet.</h4>
                                <p class="text-slate-400 text-xs mb-4">Your order history is currently empty.</p>
                                <a href="{{ url('/shop') }}" class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl text-xs font-semibold transition-colors shadow-xs">
                                     Shop Now
                                 </a>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($orders as $order)
                                    <div x-data="{ open: false }" class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                                        <!-- Summary Row (Clickable Header) -->
                                        <div @click="open = !open" class="px-3.5 py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 cursor-pointer hover:bg-slate-50/40 transition-colors select-none">
                                            @php
                                                $statusConfig = [
                                                    'pending' => ['bg' => 'bg-amber-50 text-amber-800 border-amber-300', 'dot' => 'bg-amber-600', 'pulse' => true],
                                                    'processing' => ['bg' => 'bg-blue-50 text-blue-800 border-blue-300', 'dot' => 'bg-blue-600', 'pulse' => true],
                                                    'shipped' => ['bg' => 'bg-indigo-50 text-indigo-800 border-indigo-300', 'dot' => 'bg-indigo-600', 'pulse' => true],
                                                    'completed' => ['bg' => 'bg-emerald-50 text-emerald-800 border-emerald-300', 'dot' => 'emerald-600', 'pulse' => false],
                                                    'cancelled' => ['bg' => 'bg-rose-50 text-rose-800 border-rose-300', 'dot' => 'bg-rose-600', 'pulse' => false],
                                                    'failed' => ['bg' => 'bg-red-50 text-red-800 border-red-300', 'dot' => 'bg-red-600', 'pulse' => false]
                                                ];
                                                $config = $statusConfig[$order->status] ?? ['bg' => 'bg-slate-50 text-slate-800 border-slate-300', 'dot' => 'bg-slate-600', 'pulse' => false];
                                            @endphp
                                            <!-- Top section for mobile, inline for SM -->
                                            <div class="flex items-center justify-between sm:justify-start gap-3 w-full sm:w-auto">
                                                <div class="flex items-center gap-2.5">
                                                    <div class="h-8.5 w-8.5 rounded-xl bg-primary/10 flex items-center justify-center text-primary-dark">
                                                        <i class="fa-solid fa-box-open text-xs text-primary"></i>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="font-extrabold text-slate-900 text-xs tracking-tight">#{{ $order->order_number }}</span>
                                                        <span class="text-[9px] text-slate-500 mt-0.5 flex items-center gap-1 font-semibold">
                                                             <i class="fa-regular fa-calendar text-[8px]"></i> {{ $order->created_at->format('M d, Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <!-- Show Status inline on Mobile to save vertical space -->
                                                <div class="sm:hidden text-right flex items-center gap-2">
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold border {{ $config['bg'] }}">
                                                         {{ ucfirst($order->status) }}
                                                    </span>
                                                    <i class="fa-solid fa-chevron-down text-slate-400 text-[10px] transition-transform duration-300" :class="open ? 'rotate-180 text-primary' : ''"></i>
                                                </div>
                                            </div>

                                            <!-- Middle & Right for Mobile, inline for SM -->
                                            <div class="flex items-center justify-between sm:justify-end gap-4 w-full sm:w-auto mt-1.5 sm:mt-0 border-t border-slate-100/60 pt-2 sm:pt-0 sm:border-0">
                                                <!-- Avatars -->
                                                <div class="flex items-center -space-x-2.5 overflow-hidden">
                                                    @foreach($order->items->take(4) as $item)
                                                        @if($item->product)
                                                            <div class="w-7 h-7 rounded-full border border-white bg-slate-50 flex items-center justify-center shadow-xs overflow-hidden" title="{{ $item->product_name }}">
                                                                <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product_name }}" class="w-full h-full object-contain">
                                                            </div>
                                                        @else
                                                            <div class="w-7 h-7 rounded-full border border-white bg-slate-50 flex items-center justify-center shadow-xs text-slate-500">
                                                                <i class="fa-solid fa-box text-[8px]"></i>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @if($order->items->count() > 4)
                                                        <span class="w-7 h-7 rounded-full border border-white bg-slate-100 text-[8px] font-bold text-slate-655 flex items-center justify-center shadow-xs">
                                                             +{{ $order->items->count() - 4 }}
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- Desktop only Status / Mobile & Desktop Total -->
                                                <div class="flex items-center gap-3">
                                                    <div class="text-right">
                                                         <span class="text-xs font-extrabold text-slate-900">₹{{ number_format($order->total_amount, 2) }}</span>
                                                    </div>
                                                    <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[9px] font-bold border {{ $config['bg'] }}">
                                                         <span class="relative flex h-1.5 w-1.5">
                                                             @if($config['pulse'])
                                                                 <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $config['dot'] }}"></span>
                                                             @endif
                                                             <span class="relative inline-flex rounded-full h-1.5 w-1.5 {{ $config['dot'] }}"></span>
                                                         </span>
                                                         {{ ucfirst($order->status) }}
                                                    </span>
                                                    <i class="hidden sm:block fa-solid fa-chevron-down text-slate-400 text-xs transition-transform duration-300" :class="open ? 'rotate-180 text-primary' : ''"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Collapsible Details Area -->
                                        <div x-show="open" x-transition class="border-t border-slate-100 bg-[#fbfdfc] px-4 py-3" style="display: none;">
                                            <div class="mb-3">
                                                <div class="flex items-center justify-between mb-2.5 border-b border-slate-150 pb-1.5">
                                                    <span class="text-[10px] font-extrabold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                                                        <i class="fa-solid fa-basket-shopping text-slate-500 text-xs"></i> Order Items
                                                    </span>
                                                    <div x-data="{ copied: false, text: '#{{ $order->order_number }}' }" class="flex items-center gap-1 text-[10px] text-slate-500 font-medium">
                                                        <span>Order ID: <strong class="text-slate-900 font-bold" x-text="text"></strong></span>
                                                        <button @click.stop="navigator.clipboard.writeText(text); copied = true; setTimeout(() => copied = false, 2000)" class="text-slate-500 hover:text-primary transition-colors p-1" title="Copy Order ID">
                                                            <i class="fa-regular fa-copy text-[10px]" x-show="!copied"></i>
                                                            <i class="fa-solid fa-check text-[10px] text-emerald-600" x-show="copied"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="divide-y divide-slate-150 space-y-1.5">
                                                    @foreach($order->items as $item)
                                                        <div class="flex items-center justify-between py-1.5 first:pt-0 last:pb-0">
                                                            <div class="flex items-center gap-2.5">
                                                                @if($item->product)
                                                                    <div class="w-9 h-9 rounded-xl bg-white border border-slate-200/80 p-0.5 flex flex-shrink-0 items-center justify-center shadow-xs overflow-hidden">
                                                                        <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product_name }}" class="w-full h-full object-contain">
                                                                    </div>
                                                                @else
                                                                    <div class="w-9 h-9 rounded-xl bg-slate-50 border border-slate-150 flex items-center justify-center flex-shrink-0 text-slate-500">
                                                                        <i class="fa-solid fa-box text-xs"></i>
                                                                    </div>
                                                                @endif
                                                                <div>
                                                                    <p class="text-xs font-bold text-slate-900">{{ $item->product_name }}</p>
                                                                    <p class="text-[10px] text-slate-600 font-bold mt-0.5">{{ $item->quantity }} × <span class="font-medium text-slate-500">₹{{ number_format($item->unit_price, 2) }}</span></p>
                                                                </div>
                                                            </div>
                                                            <span class="text-xs font-extrabold text-slate-900">₹{{ number_format($item->total_price, 2) }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Payment & Shipping Details Grid -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 border-t border-slate-150 pt-3 text-xs">
                                                <!-- Payment Details Card -->
                                                <div>
                                                    <h6 class="text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                                        <i class="fa-solid fa-credit-card text-[10px] text-primary"></i> Payment Details
                                                    </h6>
                                                    <div class="space-y-1.5 text-xs text-slate-700">
                                                        <div class="flex justify-between">
                                                            <span class="text-slate-500 font-medium text-[10px]">Method</span>
                                                            <span class="font-extrabold text-slate-800 bg-slate-100 px-2 py-0.5 rounded text-[9px] uppercase tracking-wide">
                                                                {{ $order->payment_method === 'cod' ? 'Cash on Delivery (COD)' : strtoupper($order->payment_method) }}
                                                            </span>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <span class="text-slate-500 font-medium text-[10px]">Status</span>
                                                            @php
                                                                $paymentColors = [
                                                                    'completed' => 'bg-emerald-50 text-emerald-800 border-emerald-250',
                                                                    'pending' => 'bg-amber-50 text-amber-800 border-amber-250',
                                                                    'failed' => 'bg-rose-50 text-rose-800 border-rose-250'
                                                                ];
                                                                $payColor = $paymentColors[$order->payment_status] ?? 'bg-slate-55 text-slate-850 border-slate-250';
                                                            @endphp
                                                            <span class="font-bold border px-2 py-0.5 rounded text-[9px] uppercase tracking-wide {{ $payColor }}">
                                                                {{ $order->payment_status }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Shipping Details Card -->
                                                <div>
                                                    <h6 class="text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                                        <i class="fa-solid fa-truck-fast text-[10px] text-primary"></i> Shipping Details
                                                    </h6>
                                                    <div class="text-[10px] text-slate-700 space-y-1.5">
                                                        <div class="flex justify-between">
                                                            <span class="text-slate-500 font-medium text-[10px]">Recipient</span>
                                                            <span class="font-extrabold text-slate-900 text-right">{{ $order->shipping_name }}</span>
                                                        </div>
                                                        <div class="flex justify-between gap-2 items-start">
                                                            <span class="text-slate-500 font-medium text-[10px] flex-shrink-0">Address</span>
                                                            <span class="font-bold text-slate-850 text-right leading-normal break-words max-w-[200px]">
                                                                @if($order->shipping_address)
                                                                    {{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_state }} - {{ $order->shipping_zip }}
                                                                @else
                                                                    {{ $order->shipping_city }} {{ $order->shipping_state ? ', ' . $order->shipping_state : '' }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        @if($order->shipping_phone)
                                                            <div class="flex justify-between">
                                                                <span class="text-slate-500 font-medium text-[10px]">Phone</span>
                                                                <span class="font-extrabold text-slate-900 text-right">{{ $order->shipping_phone }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
