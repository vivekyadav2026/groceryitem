<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Pepperlemon | All Beverage</title>
<link rel="icon" href="{{ asset('images/logo.jpeg') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css?v=2') }}">
</head>
<body>

<!-- ===================== DESKTOP NAVBAR ===================== -->
<header class="pl-navbar d-none d-lg-block">
  <div class="container d-flex align-items-center gap-4">
    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">
      <img src="{{ asset('images/logo.jpeg') }}" class="pl-logo-img" alt="Pepperlemon logo">
      <div>
        <div class="pl-brand-text">Pepperlemon</div>
        <div class="pl-brand-tag">Bold Flavor. Fresh Ideas.</div>
      </div>
    </a>
    <nav class="d-flex gap-4 flex-grow-1 justify-content-center">
      <a href="{{ url('/') }}" class="nav-link">Home</a>
      <a href="{{ url('/shop') }}" class="nav-link active">Categories</a>
      <a href="#" class="nav-link">Dashboard</a>
      <a href="#" class="nav-link">Orders</a>
    </nav>
    <div class="d-flex align-items-center gap-3" style="max-width:520px;width:100%;">
      <input type="search" class="form-control pl-search-input" placeholder="Search products, brands, categories...">
      <a href="#" class="pl-icon-btn"><i class="bi bi-bell"></i></a>
      <a href="{{ url('/cart') }}" class="pl-icon-btn">
        <i class="bi bi-cart3"></i>
        <span class="pl-badge-count" data-cart-badge>{{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
      </a>
      <div class="pl-avatar" style="width:36px;height:36px;font-size:16px;">T</div>
    </div>
  </div>
</header>

<!-- ===================== MOBILE PAGE HEADER ===================== -->
<header class="pl-page-header d-lg-none flex-column gap-2 align-items-stretch">
  <div class="d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <a href="{{ url('/') }}" class="pl-back-btn"><i class="bi bi-arrow-left"></i></a>
      <h1 class="pl-header-title-text" id="mobile-category-title">All Beverage</h1>
    </div>
    <div class="pl-header-icons">
      <button class="pl-icon-btn" style="width:34px;height:34px;border:none;" id="mobile-filter-toggle"><i class="bi bi-sliders"></i></button>
    </div>
  </div>
  <div class="mt-1">
    <input type="search" class="form-control pl-search-input pl-mobile-search" placeholder="Search products, brands...">
  </div>
</header>

<main class="container-fluid container-lg pl-section">
  <div class="row">

    <!-- ===================== SIDEBAR FILTERS (desktop) ===================== -->
    <aside class="col-lg-3 d-none d-lg-block">
      <div class="pl-product-card p-3 mb-3">
        <h6 class="fw-bold mb-3">Categories</h6>
        <div id="desktop-categories-list">
          <!-- Dynamically rendered -->
        </div>
      </div>
      <div class="pl-product-card p-3">
        <h6 class="fw-bold mb-3">Price Range</h6>
        <input type="range" class="form-range" id="desktop-price-range" min="0" max="200" value="200">
        <div class="d-flex justify-content-between small text-muted"><span>₹0</span><span id="desktop-price-max-label">₹200</span></div>
      </div>
    </aside>

    <!-- ===================== PRODUCT GRID ===================== -->
    <div class="col-lg-9">
      <div class="pl-filter-bar px-0">
        <span id="pl-product-count">Showing 0 of 0</span>
        <select class="pl-sort-select" id="pl-sort-select">
          <option value="default">Default</option>
          <option value="price-asc">Price: Low to High</option>
          <option value="price-desc">Price: High to Low</option>
        </select>
      </div>

      <div class="row g-3" id="category-products-render">
        @forelse($products as $product)
        <div class="col-6 col-md-4 col-lg-3" data-product>
          <div class="pl-product-card">
            <div class="pl-product-img-wrap">
              <button class="pl-wishlist-btn" onclick="PL.showToast('<i class=\'bi bi-heart-fill me-2\' style=\'color: #e63946;\'></i> Added to wishlist!')"><i class="bi bi-heart"></i></button>
              @php $images = json_decode($product->images); $image = ($images && count($images) > 0) ? asset($images[0]) : 'https://images.unsplash.com/photo-1599643478524-fb5244098775?w=500&q=80'; @endphp
              <a href="{{ route('product.show', $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}"></a>
            </div>
            <div class="pl-product-body">
              <a href="{{ route('product.show', $product->slug) }}" class="pl-product-title" title="{{ $product->name }}">{{ $product->name }}</a>
              <div class="pl-product-price">₹{{ number_format($product->sale_price ?? $product->price, 2) }}
                @if($product->sale_price)
                  <span class="pl-old">₹{{ number_format($product->price, 2) }}</span>
                @endif
              </div>
              <div class="mt-auto d-flex gap-2">
                <a href="{{ route('product.show', $product->slug) }}" class="pl-btn-outline text-center flex-grow-1 py-2">Details</a>
                <button class="btn btn-pl-primary px-3 d-flex align-items-center justify-content-center" style="border-radius:8px;" onclick="PL.addToCartById('{{ $product->id }}')">
                  <i class="bi bi-cart-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 py-5 text-center text-muted">
          <i class="bi bi-search fs-2 mb-2 d-block"></i>
          No products match the selected filters.
        </div>
        @endforelse
      </div>

      <div class="mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</main>

<!-- ===================== MOBILE BOTTOM NAV ===================== -->
<nav class="pl-bottom-nav d-lg-none">
  <a href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i>Home</a>
  <a href="{{ url('/shop') }}" class="active"><i class="bi bi-grid-3x3-gap-fill"></i>Categories</a>
  <a href="#"><i class="bi bi-speedometer2"></i>Dashboard</a>
  <a href="{{ url('/cart') }}">
    <i class="bi bi-cart3"></i>Cart
    <span class="pl-cart-dot" data-cart-badge style="{{ session()->has('cart') && array_sum(array_column(session('cart'), 'quantity')) > 0 ? 'display:flex;' : 'display:none;' }}">{{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
  </a>
</nav>

<!-- ===================== MOBILE FILTER DRAWER ===================== -->
<div class="pl-filter-drawer" id="mobileFilterDrawer">
  <div class="pl-drawer-overlay" id="mobileDrawerOverlay"></div>
  <div class="pl-drawer-content">
    <div class="pl-drawer-handle"></div>
    <div class="pl-drawer-header" style="border-top:none;padding-top:8px;">
      <h5>Filters</h5>
      <button class="pl-close-drawer-btn" id="mobileFilterClose"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="pl-drawer-body">
      <div class="pl-filter-section mb-3">
        <h6 class="fw-bold mb-2">Categories</h6>
        <div id="mobile-categories-list">
          <!-- Populated dynamically -->
        </div>
      </div>
      <div class="pl-filter-section mb-3">
        <h6 class="fw-bold mb-2">Price Range</h6>
        <input type="range" class="form-range" id="mobile-price-range" min="0" max="200" value="200">
        <div class="d-flex justify-content-between small text-muted">
          <span>₹0</span><span id="mobile-price-max-label">₹200</span>
        </div>
      </div>
      <button class="btn btn-pl-primary w-100 py-2 rounded-3" id="mobileFilterApply">Apply Filters</button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  window.pl_csrf = '{{ csrf_token() }}';
  window.pl_total_products = {{ $products->total() }};
</script>
<script src="{{ asset('js/script.js?v=2') }}"></script>
</body>
</html>


