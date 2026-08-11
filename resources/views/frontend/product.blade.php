<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Pepperlemon | Product Detail</title>
<link rel="icon" href="{{ asset('images/logo.jpeg') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css?v=2') }}">
</head>
<body class="pl-product-page-body">

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
<header class="pl-page-header d-lg-none">
  <a href="{{ url('/shop') }}" class="pl-back-btn"><i class="bi bi-arrow-left"></i></a>
  <h1 id="mobile-product-title">{{ $product->name }}</h1>
  <div class="pl-header-icons">
    <a href="#" class="pl-icon-btn" style="width:34px;height:34px;"><i class="bi bi-share"></i></a>
  </div>
</header>

<main class="container pl-section" data-product id="pl-product-detail-container">

  <!-- desktop breadcrumb -->
  <nav class="d-none d-lg-block mb-3">
    <ol class="breadcrumb small" id="pl-breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ url('/shop') }}" class="text-decoration-none" id="pl-bread-cat">{{ $product->category->name ?? 'Category' }}</a></li>
      <li class="breadcrumb-item active" id="pl-bread-name">{{ $product->name }}</li>
    </ol>
  </nav>

  <div class="row g-4">
    <div class="col-lg-5">
      <div class="pl-detail-gallery" id="pl-main-image-wrap">
        @php $images = json_decode($product->images); $mainImage = ($images && count($images) > 0) ? asset($images[0]) : 'https://images.unsplash.com/photo-1599643478524-fb5244098775?w=500&q=80'; @endphp
        <img src="{{ $mainImage }}" alt="{{ $product->name }}" id="pl-main-image">
      </div>
      <div class="d-flex gap-2 mt-3 justify-content-center" id="pl-thumbnails-wrap">
        @if($images && count($images) > 1)
          @foreach($images as $idx => $img)
            <div class="pl-detail-thumbnail p-2 {{ $idx === 0 ? 'active' : '' }}" style="width:70px;height:70px;cursor:pointer;background:#fff;border:1px solid var(--pl-border);border-radius:8px;">
              <img src="{{ asset($img) }}" alt="Thumbnail {{ $idx + 1 }}" style="max-width:100%;max-height:100%;object-fit:contain;">
            </div>
          @endforeach
        @endif
      </div>
    </div>

    <div class="col-lg-7">
      <span class="badge rounded-pill mb-2" id="pl-product-badge" style="background:var(--pl-primary-light);color:var(--pl-primary-dark);">{{ $product->category->name ?? 'Details' }}</span>
      <h1 class="fs-4 fw-bold" id="pl-product-title" style="font-family:var(--pl-font-head);">
        {{ $product->name }}
      </h1>
      <div class="d-flex align-items-center gap-2 mb-3">
        <span class="text-warning">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
        </span>
        <span class="text-muted small">4.5 (128 reviews)</span>
      </div>

      <div class="fs-2 fw-bold mb-3" style="font-family:var(--pl-font-head);color:var(--pl-primary-dark);" id="pl-product-price-wrap">
        <span id="pl-product-price">₹{{ number_format($product->sale_price ?? $product->price, 2) }}</span> 
        @if($product->sale_price)
          <span class="pl-old" id="pl-product-old-price">₹{{ number_format($product->price, 2) }}</span>
        @endif
      </div>

      <hr>

      <div class="mb-3">
        <div class="fw-semibold mb-2">Add Quantity</div>
        <div class="pl-qty-stepper" id="pl-detail-qty-stepper">
          <button type="button" class="pl-minus">−</button>
          <span class="pl-qty-val" id="pl-detail-qty">1</span>
          <button type="button" class="pl-plus">+</button>
        </div>
      </div>

      <div class="d-flex flex-column flex-sm-row gap-2 mb-4">
        <button class="btn btn-pl-primary py-2 px-4 rounded-3 flex-grow-1" id="pl-add-to-cart-btn" onclick="PL.addToCartById('{{ $product->id }}')">
          <i class="bi bi-cart-plus me-2"></i>Add to Cart
        </button>
        <button class="pl-btn-outline py-2 px-4 rounded-3" style="width:auto;"><i class="bi bi-heart"></i></button>
      </div>

      <div class="row text-center g-2 mb-4">
        <div class="col-4">
          <div class="pl-product-card p-2">
            <i class="bi bi-truck fs-5" style="color:var(--pl-primary);"></i>
            <div class="small mt-1">Fast Delivery</div>
          </div>
        </div>
        <div class="col-4">
          <div class="pl-product-card p-2">
            <i class="bi bi-box-seam fs-5" style="color:var(--pl-primary);"></i>
            <div class="small mt-1">Bulk Case Pack</div>
          </div>
        </div>
        <div class="col-4">
          <div class="pl-product-card p-2">
            <i class="bi bi-shield-check fs-5" style="color:var(--pl-primary);"></i>
            <div class="small mt-1">Quality Assured</div>
          </div>
        </div>
      </div>

      <!-- ===================== ACCORDIONS ===================== -->
      <div>
        <div class="pl-accordion-item">
          <button class="pl-accordion-btn" aria-expanded="true" aria-controls="descPanel">
            Description <i class="bi bi-chevron-down"></i>
          </button>
          <div id="descPanel" class="pl-accordion-panel show" style="max-height:220px;overflow:hidden;transition:max-height .25s;">
            <p class="text-muted small pb-3" id="pl-product-desc">
              {{ $product->description }}
            </p>
          </div>
        </div>
        <div class="pl-accordion-item">
          <button class="pl-accordion-btn" aria-expanded="false" aria-controls="specPanel">
            Case Specifications <i class="bi bi-chevron-down"></i>
          </button>
          <div id="specPanel" class="pl-accordion-panel" style="max-height:0;overflow:hidden;transition:max-height .25s;">
            <ul class="text-muted small pb-3 mb-0" id="pl-product-specs">
              <!-- Dynamically populated -->
            </ul>
          </div>
        </div>
        <div class="pl-accordion-item">
          <button class="pl-accordion-btn" aria-expanded="false" aria-controls="shipPanel">
            Shipping & Returns <i class="bi bi-chevron-down"></i>
          </button>
          <div id="shipPanel" class="pl-accordion-panel" style="max-height:0;overflow:hidden;transition:max-height .25s;">
            <p class="text-muted small pb-3 mb-0">
              Orders ship within 1-2 business days from our Houston, TX warehouse. Damaged case returns accepted within 7 days of delivery.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- ===================== RELATED PRODUCTS ===================== -->
  <section class="pl-section">
    <div class="pl-section-head">
      <h2>You May Also Like</h2>
      <div class="pl-scroll-arrows d-none d-md-flex gap-2" data-scroll-target="related-products-render">
        <button type="button" class="scroll-prev"><i class="bi bi-chevron-left"></i></button>
        <button type="button" class="scroll-next"><i class="bi bi-chevron-right"></i></button>
      </div>
    </div>
    <div class="pl-hscroll" id="related-products-render">
      @foreach($relatedProducts as $relProduct)
      <div class="pl-hscroll-item" data-product>
        <div class="pl-product-card">
          <div class="pl-product-img-wrap">
            <button class="pl-wishlist-btn" onclick="PL.showToast('<i class=\'bi bi-heart-fill me-2\' style=\'color: #e63946;\'></i> Added to wishlist!')"><i class="bi bi-heart"></i></button>
            @php $rImages = json_decode($relProduct->images); $rImage = ($rImages && count($rImages) > 0) ? asset($rImages[0]) : 'https://images.unsplash.com/photo-1599643478524-fb5244098775?w=500&q=80'; @endphp
            <a href="{{ route('product.show', $relProduct->slug) }}"><img src="{{ $rImage }}" alt="{{ $relProduct->name }}"></a>
          </div>
          <div class="pl-product-body">
            <a href="{{ route('product.show', $relProduct->slug) }}" class="pl-product-title" title="{{ $relProduct->name }}">{{ $relProduct->name }}</a>
            <div class="pl-product-price">₹{{ number_format($relProduct->sale_price ?? $relProduct->price, 2) }}
              @if($relProduct->sale_price)
                <span class="pl-old">₹{{ number_format($relProduct->price, 2) }}</span>
              @endif
            </div>
            <div class="mt-auto d-flex gap-2">
              <a href="{{ route('product.show', $relProduct->slug) }}" class="pl-btn-outline text-center flex-grow-1 py-2">Details</a>
              <button class="btn btn-pl-primary px-3 d-flex align-items-center justify-content-center" style="border-radius:8px;" onclick="PL.addToCartById('{{ $relProduct->id }}')">
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

<!-- Mobile Sticky Add-to-Cart Bar -->
<div class="pl-mobile-sticky-bar d-lg-none" id="plMobileStickyBar">
  <div class="d-flex align-items-center justify-content-between gap-3">
    <div>
      <div class="small text-muted">Price</div>
      <div class="fw-bold fs-5" style="color:var(--pl-primary-dark);" id="pl-sticky-price">₹{{ number_format($product->sale_price ?? $product->price, 2) }}</div>
    </div>
    <div class="pl-qty-stepper" id="pl-sticky-qty-stepper" style="gap:8px;">
      <button type="button" class="pl-minus">−</button>
      <span class="pl-qty-val" id="pl-sticky-qty">1</span>
      <button type="button" class="pl-plus">+</button>
    </div>
    <button class="btn btn-pl-primary flex-grow-1 py-2 rounded-3" id="pl-sticky-add-btn" onclick="PL.addToCartById('{{ $product->id }}', parseInt(document.getElementById('pl-sticky-qty').textContent, 10))">
      Add to Cart
    </button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  window.pl_csrf = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/script.js?v=2') }}"></script>
</body>
</html>


