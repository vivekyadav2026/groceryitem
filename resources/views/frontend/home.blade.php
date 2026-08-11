<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Pepperlemon | Home</title>
<link rel="icon" href="{{ asset('images/logo.jpeg') }}">
<!-- Bootstrap -->
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
      <a href="{{ url('/') }}" class="nav-link active">Home</a>
      <a href="{{ url('/shop') }}" class="nav-link">Categories</a>
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

<!-- ===================== MOBILE WELCOME HEADER ===================== -->
<header class="pl-welcome-bar d-lg-none">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <div class="pl-avatar">P</div>
      <div>
        <div class="pl-hi">👋 Welcome to</div>
        <div class="pl-name">Pepperlemon</div>
      </div>
    </div>
    <div class="d-flex align-items-center gap-2">
      <a href="#" class="pl-icon-btn"><i class="bi bi-bell"></i></a>
      <a href="#" class="pl-icon-btn"><i class="bi bi-sliders"></i></a>
    </div>
  </div>
</header>

<main class="container pl-section">

  <!-- ===================== HERO BANNER ===================== -->
  <div class="pl-hero-banner mb-4">
    <img src="{{ asset('images/hero_banner.jpg?v=2') }}" alt="Fresh Groceries & Beverages Banner" class="pl-hero-img">
    <div class="pl-hero-overlay"></div>
    <div class="pl-hero-content">
      <span class="pl-hero-tag">Weekly Special Deals</span>
      <h1 class="pl-hero-title">Fresh Ideas.<br>Bold Flavors.</h1>
      <p class="pl-hero-desc">Up to 30% off on premium beverages and chocolates</p>
      <a href="{{ url('/shop') }}" class="btn btn-pl-yellow px-4 py-2 rounded-pill">Shop Now</a>
    </div>
  </div>

  <!-- ===================== TOP CATEGORIES ===================== -->
  <section class="pl-section pt-0">
    <div class="pl-section-head">
      <h2>Top Categories</h2>
      <a href="{{ url('/shop') }}" class="pl-view-all">View All</a>
    </div>
    <div class="pl-cat-list">
      <a href="{{ url('/shop') }}?cat=mexican" class="pl-cat-pill text-decoration-none">
        <div class="pl-cat-icon"><i class="bi bi-cup-straw"></i></div>
        <span>Mexican Product</span>
      </a>
      <a href="{{ url('/shop') }}?cat=beverage" class="pl-cat-pill text-decoration-none">
        <div class="pl-cat-icon"><i class="bi bi-snow2"></i></div>
        <span>Beverage / Can</span>
      </a>
      <a href="{{ url('/shop') }}?cat=candy" class="pl-cat-pill text-decoration-none">
        <div class="pl-cat-icon"><i class="bi bi-gift"></i></div>
        <span>Grocery / Candy</span>
      </a>
      <a href="{{ url('/shop') }}?cat=snacks" class="pl-cat-pill text-decoration-none">
        <div class="pl-cat-icon"><i class="bi bi-basket"></i></div>
        <span>Snacks</span>
      </a>
      <a href="{{ url('/shop') }}?cat=water" class="pl-cat-pill text-decoration-none">
        <div class="pl-cat-icon"><i class="bi bi-droplet"></i></div>
        <span>Water</span>
      </a>
      <a href="{{ url('/shop') }}?cat=chocolate" class="pl-cat-pill text-decoration-none">
        <div class="pl-cat-icon"><i class="bi bi-box-seam"></i></div>
        <span>Chocolate</span>
      </a>
    </div>
  </section>

  <!-- ===================== NEW PRODUCTS ===================== -->
  <section class="pl-section">
    <div class="pl-section-head">
      <h2>New Products</h2>
      <div class="pl-scroll-arrows d-none d-md-flex gap-2" data-scroll-target="new-products-render">
        <button type="button" class="scroll-prev"><i class="bi bi-chevron-left"></i></button>
        <button type="button" class="scroll-next"><i class="bi bi-chevron-right"></i></button>
      </div>
    </div>
    <div class="pl-hscroll" id="new-products-render">
      @foreach($featuredProducts as $product)
      <div class="pl-hscroll-item" data-product>
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
      @endforeach
    </div>
  </section>

  <!-- ===================== BEST SELLERS ===================== -->
  <section class="pl-section">
    <div class="pl-section-head">
      <h2>Best Sellers</h2>
      <div class="pl-scroll-arrows d-none d-md-flex gap-2" data-scroll-target="best-sellers-render">
        <button type="button" class="scroll-prev"><i class="bi bi-chevron-left"></i></button>
        <button type="button" class="scroll-next"><i class="bi bi-chevron-right"></i></button>
      </div>
    </div>
    <div class="pl-hscroll" id="best-sellers-render">
      @foreach($bestSellers as $product)
      <div class="pl-hscroll-item" data-product>
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
      @endforeach
    </div>
  </section>

  <!-- ===================== FEATURED PRODUCTS ===================== -->
  <section class="pl-section">
    <div class="pl-section-head">
      <h2>Featured Products</h2>
      <a href="{{ url('/shop') }}" class="pl-view-all">View All</a>
    </div>
    <div class="row g-3" id="featured-products-render">
      @foreach($featuredProducts as $product)
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
      @endforeach
    </div>
  </section>

</main>

<!-- ===================== FOOTER (DESKTOP) ===================== -->
<footer class="pl-footer d-none d-lg-block">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="d-flex align-items-center gap-2 mb-3">
          <img src="{{ asset('images/logo.jpeg') }}" class="pl-footer-logo" alt="Pepperlemon logo">
          <span class="fw-bold fs-5">Pepperlemon LLC</span>
        </div>
        <p class="mb-1"><i class="bi bi-geo-alt me-2"></i>12800 Northborough Dr, Houston, TX 77067</p>
        <p class="mb-1"><i class="bi bi-envelope me-2"></i>Papperlemon1@gmail.com</p>
      </div>
      <div class="col-6 col-lg-2">
        <h6 class="text-white mb-3">Shop</h6>
        <p><a href="{{ url('/') }}">Home</a></p>
        <p><a href="{{ url('/shop') }}">Categories</a></p>
        <p><a href="{{ url('/cart') }}">Cart</a></p>
      </div>
      <div class="col-6 col-lg-2">
        <h6 class="text-white mb-3">Company</h6>
        <p><a href="#">About Us</a></p>
        <p><a href="#">Contact</a></p>
        <p><a href="#">Careers</a></p>
      </div>
      <div class="col-lg-4">
        <h6 class="text-white mb-3">Stay in the loop</h6>
        <div class="d-flex gap-2">
          <input type="email" class="form-control" placeholder="Your email">
          <button class="btn btn-pl-primary">Join</button>
        </div>
      </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between flex-wrap gap-2">
      <span>&copy; 2026 Pepperlemon LLC. All rights reserved.</span>
      <span>Bold Flavor. Fresh Ideas.</span>
    </div>
  </div>
</footer>

<!-- ===================== MOBILE BOTTOM NAV ===================== -->
<nav class="pl-bottom-nav d-lg-none">
  <a href="{{ url('/') }}" class="active"><i class="bi bi-house-door-fill"></i>Home</a>
  <a href="{{ url('/shop') }}"><i class="bi bi-grid-3x3-gap-fill"></i>Categories</a>
  <a href="#"><i class="bi bi-speedometer2"></i>Dashboard</a>
  <a href="{{ url('/cart') }}">
    <i class="bi bi-cart3"></i>Cart
    <span class="pl-cart-dot" data-cart-badge style="{{ session()->has('cart') && array_sum(array_column(session('cart'), 'quantity')) > 0 ? 'display:flex;' : 'display:none;' }}">{{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
  </a>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Setup CSRF token for AJAX requests
  window.pl_csrf = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/script.js?v=2') }}"></script>
</body>
</html>


