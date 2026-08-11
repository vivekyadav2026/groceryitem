<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Pepperlemon | Cart</title>
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

<!-- ===================== MOBILE PAGE HEADER ===================== -->
<header class="pl-page-header d-lg-none">
  <a href="{{ url('/') }}" class="pl-back-btn"><i class="bi bi-arrow-left"></i></a>
  <h1>My Cart</h1>
  <div class="pl-header-icons"></div>
</header>

<main class="container pl-section">
  <h2 class="d-none d-lg-block mb-4">Shopping Cart</h2>

  <div class="row g-4">
    <div class="col-lg-8">
      <div id="pl-cart-render">
        @if(empty($cart))
        <div class="pl-empty">
          <i class="bi bi-cart-x"></i>
          <p class="mb-2">Your cart is empty</p>
          <a href="{{ url('/shop') }}" class="btn btn-pl-primary btn-sm px-4 rounded-pill">Start Shopping</a>
        </div>
        @else
          @foreach($cart as $id => $item)
          <div class="pl-cart-item">
            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
            <div class="flex-grow-1">
              <div class="pl-product-title mb-1" style="min-height:auto;">{{ $item['name'] }}</div>
              <div class="text-muted small mb-2">₹{{ number_format($item['price'], 2) }} each</div>
              <div class="d-flex align-items-center gap-3">
                <div class="pl-qty-stepper" style="gap:8px;">
                  <button type="button" onclick="PL.setQty('{{ $id }}', {{ $item['quantity'] - 1 }})">−</button>
                  <span class="pl-qty-val">{{ $item['quantity'] }}</span>
                  <button type="button" class="pl-plus" onclick="PL.setQty('{{ $id }}', {{ $item['quantity'] + 1 }})">+</button>
                </div>
                <button class="pl-remove-btn" onclick="PL.removeFromCart('{{ $id }}')">
                  <i class="bi bi-trash3"></i> Remove
                </button>
              </div>
            </div>
            <div class="fw-bold text-nowrap" style="color:var(--pl-primary-dark);">
              ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
            </div>
          </div>
          @endforeach
        @endif
      </div>
    </div>
    <div class="col-lg-4">
      <div class="pl-cart-summary">
        <h5 class="fw-bold mb-3">Order Summary</h5>
        <div id="pl-cart-summary-body">
          @if(!empty($cart))
            @php 
              $subtotal = array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart));
              $delivery = $subtotal > 0 ? 5.99 : 0;
              $total = $subtotal + $delivery;
            @endphp
            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted">Subtotal</span><span>₹{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted">Delivery</span><span>₹{{ number_format($delivery, 2) }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
              <span>Total</span><span style="color:var(--pl-primary-dark);">₹{{ number_format($total, 2) }}</span>
            </div>
            <a href="{{ route('checkout.index') }}" class="btn btn-pl-primary w-100 py-2 rounded-3">
              Proceed to Checkout
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</main>

<!-- ===================== MOBILE BOTTOM NAV ===================== -->
<nav class="pl-bottom-nav d-lg-none">
  <a href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i>Home</a>
  <a href="{{ url('/shop') }}"><i class="bi bi-grid-3x3-gap-fill"></i>Categories</a>
  <a href="#"><i class="bi bi-speedometer2"></i>Dashboard</a>
  <a href="{{ url('/cart') }}" class="active">
    <i class="bi bi-cart3"></i>Cart
    <span class="pl-cart-dot" data-cart-badge style="{{ session()->has('cart') && array_sum(array_column(session('cart'), 'quantity')) > 0 ? 'display:flex;' : 'display:none;' }}">{{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
  </a>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  window.pl_csrf = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/script.js?v=2') }}"></script>
</body>
</html>


