<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Shop Joya Atelier flowers, event gifts, handcrafted bouquets, and decor pieces in Kenya.">
    <title>Shop | Joya Atelier</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="shop-header">
        <a class="brand shop-brand" href="{{ route('home') }}" aria-label="Joya Atelier home">
            <img class="brand-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
        </a>
        <nav class="shop-nav" aria-label="Shop page navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('events') }}">Events</a>
            <a href="{{ route('flowers') }}">Flowers</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('booking') }}">Booking</a>
        </nav>
        <button class="header-cta cart-open-button" type="button" data-cart-open>Cart <span data-cart-count>0</span></button>
    </header>

    <main>
        <section class="shop-section shop-products-first">
            <div class="section-heading">
                <p class="eyebrow dark">Joya Atelier Shop</p>
                <h1>Products</h1>
            </div>

            <div class="product-grid">
                @forelse ($products as $product)
                    <article class="product-card shop-product-card" data-gallery-group="shop-products">
                        @if ($product->is_on_sale)
                            <strong class="sale-badge">
                                {{ $product->sale_label ?: 'Flash Sale' }}
                                @if ($product->discount_percent)
                                    - {{ $product->discount_percent }}% Off
                                @endif
                            </strong>
                        @endif
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/flowers/pink-fuzzy-roses.jpg') }}" alt="{{ $product->name }}">
                        @endif
                        <div>
                            <span>{{ $product->productCategory?->name ?: $product->category ?: 'Joya Atelier' }}</span>
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                            <p class="shop-price">
                                @if ($product->previous_price && $product->previous_price > $product->price)
                                    <del>KSh {{ number_format((float) $product->previous_price, 2) }}</del>
                                @endif
                                <strong>KSh {{ number_format((float) $product->price, 2) }}</strong>
                            </p>
                            <button
                                type="button"
                                data-add-to-cart
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-price="{{ (float) $product->price }}"
                                data-product-image="{{ $product->image ? asset('storage/' . $product->image) : asset('images/flowers/pink-fuzzy-roses.jpg') }}"
                            >
                                Add to Cart
                            </button>
                        </div>
                    </article>
                @empty
                    <div class="empty-shop">
                        <h3>No products have been published yet.</h3>
                        <p>Add products from the admin dashboard, then publish them so they appear in the shop.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div>
            <img class="footer-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
            <p>EVENTS &bull; DECOR &bull; FLORALS</p>
        </div>
        <div>
            <p>Phone: +254 746 761 556</p>
            <p>WhatsApp: +254 746 761 556</p>
            <p>Email: joygachanja10@gmail.com</p>
            <p>Location: Nairobi, Kenya</p>
        </div>
        <div>
            <p><a href="{{ route('home') }}">Home</a> | <a href="{{ route('events') }}">Events</a> | <a href="{{ route('flowers') }}">Flowers</a> | <a href="{{ route('shop') }}">Shop</a></p>
        </div>
    </footer>
</body>
</html>
