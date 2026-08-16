@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
    @php
        $address1 = '';
        $address2 = '';
        if (auth()->check() && auth()->user()->address) {
            $parts = explode("\n", auth()->user()->address, 2);
            $address1 = $parts[0] ?? '';
            $address2 = $parts[1] ?? '';
            
            if (empty($address2) && str_contains($address1, ',')) {
                $parts = explode(',', $address1, 2);
                $address1 = trim($parts[0]);
                $address2 = trim($parts[1]);
            }
        }
    @endphp
    <!-- Flash Messages (cancel/error/warning) -->
    @if(session('warning'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-3">
            <div class="flex items-start gap-2 bg-amber-50 border border-amber-200 text-amber-800 rounded-lg px-3 py-2 text-xs font-medium shadow-sm">
                <i class="fa-solid fa-triangle-exclamation mt-0.5 text-amber-500"></i>
                <span>{{ session('warning') }}</span>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-3">
            <div class="flex items-start gap-2 bg-rose-50 border border-rose-200 text-rose-800 rounded-lg px-3 py-2 text-xs font-medium shadow-sm">
                <i class="fa-solid fa-circle-xmark mt-0.5 text-rose-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Checkout Form -->
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-4 md:py-6">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-4 flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 pb-2">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight" style="font-family: 'Outfit', sans-serif;">Checkout</h1>
                <p class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">
                    <a href="/" class="hover:text-primary transition">Home</a> / 
                    <span class="text-gray-900 font-medium">Checkout</span>
                </p>
            </div>
            @guest
                <span class="text-[9px] text-primary font-bold bg-primary/10 px-2 py-0.5 rounded uppercase tracking-wider">Guest Checkout</span>
            @endguest
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded mb-4">
                <ul class="list-disc list-inside text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @guest
            <div class="mb-4 p-3 bg-primary/5 border border-primary/10 rounded-xl flex items-center gap-3 shadow-sm">
                <div class="h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                    <i class="fa-regular fa-user text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-600">Checking out as guest. Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Log in here</a>.</p>
                </div>
            </div>
        @endguest

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="flex flex-col lg:flex-row gap-5 lg:gap-8">
                <!-- Shipping details form -->
                <div class="w-full lg:w-2/3">
                    <h2 class="text-base font-bold text-gray-900 mb-3 pb-1.5 border-b border-gray-100 flex items-center gap-2" style="font-family: 'Outfit', sans-serif;">
                        <span class="inline-block w-1 h-4 bg-primary rounded-full"></span>
                        Shipping Details
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2.5">
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="shipping_name" value="{{ old('shipping_name', auth()->check() ? auth()->user()->name : '') }}" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="shipping_email" value="{{ old('shipping_email', auth()->check() ? auth()->user()->email : '') }}" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2.5">
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Phone Number <span class="text-red-500">*</span></label>
                            <input type="text" name="shipping_phone" value="{{ old('shipping_phone', auth()->check() ? auth()->user()->phone : '') }}" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200" placeholder="+1 (555) 000-0000">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">ZIP / Postal Code <span class="text-red-500">*</span></label>
                            <input type="text" name="shipping_zip" value="{{ old('shipping_zip', auth()->check() ? auth()->user()->zip : '') }}" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200">
                        </div>
                    </div>

                    <div class="mb-2.5">
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Flat / House No. / Building <span class="text-red-500">*</span></label>
                            <button type="button" id="detect-location-btn" class="text-[9px] text-primary bg-primary/5 hover:bg-primary/10 border border-primary/10 rounded-full px-2 py-0.5 font-semibold flex items-center gap-1 cursor-pointer transition">
                                <i class="fa-solid fa-location-crosshairs"></i> Auto-Detect
                            </button>
                        </div>
                        <input type="text" name="shipping_address" value="{{ old('shipping_address', $address1) }}" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200" placeholder="e.g. 1234 Main St, Apt 5B">
                    </div>

                    <div class="mb-2.5">
                        <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Area / Colony / Street / Landmark <span class="text-red-500">*</span></label>
                        <input type="text" name="shipping_address2" value="{{ old('shipping_address2', $address2) }}" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200" placeholder="e.g. Sector 12, near Kali Temple, Dwarka">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2.5">
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">City <span class="text-red-500">*</span></label>
                            <input type="text" name="shipping_city" value="{{ old('shipping_city', auth()->check() ? auth()->user()->city : '') }}" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">State <span class="text-red-500">*</span></label>
                            <input type="text" name="shipping_state" value="{{ old('shipping_state', auth()->check() ? auth()->user()->state : '') }}" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Order Notes (Optional)</label>
                        <textarea name="notes" rows="1.5" class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-900 shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition duration-200" placeholder="Special delivery instructions.">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Payment Methods -->
                    <h2 class="text-base font-bold text-gray-900 mb-3 pb-1.5 border-b border-gray-100 flex items-center gap-2 mt-4" style="font-family: 'Outfit', sans-serif;">
                        <span class="inline-block w-1 h-4 bg-primary rounded-full"></span>
                        Payment Method
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="flex items-center p-2.5 border border-gray-200 bg-white rounded-xl cursor-pointer hover:bg-primary/5 hover:border-primary/30 transition shadow-sm relative">
                            <input type="radio" name="payment_method" value="cod" checked class="h-4 w-4 text-primary focus:ring-primary border-gray-300 cursor-pointer">
                            <div class="ml-2.5">
                                <span class="font-bold text-gray-900 text-xs block">Cash on Delivery</span>
                                <span class="text-[10px] text-gray-400">Pay with cash upon arrival</span>
                            </div>
                            <div class="ms-auto text-primary opacity-60">
                                <i class="fa-solid fa-wallet text-base"></i>
                            </div>
                        </label>
                        <label class="flex items-center p-2.5 border border-gray-200 bg-white rounded-xl cursor-pointer hover:bg-primary/5 hover:border-primary/30 transition shadow-sm relative">
                            <input type="radio" name="payment_method" value="stripe" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 cursor-pointer">
                            <div class="ml-2.5 flex-1">
                                <span class="font-bold text-gray-900 text-xs block">Pay with Card</span>
                                <span class="text-[10px] text-gray-400">Visa, Mastercard, Amex &amp; more</span>
                            </div>
                            <div class="ms-auto flex items-center gap-1">
                                <svg viewBox="0 0 38 24" width="28" height="18" xmlns="http://www.w3.org/2000/svg"><rect width="38" height="24" rx="4" fill="#1a1f71"/><path d="M14.5 7l-2.5 10h-2l2.5-10h2zm7 0l-1 4.5c-.4-1-1.5-4.5-1.5-4.5h-2l2.5 10h1.5l3.5-10h-3zm-11 0H8l-3 10h2l.5-2h3l.5 2h2L10.5 7zm-2.5 6.5l1-4 1 4h-2zM28 9.5c0-.8-.6-2.5-3-2.5-2.5 0-3.5 1.5-3.5 3s1 2.5 3 3 2 1 2 1.5-.5 1-1.5 1c-1.5 0-2.5-1-2.5-1L21 16s1 1.5 3.5 1.5c2.3 0 3.5-1.5 3.5-3 0-1.6-1-2.5-3-3s-2-1-2-1.5.4-1 1.5-1c1 0 2 .5 2 .5L28 9.5z" fill="white"/></svg>
                                <svg viewBox="0 0 38 24" width="28" height="18" xmlns="http://www.w3.org/2000/svg"><rect width="38" height="24" rx="4" fill="#f0f0f0"/><circle cx="15" cy="12" r="7" fill="#eb001b"/><circle cx="23" cy="12" r="7" fill="#f79e1b"/><path d="M19 7.4a7 7 0 0 1 0 9.2A7 7 0 0 1 19 7.4z" fill="#ff5f00"/></svg>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Order summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white border border-gray-100 rounded-xl p-4 sticky top-28 shadow-md">
                        <h3 class="text-base font-serif font-bold text-gray-900 mb-3 border-b border-gray-100 pb-2" style="font-family: 'Outfit', sans-serif;">Your Order</h3>
                        
                        <div class="divide-y divide-gray-100 max-h-80 overflow-y-auto mb-3">
                            @foreach($cart as $id => $item)
                                @php
                                    $liveProduct = \App\Models\Product::find($id);
                                    $itemName = $liveProduct ? $liveProduct->name : $item['name'];
                                    $itemPrice = $liveProduct ? ($liveProduct->sale_price ?? $liveProduct->price) : $item['price'];
                                    $itemImage = $liveProduct ? $liveProduct->primary_image_url : $item['image'];
                                @endphp
                                <div class="flex justify-between items-center py-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-9 h-9 flex-shrink-0 bg-[#f5faf7] border border-gray-100 rounded-lg p-0.5 flex items-center justify-center">
                                            <img src="{{ $itemImage }}" alt="{{ $itemName }}" class="max-w-full max-h-full object-contain">
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-xs leading-tight max-w-[120px] truncate">{{ $itemName }}</h4>
                                            <span class="text-[9px] text-gray-400">Qty: {{ $item['quantity'] }}</span>
                                        </div>
                                    </div>
                                    <span class="font-bold text-gray-900 text-xs">${{ number_format($itemPrice * $item['quantity'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-2 mb-3 border-t border-gray-100 pt-2">
                            <div class="flex justify-between text-gray-500 text-xs">
                                <span>Subtotal</span>
                                <span class="font-semibold text-gray-900 font-sans">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500 text-xs">
                                <span>Shipping</span>
                                <span class="text-green-600 font-semibold uppercase text-[9px] tracking-wider">Free</span>
                            </div>
                            <hr class="border-gray-100">
                            <div class="flex justify-between text-xs font-bold text-gray-900">
                                <span>Grand Total</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-2 rounded-lg tracking-wider text-[11px] transition-all duration-300 shadow-md cursor-pointer hover:shadow-lg transform hover:-translate-y-0.5">
                            PLACE ORDER (${{ number_format($subtotal, 2) }})
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('detect-location-btn').addEventListener('click', function() {
        const btn = this;
        const originalText = btn.innerHTML;
        
        if (!navigator.geolocation) {
            alert('Geolocation is not supported by your browser.');
            return;
        }
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Detecting...';
        
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            
            // Call OpenStreetMap Nominatim reverse geocoding API
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&addressdetails=1`)
                .then(response => response.json())
                .then(data => {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                    
                    if (data && data.address) {
                        const addr = data.address;
                        
                        // Line 1: building/house number
                        const line1Parts = [
                            addr.house_number,
                            addr.building,
                            addr.road,
                        ].filter(Boolean);
                        const line1 = line1Parts.join(', ') || addr.road || '';
                        
                        // Line 2: area, colony, landmark
                        const line2Parts = [
                            addr.suburb,
                            addr.neighbourhood,
                            addr.village,
                            addr.city_district,
                        ].filter(Boolean);
                        const line2 = line2Parts.join(', ') || addr.county || '';
                        
                        document.querySelector('input[name="shipping_address"]').value = line1;
                        document.querySelector('input[name="shipping_address2"]').value = line2;
                        document.querySelector('input[name="shipping_city"]').value = addr.city || addr.town || addr.village || addr.county || '';
                        document.querySelector('input[name="shipping_state"]').value = addr.state || '';
                        document.querySelector('input[name="shipping_zip"]').value = addr.postcode || '';
                    } else {
                        alert('Could not resolve your address.');
                    }
                })
                .catch(error => {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                    alert('Error retrieving address from location.');
                });
        }, function(error) {
            btn.disabled = false;
            btn.innerHTML = originalText;
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert('User denied the request for Geolocation.');
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert('Location information is unavailable.');
                    break;
                case error.TIMEOUT:
                    alert('The request to get user location timed out.');
                    break;
                default:
                    alert('An unknown error occurred.');
                    break;
            }
        });
    });
</script>
@endpush

