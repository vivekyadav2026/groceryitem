@extends('layouts.frontend')

@section('title', 'Order Success')

@section('content')
    @php
        // Eager load items and products for the summary
        $order->load('items.product');
    @endphp

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        <!-- Success Alert Header -->
        <div class="text-center mb-10">
            <!-- Animated Green Success Checkmark Badge -->
            <div class="inline-flex items-center justify-center bg-green-50 p-5 rounded-full mb-6 text-emerald-600 border border-green-100 shadow-sm relative">
                <span class="absolute inset-0 rounded-full bg-emerald-500/10 animate-ping opacity-75"></span>
                <i class="fa-solid fa-circle-check text-6xl relative z-10"></i>
            </div>

            <h1 class="text-3xl sm:text-4xl font-serif font-black text-gray-900 mb-3 tracking-tight">Order Placed Successfully!</h1>
            <p class="text-gray-500 max-w-lg mx-auto text-xs sm:text-sm leading-relaxed">
                Thank you for your purchase. We have received your order and are processing it. 
                An email confirmation has been sent to 
                <span class="inline-block px-2 py-0.5 font-bold text-gray-900 bg-gray-100 rounded-md font-sans">{{ $order->shipping_email }}</span>.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Order Details Card -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Info Grid -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-base font-serif font-bold text-gray-900 mb-4 pb-3 border-b border-gray-50 flex items-center justify-between">
                        <span>Order Information</span>
                        <span class="text-[10px] uppercase tracking-wider text-emerald-600 bg-emerald-50 font-bold px-2 py-0.5 rounded">Paid</span>
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-y-4 gap-x-6">
                        <div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest block font-bold">Order Number</span>
                            <span class="font-mono font-bold text-gray-900 text-sm">{{ $order->order_number }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest block font-bold">Date Placed</span>
                            <span class="font-bold text-gray-700 text-xs sm:text-sm font-sans">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest block font-bold">Payment Method</span>
                            <span class="font-bold text-gray-700 text-xs sm:text-sm uppercase">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest block font-bold">Total Amount</span>
                            <span class="font-extrabold text-primary text-sm sm:text-base">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Items Purchased List -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-base font-serif font-bold text-gray-900 mb-4 pb-3 border-b border-gray-50">Items Ordered</h3>
                    <div class="divide-y divide-gray-50">
                        @foreach($order->items as $item)
                            @php
                                $productImage = $item->product ? $item->product->primary_image_url : asset('images/logo.jpeg');
                            @endphp
                            <div class="py-3 flex items-center gap-3 first:pt-0 last:pb-0">
                                <!-- Thumb -->
                                <div class="w-12 h-12 flex-shrink-0 bg-[#f5faf7] border border-gray-100 rounded-xl p-1 flex items-center justify-center">
                                    <img src="{{ $productImage }}" alt="{{ $item->product_name }}" class="max-w-full max-h-full object-contain">
                                </div>
                                <!-- Title/Qty -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-900 text-xs sm:text-sm truncate leading-tight">{{ $item->product_name }}</h4>
                                    <p class="text-[10px] text-gray-400 mt-1">${{ number_format($item->unit_price, 2) }} × {{ $item->quantity }}</p>
                                </div>
                                <!-- Price Total -->
                                <div class="text-right">
                                    <span class="font-extrabold text-gray-900 text-xs sm:text-sm">${{ number_format($item->total_price, 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Delivery & Shipping Information Side Card -->
            <div class="space-y-6">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm h-full">
                    <h3 class="text-base font-serif font-bold text-gray-900 mb-4 pb-3 border-b border-gray-50 flex items-center gap-2">
                        @if($order->delivery_type === 'self_pickup')
                            <i class="fa-solid fa-house-chimney text-gray-400"></i>
                            <span>Pickup Location</span>
                        @else
                            <i class="fa-solid fa-truck-ramp-box text-gray-400"></i>
                            <span>Shipping Address</span>
                        @endif
                    </h3>
                    <div class="space-y-3">
                        <div class="bg-[#f5faf7]/40 border border-gray-55/60 rounded-xl p-4">
                            @if($order->delivery_type === 'self_pickup')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold bg-amber-50 text-amber-700 mb-2 uppercase tracking-wide">Self Pickup</span>
                                <h4 class="font-extrabold text-gray-900 text-xs sm:text-sm leading-tight mb-2">Warehouse Pickup</h4>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold bg-blue-50 text-blue-700 mb-2 uppercase tracking-wide">Online Delivery</span>
                                <h4 class="font-extrabold text-gray-900 text-xs sm:text-sm leading-tight mb-2">{{ $order->shipping_name }}</h4>
                            @endif
                            <p class="text-[11px] sm:text-xs text-gray-600 leading-relaxed font-medium">
                                {{ $order->shipping_address }}<br>
                                {{ $order->shipping_city }}, {{ $order->shipping_state }}<br>
                                Postal Code: {{ $order->shipping_zip }}
                            </p>
                        </div>

                        @if($order->delivery_type === 'self_pickup')
                            <div class="flex items-center gap-2.5 px-1 py-0.5">
                                <i class="fa-solid fa-envelope text-xs text-gray-400"></i>
                                <span class="text-[11px] sm:text-xs font-bold text-gray-700">{{ \App\Models\Setting::get('site_email', 'Papperlemon1@gmail.com') }}</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2.5 px-1 py-0.5">
                                <i class="fa-solid fa-phone text-xs text-gray-400"></i>
                                <span class="text-[11px] sm:text-xs font-bold text-gray-700">{{ $order->shipping_phone }}</span>
                            </div>
                        @endif

                        @if($order->delivery_type === 'online_delivery' && $order->ups_tracking_number)
                            <div class="pt-3 border-t border-gray-100 space-y-2">
                                <span class="text-[10px] text-gray-400 uppercase tracking-widest block font-bold">UPS Tracking Number</span>
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-3 flex items-center justify-between">
                                    <span class="font-mono text-xs font-bold text-gray-800 select-all">{{ $order->ups_tracking_number }}</span>
                                    <a href="https://www.ups.com/track?tracknum={{ $order->ups_tracking_number }}" target="_blank" class="text-[10px] bg-primary text-white font-extrabold px-2.5 py-1.5 rounded-lg hover:bg-primary-dark transition cursor-pointer">
                                        Track
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Call Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center items-center max-w-md mx-auto">
            <a href="/shop" class="w-full sm:w-auto flex-grow bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-xl tracking-wider text-xs transition duration-200 text-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                CONTINUE SHOPPING
            </a>
            @if(auth()->check())
                <a href="/dashboard" class="w-full sm:w-auto flex-grow bg-white border border-gray-200 hover:border-gray-300 text-gray-700 hover:bg-gray-50 font-bold py-3 px-8 rounded-xl tracking-wider text-xs transition duration-200 text-center shadow-sm">
                    GO TO DASHBOARD
                </a>
            @else
                <a href="/login" class="w-full sm:w-auto flex-grow bg-white border border-gray-200 hover:border-gray-300 text-gray-700 hover:bg-gray-50 font-bold py-3 px-8 rounded-xl tracking-wider text-xs transition duration-200 text-center shadow-sm">
                    LOGIN TO TRACK ORDER
                </a>
            @endif
        </div>
    </div>
@endsection

