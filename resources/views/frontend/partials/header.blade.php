<!-- ===================== DESKTOP NAVBAR ===================== -->
<header class="pl-navbar d-none d-lg-block">
  <div class="container d-flex align-items-center gap-4">
    <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none">
      <img src="{{ asset('images/logo.jpeg') }}" class="pl-logo-img" alt="Pepperlemon logo">
      <div>
        <div class="pl-brand-text">Pepperlemon</div>
        <div class="pl-brand-tag">Bold Flavor. Fresh Ideas.</div>
      </div>
    </a>
    <nav class="d-flex gap-4 flex-grow-1 justify-content-center">
      <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
      <a href="{{ route('shop') }}" class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}">Shop</a>
      <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
      <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
      <a href="{{ route('wishlist.index') }}" class="nav-link {{ request()->routeIs('wishlist.index') ? 'active' : '' }}">Wishlist</a>
      @auth
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
      @endauth
    </nav>
    <div class="d-flex align-items-center gap-3" style="max-width:520px;width:100%;">
      <form action="{{ route('shop') }}" method="GET" class="pl-search-wrap position-relative d-flex" style="max-width:520px;width:100%;flex:1;">
        <span class="pl-search-icon"><i class="bi bi-search"></i></span>
        <input type="search" name="search" class="form-control pl-search-input" placeholder="Search products, brands, categories..." value="{{ request('search') }}" autocomplete="off">
        <button class="pl-search-btn" type="submit" title="Search">
          <i class="bi bi-arrow-right"></i>
        </button>
      </form>
      <a href="{{ route('wishlist.index') }}" class="pl-icon-btn" title="Wishlist">
        <i class="bi bi-heart"></i>
        <span class="pl-badge-count" data-wishlist-badge style="{{ session()->has('wishlist') && count(session('wishlist')) > 0 ? 'display:flex;' : 'display:none;' }}">{{ session()->has('wishlist') ? count(session('wishlist')) : 0 }}</span>
      </a>
      <a href="{{ route('cart.index') }}" class="pl-icon-btn" title="Cart">
        <i class="bi bi-cart3"></i>
        <span class="pl-badge-count" data-cart-badge style="{{ session()->has('cart') && array_sum(array_column(session('cart'), 'quantity')) > 0 ? 'display:flex;' : 'display:none;' }}">{{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
      </a>
      @auth
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="pl-avatar" style="width:36px;height:36px;font-size:16px;background: var(--pl-primary); color: #fff;">
              {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="avatarDropdown" style="border-radius: 12px; margin-top: 10px;">
            <li><span class="dropdown-item-text text-muted small">Signed in as <strong>{{ Auth::user()->name }}</strong></span></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>My Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item text-danger cursor-pointer"><i class="bi bi-box-arrow-right me-2"></i>Log Out</button>
              </form>
            </li>
          </ul>
        </div>
      @else
        <a href="{{ route('login') }}" class="pl-icon-btn" title="Log In">
          <i class="bi bi-person"></i>
        </a>
      @endauth
    </div>
  </div>
</header>

<!-- ===================== MOBILE WELCOME HEADER ===================== -->
<header class="pl-welcome-bar d-lg-none">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none">
      <img src="{{ asset('images/logo.jpeg') }}" alt="Pepperlemon logo" style="height: 38px; width: auto; border-radius: 6px; object-contain;">
      <div>
        <div class="pl-name" style="color: var(--pl-primary-dark); font-weight: 700; font-size: 1.05rem; line-height: 1.1; font-family: var(--pl-font-head);">Pepperlemon</div>
        <div class="pl-hi" style="font-size: 0.65rem; color: var(--pl-muted); letter-spacing: 0.03em; text-transform: uppercase;">Bold Flavor. Fresh Ideas.</div>
      </div>
    </a>
    <div class="d-flex align-items-center gap-2">
      <a href="{{ route('cart.index') }}" class="pl-icon-btn" title="Cart" style="position: relative;">
        <i class="bi bi-cart3"></i>
        <span class="pl-badge-count" data-cart-badge style="{{ session()->has('cart') && array_sum(array_column(session('cart'), 'quantity')) > 0 ? 'display:flex;' : 'display:none;' }}">{{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
      </a>
      <a href="{{ route('wishlist.index') }}" class="pl-icon-btn" title="Wishlist" style="position: relative;">
        <i class="bi bi-heart"></i>
        <span class="pl-badge-count" data-wishlist-badge style="{{ session()->has('wishlist') && count(session('wishlist')) > 0 ? 'display:flex;' : 'display:none;' }}">{{ session()->has('wishlist') ? count(session('wishlist')) : 0 }}</span>
      </a>
    </div>
  </div>
</header>
