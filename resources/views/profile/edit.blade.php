@extends('layouts.frontend')

@section('title', 'Edit Profile')

@section('content')
    <!-- Profile Editing Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <!-- Breadcrumb & Title Inline -->
        <div class="mb-3 flex flex-wrap items-center justify-between gap-2 border-b border-gray-200 pb-2">
            <div>
                <h1 class="text-lg font-bold text-slate-900 tracking-tight" style="font-family: 'Outfit', sans-serif;">Account Settings</h1>
                <p class="text-[10px] md:text-[11px] text-gray-500 mt-0.5">
                    <a href="/" class="hover:text-primary text-black transition">Home</a> / 
                    <a href="/dashboard" class="hover:text-primary text-black transition">Dashboard</a> / 
                    <span class="text-black font-medium">Profile</span>
                </p>
            </div>
            <span class="text-[9px] text-primary font-bold bg-primary/10 px-2 py-0.5 rounded uppercase tracking-wider">Account Settings</span>
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

            <!-- Content Area: Forms -->
            <div class="w-full lg:w-3/4 space-y-3.5">
                <!-- Update Profile Info Form -->
                <div class="p-4 sm:p-5 bg-white border border-slate-150 rounded-xl shadow-xs">
                    <div class="max-w-3xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password Form -->
                <div class="p-4 sm:p-5 bg-white border border-slate-150 rounded-xl shadow-xs">
                    <div class="max-w-3xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User Form -->
                <div class="p-4 sm:p-5 bg-white border border-slate-150 rounded-xl shadow-xs">
                    <div class="max-w-3xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
