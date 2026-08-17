<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Shop Joya Atelier flower designs including fresh roses, sunflowers, tulips, handcrafted fuzzy-wire bouquets, framed flowers, and gift baskets.">
    <title>Flowers | Joya Atelier</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="shop-header">
        <a class="brand shop-brand" href="{{ route('home') }}" aria-label="Joya Atelier home">
            <img class="brand-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
        </a>
        <nav class="shop-nav" aria-label="Flower page navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('events') }}">Events</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="#real-flowers">Fresh Flowers</a>
            <a href="#fuzzy-flowers">Fuzzy Wire</a>
            <a href="#ribbon-flowers">Ribbon Tape</a>
            <a href="#custom-order">Custom Order</a>
        </nav>
        <a class="header-cta" href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20would%20like%20to%20order%20flowers.">Order on WhatsApp</a>
    </header>

    <main>
        <section class="shop-hero">
            <div>
                <p class="eyebrow dark">Joya Atelier Flowers</p>
                <h1>Fresh blooms and handcrafted floral keepsakes.</h1>
                <p>
                    Choose real roses, sunflowers, tulips, floral baskets, framed flower gifts,
                    or fuzzy-wire bouquets made by hand for birthdays, anniversaries, graduations,
                    proposals, and everyday joy.
                </p>
                <div class="hero-actions">
                    <a class="primary-btn" href="#fuzzy-flowers">View Handcrafted Designs</a>
                    <a class="outline-btn" href="#ribbon-flowers">View Ribbon Flowers</a>
                </div>
            </div>
            <img src="{{ asset('images/flowers/pink-fuzzy-roses.jpg') }}" alt="Pink handcrafted fuzzy-wire rose bouquet with pearl details">
        </section>

        @if ($products->isNotEmpty())
            <section id="available-products" class="shop-section">
                <div class="section-heading">
                    <p class="eyebrow dark">Available Now</p>
                    <h2>Products managed from your admin dashboard.</h2>
                    <p class="section-intro">
                        These products are controlled from the admin side, so updates to images, prices, and descriptions can go live without editing code.
                    </p>
                </div>
                <div class="product-grid">
                    @foreach ($products as $product)
                        <article class="product-card">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @endif
                            <div>
                                <span>{{ $product->productCategory?->name ?: $product->category ?: 'Joya Atelier' }}</span>
                                <h3>{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                                @if ($product->price)
                                    <p><strong>KSh {{ number_format($product->price, 2) }}</strong></p>
                                @endif
                                <a href="https://wa.me/254746761556?text={{ rawurlencode('Hello Joya Atelier, I would like to order ' . $product->name . '.') }}">Order This Item</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <section id="real-flowers" class="shop-section">
            <div class="section-heading">
                <p class="eyebrow dark">Fresh Flowers</p>
                <h2>Fresh flowers for beautiful moments.</h2>
            </div>
            <div class="product-grid">
                <article class="product-card">
                    <img src="{{ asset('images/flowers/classic-rose-bouquet.avif') }}" alt="Fresh pink rose bouquet in a glass vase">
                    <div>
                        <span>Fresh Roses</span>
                        <h3>Classic Rose Bouquet</h3>
                        <p>Romantic fresh roses arranged for love, birthdays, apologies, and anniversaries.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20would%20like%20the%20Classic%20Rose%20Bouquet.">Order Roses</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="https://images.unsplash.com/photo-1543409777-30250849aa3e?auto=format&fit=crop&w=900&q=85" alt="Fresh sunflower bouquet">
                    <div>
                        <span>Fresh Sunflowers</span>
                        <h3>Sunshine Sunflower Bouquet</h3>
                        <p>Bright sunflowers for graduations, birthdays, thank-you gifts, and cheerful surprises.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20would%20like%20the%20Sunshine%20Sunflower%20Bouquet.">Order Sunflowers</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/flowers/colorful-tulip-wrap.jpg') }}" alt="Soft pink tulip bouquet wrapped in pastel paper">
                    <div>
                        <span>Fresh Tulips</span>
                        <h3>Colorful Tulip Wrap</h3>
                        <p>Soft, elegant tulips for birthdays, appreciation gifts, home styling, and spring moods.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20would%20like%20the%20Colorful%20Tulip%20Wrap.">Order Tulips</a>
                    </div>
                </article>
            </div>
        </section>

        <section id="fuzzy-flowers" class="shop-section alt-shop-section">
            <div class="section-heading">
                <p class="eyebrow dark">Handcrafted Fuzzy-Wire Flowers</p>
                <h2>Flowers that last beyond the day.</h2>
                <p class="section-intro">
                    These are handmade designs created with fuzzy wires for keepsake bouquets,
                    baskets, framed gifts, graduation presents, and personalized decor pieces.
                </p>
            </div>
            <div class="product-grid handmade-grid">
                <article class="product-card">
                    <img src="{{ asset('images/flowers/pink-blue-fuzzy-bouquet.jpg') }}" alt="Pink and blue handcrafted fuzzy-wire bouquet">
                    <div>
                        <span>Fuzzy Wire Bouquet</span>
                        <h3>Pink & Blue Lily Bouquet</h3>
                        <p>A soft statement bouquet with butterflies, layered wrap, and detailed handmade petals.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20a%20Pink%20and%20Blue%20Fuzzy%20Wire%20Bouquet.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/flowers/pink-fuzzy-roses.jpg') }}" alt="Pink handcrafted fuzzy-wire flower bouquet with pearl detail">
                    <div>
                        <span>Fuzzy Wire Roses</span>
                        <h3>Blush Pearl Bouquet</h3>
                        <p>Pink fuzzy-wire flowers finished with pearl details and a delicate lace-style wrap.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20a%20Blush%20Pearl%20Fuzzy%20Bouquet.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/flowers/basket-fuzzy-flowers.jpeg') }}" alt="Handcrafted flower basket with fuzzy-wire roses and lilies">
                    <div>
                        <span>Basket Gift</span>
                        <h3>Rose & Lily Basket</h3>
                        <p>A handcrafted basket arrangement with red roses, pink lilies, and a ribbon finish.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Rose%20and%20Lily%20Basket.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/flowers/fuzzy-sunflower.jpg') }}" alt="Handcrafted fuzzy-wire sunflower bouquet">
                    <div>
                        <span>Fuzzy Wire Sunflower</span>
                        <h3>Sunflower Keepsake</h3>
                        <p>A bright sunflower bouquet for graduations, birthdays, encouragement, and thank-you gifts.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Fuzzy%20Wire%20Sunflower%20Keepsake.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/flowers/neutral-fuzzy-floral.jpg') }}" alt="Neutral handcrafted fuzzy-wire bouquet with cream and brown flowers">
                    <div>
                        <span>Neutral Bouquet</span>
                        <h3>Cream Cocoa Floral Wrap</h3>
                        <p>Warm neutral handmade flowers with cream, cocoa, and soft botanical tones.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Cream%20Cocoa%20Floral%20Wrap.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/flowers/cream-fuzzy-bouquet.webp') }}" alt="Cream and brown handcrafted fuzzy-wire bouquet">
                    <div>
                        <span>Handmade Bouquet</span>
                        <h3>Vanilla Cocoa Bouquet</h3>
                        <p>A soft cream and brown keepsake bouquet with handmade daisies, roses, and tulip shapes.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Vanilla%20Cocoa%20Bouquet.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/flowers/framed-fuzzy-bouquet.jpg') }}" alt="Framed handcrafted fuzzy-wire flower gift">
                    <div>
                        <span>Framed Gift</span>
                        <h3>Light-Up Framed Bouquet</h3>
                        <p>A framed floral keepsake with a pink bouquet, ribbon detail, and decorative lights.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Light-Up%20Framed%20Bouquet.">Order This Design</a>
                    </div>
                </article>
            </div>
        </section>

        <section id="ribbon-flowers" class="shop-section ribbon-collection">
            <div class="section-heading">
                <p class="eyebrow dark">Ribbon Tape Flowers</p>
                <h2>Satin ribbon bouquets with a lasting luxury finish.</h2>
                <p class="section-intro">
                    Ribbon tape flowers are perfect for long-lasting gifts, graduation bouquets,
                    bridesmaid bouquets, romantic surprises, desk decor, and keepsakes.
                </p>
            </div>
            <div class="product-grid">
                <article class="product-card">
                    <img src="{{ asset('images/ribbon/red-pink-ribbon-roses.webp') }}" alt="Red and pink ribbon rose bouquet">
                    <div>
                        <span>Ribbon Roses</span>
                        <h3>Red & Pink Ribbon Roses</h3>
                        <p>A romantic bouquet of red and blush ribbon roses, wrapped boldly for love gifts and anniversaries.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Red%20and%20Pink%20Ribbon%20Roses.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/ribbon/purple-ribbon-roses.jpg') }}" alt="Purple handmade ribbon roses">
                    <div>
                        <span>Single Stems</span>
                        <h3>Purple Ribbon Rose Stems</h3>
                        <p>Glossy purple ribbon roses that can be sold as single stems, mini bunches, or custom bouquets.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20Purple%20Ribbon%20Rose%20Stems.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="{{ asset('images/ribbon/sunflower-ribbon-mix.jpg') }}" alt="Ribbon sunflower and rose bouquet">
                    <div>
                        <span>Ribbon Sunflowers</span>
                        <h3>Sunflower Ribbon Mix</h3>
                        <p>A cheerful handmade mix with ribbon sunflowers, roses, green details, and soft wrap styling.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Sunflower%20Ribbon%20Mix.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="https://i.pinimg.com/originals/88/dc/38/88dc380f747f2860f2c2605073a07b4b.jpg" alt="Pink and ivory satin ribbon flower bouquet">
                    <div>
                        <span>Ribbon Florals</span>
                        <h3>Blush Plumeria Ribbon Wrap</h3>
                        <p>Soft pink and ivory ribbon flowers with sparkling centers, perfect for delicate gifting.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Blush%20Plumeria%20Ribbon%20Wrap.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="https://i.etsystatic.com/53072036/r/il/9d68a9/6204794232/il_794xN.6204794232_6lyd.jpg" alt="Blue and ivory satin ribbon rose bouquet">
                    <div>
                        <span>Ribbon Roses</span>
                        <h3>Blue Ivory Ribbon Bouquet</h3>
                        <p>Soft blue and ivory ribbon roses with pearl-style details and elegant wrap presentation.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Blue%20Ivory%20Ribbon%20Bouquet.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="https://www.siyyah.pk/cdn/shop/files/WhatsAppImage2025-11-02at9.04.18PM.jpg?v=1762235326" alt="Red pink and lavender satin ribbon flower bouquet">
                    <div>
                        <span>Mixed Ribbon Bouquet</span>
                        <h3>Dahlia Rose Ribbon Mix</h3>
                        <p>A dramatic mix of satin ribbon roses, dahlias, and plumeria-style flowers in rich jewel tones.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Dahlia%20Rose%20Ribbon%20Mix.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="https://i.etsystatic.com/36758866/r/il/e6457a/5812471340/il_fullxfull.5812471340_eots.jpg" alt="Cream satin ribbon rose bouquet with gold details">
                    <div>
                        <span>Luxury Ribbon</span>
                        <h3>Cream Gold Ribbon Roses</h3>
                        <p>A refined cream rose bouquet with green leaves, gold accents, and a timeless keepsake feel.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Cream%20Gold%20Ribbon%20Roses.">Order This Design</a>
                    </div>
                </article>
                <article class="product-card">
                    <img src="https://i.etsystatic.com/54185065/r/il/cdfa60/6397845818/il_570xN.6397845818_m2u3.jpg" alt="Pink and lavender satin ribbon rose bouquet">
                    <div>
                        <span>Bold Ribbon Bouquet</span>
                        <h3>Pink Lavender Ribbon Roses</h3>
                        <p>Pink and lavender ribbon roses wrapped in a bold dark presentation for a modern gift moment.</p>
                        <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20want%20the%20Pink%20Lavender%20Ribbon%20Roses.">Order This Design</a>
                    </div>
                </article>
            </div>
        </section>

        <section id="custom-order" class="contact-section flower-order-section">
            <div class="contact-copy">
                <p class="eyebrow">Custom Flower Order</p>
                <h2>Want a custom bouquet?</h2>
                <p>
                    Send the flower type, colors, date, delivery location, and inspiration photo.
                    We can prepare fresh flowers, fuzzy-wire keepsakes, baskets, framed gifts, or mixed designs.
                </p>
                <a class="whatsapp-panel-link" href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20would%20like%20a%20custom%20flower%20order.">Start on WhatsApp</a>
            </div>
            <form class="contact-form" action="{{ route('booking.request') }}" method="post" enctype="multipart/form-data" data-whatsapp-form data-whatsapp-context="Joya Atelier custom flower request">
                @csrf
                <label>
                    <span>Name</span>
                    <input type="text" name="name" placeholder="Your name">
                </label>
                <label>
                    <span>Phone / WhatsApp</span>
                    <input type="tel" name="phone" placeholder="+254 746 761 556">
                </label>
                <label>
                    <span>Flower Type</span>
                    <select name="flower_type">
                        <option>Fresh flowers</option>
                        <option>Fuzzy-wire flowers</option>
                        <option>Ribbon-tape flowers</option>
                        <option>Mixed / custom design</option>
                    </select>
                </label>
                <div class="form-row">
                    <label>
                        <span>Delivery / Pickup Date</span>
                        <input type="date" name="delivery_date">
                    </label>
                    <label>
                        <span>Budget</span>
                        <span class="money-input">
                            <span>KSh</span>
                            <input type="number" name="budget" min="0" step="1" inputmode="numeric" placeholder="Type your budget">
                        </span>
                    </label>
                </div>
                <label>
                    <span>Delivery Location</span>
                    <input type="text" name="location" placeholder="Area or delivery address">
                </label>
                <label>
                    <span>Preferred Colors</span>
                    <input type="text" name="colors" placeholder="Pink, cream, red, yellow">
                </label>
                <label>
                    <span>Inspiration Photo</span>
                    <input type="file" name="inspiration_photo" accept="image/*">
                </label>
                <label>
                    <span>Order Details</span>
                    <textarea name="details" rows="4" placeholder="Tell us the occasion, flower design, size, and message card text"></textarea>
                </label>
                <button type="submit">Send Flower Request</button>
            </form>
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
            <p><a href="{{ route('home') }}">Home</a> | <a href="{{ route('about') }}">About</a> | <a href="{{ route('events') }}">Events</a> | <a href="{{ route('flowers') }}">Flowers</a> | <a href="{{ route('shop') }}">Shop</a> | <a href="#custom-order">Custom Order</a></p>
            <p>Instagram | TikTok | Facebook</p>
        </div>
    </footer>
</body>
</html>
