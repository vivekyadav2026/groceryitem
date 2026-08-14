@extends('layouts.frontend')

@section('title', 'My Dashboard')

@section('content')
    <!-- Dashboard Content -->
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-4 md:py-6">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-4 flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 pb-2">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight" style="font-family: 'Outfit', sans-serif;">My Account</h1>
                <p class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">
                    <a href="/" class="hover:text-primary transition">Home</a> / 
                    <span class="text-gray-900 font-medium">Dashboard</span>
                </p>
            </div>
            <span class="text-[9px] text-primary font-bold bg-primary/10 px-2 py-0.5 rounded uppercase tracking-wider">Customer Panel</span>
        </div>

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
                    
                    <a href="{{ url('/dashboard') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('dashboard') ? 'bg-primary/10 text-primary' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-chart-line mr-2.5 text-sm {{ request()->is('dashboard') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            Dashboard Overview
                        </span>
                        @if(request()->is('dashboard'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/wishlist') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('wishlist') ? 'bg-primary/10 text-primary' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-heart mr-2.5 text-sm {{ request()->is('wishlist') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            My Wishlist
                        </span>
                        @if(request()->is('wishlist'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/cart') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('cart') ? 'bg-primary/10 text-primary' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-cart-shopping mr-2.5 text-sm {{ request()->is('cart') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            My Shopping Cart
                        </span>
                        @if(request()->is('cart'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('profile') ? 'bg-primary/10 text-primary' : 'text-gray-900 hover:bg-gray-50' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-user-gear mr-2.5 text-sm {{ request()->is('profile') ? 'text-primary' : 'text-gray-900 group-hover:text-gray-700' }}"></i>
                            Account Settings
                        </span>
                        @if(request()->is('profile'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/contact') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('contact') ? 'bg-primary/10 text-primary' : 'text-gray-900 hover:bg-gray-50' }}">
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
                    <a href="{{ url('/dashboard') }}" class="flex flex-col items-center justify-center p-2 border rounded-lg text-center shadow-xs transition {{ request()->is('dashboard') ? 'border-primary bg-primary/5 text-primary' : 'border-gray-150 bg-white text-gray-600' }}">
                        <i class="fa-solid fa-chart-line text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Overview</span>
                    </a>

                    <a href="{{ url('/wishlist') }}" class="flex flex-col items-center justify-center p-2 border border-gray-150 bg-white rounded-lg text-center shadow-xs text-gray-600 transition">
                        <i class="fa-solid fa-heart text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Wishlist</span>
                    </a>

                    <a href="{{ url('/cart') }}" class="flex flex-col items-center justify-center p-2 border border-gray-150 bg-white rounded-lg text-center shadow-xs text-gray-600 transition">
                        <i class="fa-solid fa-cart-shopping text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Cart</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-2 border rounded-lg text-center shadow-xs transition {{ request()->is('profile') ? 'border-primary bg-primary/5 text-primary' : 'border-gray-150 bg-white text-gray-600' }}">
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

            <!-- Content Area: Order History -->
            <div class="w-full lg:w-3/4">
                
                <!-- Stats Summary Widgets -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
                    <div class="bg-white border border-gray-100 rounded-xl p-3 shadow-xs flex items-center space-x-2.5">
                        <div class="p-2 bg-primary/5 text-primary rounded-lg text-xs flex-shrink-0">
                            <i class="fa-solid fa-clipboard-list text-base"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold text-gray-400 tracking-wider">Total Orders</span>
                            <span class="text-xs font-bold text-gray-900 font-sans mt-0.5 block">{{ count($orders) }}</span>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-xl p-3 shadow-xs flex items-center space-x-2.5">
                        <div class="p-2 bg-green-50 text-green-600 rounded-lg text-xs flex-shrink-0">
                            <i class="fa-solid fa-circle-check text-base"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold text-gray-400 tracking-wider">Total Spent</span>
                            <span class="text-xs font-bold text-gray-900 font-sans mt-0.5 block">₹{{ number_format($orders->where('payment_status', 'completed')->sum('total_amount'), 2) }}</span>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-xl p-3 shadow-xs flex items-center space-x-2.5">
                        <div class="p-2 bg-pink-50 text-pink-500 rounded-lg text-xs flex-shrink-0">
                            <i class="fa-solid fa-heart text-base"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold text-gray-400 tracking-wider">Wishlist</span>
                            <span class="text-xs font-bold text-gray-900 font-sans mt-0.5 block">{{ count(session()->get('wishlist', [])) }}</span>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-xl p-3 shadow-xs flex items-center space-x-2.5">
                        <div class="p-2 bg-primary/5 text-primary rounded-lg text-xs flex-shrink-0">
                            <i class="fa-solid fa-calendar-check text-base"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold text-gray-400 tracking-wider">Last Order</span>
                            <span class="text-[10px] font-bold text-gray-800 truncate mt-0.5 block">{{ $orders->first() ? $orders->first()->created_at->format('M d, Y') : 'None yet' }}</span>
                        </div>
                    </div>
                </div>

                <h2 class="text-base font-bold text-gray-900 mb-3 pb-1.5 border-b border-gray-100 flex items-center gap-2" style="font-family: 'Outfit', sans-serif;">
                    <span class="inline-block w-1 h-4 bg-primary rounded-full"></span>
                    Order History
                </h2>
                
                @if($orders->isEmpty())
                    <div class="p-6 text-center bg-[#f5faf7]/40 border border-dashed border-primary/20 rounded-xl">
                        <div class="bg-primary/10 text-primary h-12 w-12 rounded-full flex items-center justify-center mx-auto mb-3 text-lg">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <h4 class="font-serif font-bold text-gray-900 text-base mb-1">No Orders Placed Yet</h4>
                        <p class="text-gray-500 text-xs mb-4 max-w-xs mx-auto">When you order premium items from our store, they will appear here in your dashboard.</p>
                        <a href="{{ url('/shop') }}" class="inline-block bg-primary text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-primary-dark transition">
                            Start Shopping
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($orders as $order)
                            <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-xs hover:shadow-sm transition duration-300">
                                <!-- Order Header -->
                                <div class="bg-[#f5faf7]/30 px-4 py-3 border-b border-gray-100 flex flex-wrap justify-between items-center gap-3">
                                    <div>
                                        <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Order Number</p>
                                        <h4 class="font-bold text-gray-900 text-xs font-sans mt-0.5">{{ $order->order_number }}</h4>
                                    </div>
                                    <div class="flex gap-4">
                                        <div>
                                            <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Date Placed</p>
                                            <p class="text-gray-700 text-[11px] mt-0.5">{{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Total Amount</p>
                                            <p class="text-gray-900 font-bold text-[11px] mt-0.5">₹{{ number_format($order->total_amount, 2) }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <!-- Status Badge -->
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                                'processing' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                'shipped' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                                'completed' => 'bg-green-50 text-green-700 border-green-200',
                                                'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
                                                'failed' => 'bg-red-50 text-red-700 border-red-200'
                                            ];
                                            $color = $statusColors[$order->status] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $color }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Order Items List -->
                                <div class="px-4 py-3">
                                    <div class="divide-y divide-gray-100">
                                        @foreach($order->items as $item)
                                            <div class="py-2 flex justify-between items-center gap-3 {{ $loop->first ? 'pt-0' : '' }} {{ $loop->last ? 'pb-0' : '' }}">
                                                <div class="flex items-center gap-2.5">
                                                    @if($item->product)
                                                        <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product_name }}" class="w-10 h-10 object-contain rounded-lg border border-gray-100 p-0.5 flex-shrink-0 bg-white">
                                                    @else
                                                        <div class="w-10 h-10 bg-gray-150 rounded-lg flex items-center justify-center border border-gray-100 flex-shrink-0 bg-white">
                                                            <i class="fa-solid fa-box text-gray-400 text-sm"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h5 class="text-xs font-semibold text-gray-800 max-w-[200px] truncate leading-tight">{{ $item->product_name }}</h5>
                                                        <p class="text-[10px] text-gray-400 mt-0.5">Quantity: {{ $item->quantity }} @ ₹{{ number_format($item->unit_price, 2) }}</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <span class="text-xs font-bold text-gray-900">₹{{ number_format($item->total_price, 2) }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Order Metadata / Delivery Details -->
                                    <div class="mt-3 pt-2.5 border-t border-gray-100 flex flex-col sm:flex-row justify-between text-[10px] text-gray-400 gap-2">
                                        <div>
                                            <span class="font-semibold text-gray-500">Payment:</span> {{ strtoupper($order->payment_method) }} (Status: <span class="{{ $order->payment_status === 'completed' ? 'text-green-600 font-semibold' : 'text-amber-600' }}">{{ ucfirst($order->payment_status) }}</span>)
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-500">Deliver To:</span> {{ $order->shipping_name }}, {{ $order->shipping_city }} ({{ $order->shipping_state }})
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
@endsection
