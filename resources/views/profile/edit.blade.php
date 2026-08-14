@extends('layouts.frontend')

@section('title', 'Edit Profile')

@section('content')
    <!-- Profile Editing Content -->
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-4 md:py-6">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-4 flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 pb-2">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight" style="font-family: 'Outfit', sans-serif;">Account Settings</h1>
                <p class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">
                    <a href="/" class="hover:text-primary transition">Home</a> / 
                    <a href="/dashboard" class="hover:text-primary transition">Dashboard</a> / 
                    <span class="text-gray-900 font-medium">Profile</span>
                </p>
            </div>
            <span class="text-[9px] text-primary font-bold bg-primary/10 px-2 py-0.5 rounded uppercase tracking-wider">Account Settings</span>
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
                    
                    <a href="{{ url('/dashboard') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('dashboard') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-chart-line mr-2.5 text-sm {{ request()->is('dashboard') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                            Dashboard Overview
                        </span>
                        @if(request()->is('dashboard'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/wishlist') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('wishlist') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-heart mr-2.5 text-sm {{ request()->is('wishlist') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                            My Wishlist
                        </span>
                        @if(request()->is('wishlist'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/cart') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('cart') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-cart-shopping mr-2.5 text-sm {{ request()->is('cart') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                            My Shopping Cart
                        </span>
                        @if(request()->is('cart'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('profile') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-user-gear mr-2.5 text-sm {{ request()->is('profile') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                            Account Settings
                        </span>
                        @if(request()->is('profile'))
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/contact') }}" class="group w-full px-3 py-2 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between {{ request()->is('contact') ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <span class="flex items-center">
                            <i class="fa-solid fa-headset mr-2.5 text-sm {{ request()->is('contact') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
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

            <!-- Content Area: Forms -->
            <div class="w-full lg:w-3/4 space-y-6">
                <!-- Update Profile Info Form -->
                <div class="p-4 sm:p-6 bg-[#f5faf7]/20 border border-gray-100 rounded-xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password Form -->
                <div class="p-4 sm:p-6 bg-[#f5faf7]/20 border border-gray-100 rounded-xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User Form -->
                <div class="p-4 sm:p-6 bg-[#f5faf7]/20 border border-gray-100 rounded-xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
