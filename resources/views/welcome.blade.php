<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Joya Atelier creates luxury event decor, fresh flowers, and complete styling for celebrations, gifting, weddings, corporate events, and galas.">
    <title>Joya Atelier | Events, Florals & Styling</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="image-hero-page">
    <header class="shop-header home-top-menu">
        <a class="brand shop-brand" href="{{ route('home') }}" aria-label="Joya Atelier home">
            <img class="brand-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
        </a>
        <nav class="shop-nav" aria-label="Primary navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('events') }}">Events</a>
            <a href="{{ route('flowers') }}">Flowers</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('booking') }}">Booking</a>
        </nav>
    </header>

    <main id="home">
        <section class="hero-section image-hero" data-hero-carousel>
            <div class="hero-slides" aria-hidden="true">
                <img
                    class="hero-image is-active"
                    src="{{ asset('images/events/joya-hero-birthday-pink-gold.png') }}"
                    alt=""
                >
                <img
                    class="hero-image"
                    src="{{ asset('images/events/joya-hero-blush-tablescape.png') }}"
                    alt=""
                >
                <img
                    class="hero-image"
                    src="{{ asset('images/events/joya-hero-bride-to-be-sage.png') }}"
                    alt=""
                >
                <img
                    class="hero-image"
                    src="{{ asset('images/events/joya-hero-blue-gold-wedding.png') }}"
                    alt=""
                >
                <img
                    class="hero-image"
                    src="{{ asset('images/events/joya-hero-better-together.png') }}"
                    alt=""
                >
            </div>
            <div class="hero-action-bar" aria-label="Joya Atelier quick actions">
                <a class="primary-btn" href="{{ route('booking') }}">Book Your Event</a>
                <a class="secondary-btn" href="{{ route('shop') }}">Shop Now</a>
            </div>
            <div class="hero-slide-dots" aria-label="Hero slideshow progress">
                <span class="is-active"></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </section>

        <section id="work" class="gallery-section">
            <div class="section-heading">
                <p class="eyebrow dark">Featured Work</p>
                <h2>Moments We've Styled</h2>
                <div class="gallery-tags" aria-label="Featured work categories">
                    <span>Birthday</span>
                    <span>Wedding</span>
                    <span>Bridal Shower</span>
                    <span>Baby Shower</span>
                    <span>Graduation</span>
                    <span>Corporate</span>
                </div>
            </div>
            <div class="gallery-grid">
                <figure class="gallery-large">
                    <a href="{{ route('events') }}">
                        <img src="{{ asset('images/events/joya-event-setup-pink-gold.png') }}" alt="Pink and gold event setup with balloons, florals, candles, and table styling">
                        <figcaption>Signature event setup</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="{{ route('events') }}">
                        <img src="{{ asset('images/events/black-bows-birthday.jpg') }}" alt="Black and silver birthday balloon decor inspiration">
                        <figcaption>Birthday balloon decor</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="{{ route('events') }}">
                        <img src="{{ asset('images/events/romantic-love-setup.jpg') }}" alt="Romantic surprise setup with candles and rose petals">
                        <figcaption>Romantic surprise setup</figcaption>
                    </a>
                </figure>
            </div>
        </section>

        @if ($services->isNotEmpty())
            <section id="services" class="content-section why-section">
                <div class="section-heading">
                    <p class="eyebrow dark">Services</p>
                    <h2>Event styling and floral services from the Joya Atelier admin.</h2>
                </div>
                <div class="why-grid">
                    @foreach ($services as $service)
                        <article>
                            @if ($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                            @endif
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->description }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <section id="flowers" class="content-section flower-section">
            <div class="section-heading">
                <p class="eyebrow dark">Featured Flowers</p>
                <h2>Flowers For Every Beautiful Moment</h2>
            </div>
            <div class="flower-grid">
                @forelse ($featuredProducts as $product)
                    <article>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @endif
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->productCategory?->name ?: $product->category ?: 'Joya Atelier product' }}</p>
                        @if ($product->price)
                            <p>KSh {{ number_format($product->price, 2) }}</p>
                        @endif
                    </article>
                @empty
                    <article>
                        <img src="{{ asset('images/flowers/pink-fuzzy-roses.jpg') }}" alt="Pink handcrafted fuzzy-wire bouquet">
                        <h3>Blush Pearl Fuzzy Bouquet</h3>
                        <p>Handcrafted keepsake</p>
                    </article>
                    <article>
                        <img src="{{ asset('images/flowers/basket-fuzzy-flowers.jpeg') }}" alt="Handcrafted basket with fuzzy-wire flowers">
                        <h3>Rose & Lily Basket</h3>
                        <p>Gift arrangement</p>
                    </article>
                    <article>
                        <img src="{{ asset('images/ribbon/red-pink-ribbon-roses.webp') }}" alt="Red and pink ribbon rose bouquet">
                        <h3>Red & Pink Ribbon Roses</h3>
                        <p>Ribbon tape bouquet</p>
                    </article>
                    <article>
                        <img src="{{ asset('images/flowers/fuzzy-sunflower.jpg') }}" alt="Handcrafted fuzzy-wire sunflower bouquet">
                        <h3>Sunflower Keepsake</h3>
                        <p>Bright handmade gift</p>
                    </article>
                @endforelse
            </div>
            <div class="section-action">
                <a class="primary-btn" href="{{ route('shop') }}">Shop All Products</a>
                <p>Same-day delivery can be added for selected service areas.</p>
            </div>
        </section>

        <section id="occasions" class="occasion-section">
            <div class="section-heading">
                <p class="eyebrow dark">Occasions</p>
                <h2>Made For Your Moment</h2>
            </div>
            <div class="occasion-grid">
                <article style="--occasion-image: url('{{ asset('images/events/black-bows-birthday.jpg') }}')"><span>Birthday</span></article>
                <article style="--occasion-image: url('{{ asset('images/events/floral-wedding-aisle.jpg') }}')"><span>Wedding</span></article>
                <article style="--occasion-image: url('{{ asset('images/events/bride-to-be-pink.jpg') }}')"><span>Bridal Shower</span></article>
                <article style="--occasion-image: url('{{ asset('images/events/baby-shower-pink-gold.jpg') }}')"><span>Baby Shower</span></article>
                <article style="--occasion-image: url('{{ asset('images/events/bedroom-birthday-balloons.jpg') }}')"><span>Graduation</span></article>
                <article style="--occasion-image: url('{{ asset('images/events/romantic-love-setup.jpg') }}')"><span>Anniversary</span></article>
                <article style="--occasion-image: url('{{ asset('images/events/wedding-candle-tablescape.jpeg') }}')"><span>Corporate Event</span></article>
            </div>
        </section>

        <section id="why" class="content-section why-section">
            <div class="section-heading">
                <p class="eyebrow dark">Why Choose Joya Atelier?</p>
                <h2>Designed with intention, finished with care.</h2>
            </div>
            <div class="why-grid">
                <article>
                    <h3>Designed With Intention</h3>
                    <p>Every setup is carefully styled around your vision, colors, venue, and occasion.</p>
                </article>
                <article>
                    <h3>Beautifully Detailed</h3>
                    <p>From the smallest floral arrangement to the full backdrop, every detail matters.</p>
                </article>
                <article>
                    <h3>Personalized</h3>
                    <p>Your theme, your personality, and your story guide the creative direction.</p>
                </article>
                <article>
                    <h3>Reliable</h3>
                    <p>Professional setup and coordination from first enquiry to final reveal.</p>
                </article>
            </div>
        </section>

        <section class="testimonial-section">
            <div class="section-heading light-heading">
                <p class="eyebrow">Testimonials</p>
                <h2>Our Clients Say It Best</h2>
            </div>
            <div class="testimonial-grid">
                @forelse ($testimonials as $testimonial)
                    <blockquote>
                        <span>{{ $testimonial->rating }} stars</span>
                        "{{ $testimonial->message }}"
                        <cite>- {{ $testimonial->client_name }}{{ $testimonial->occasion ? ', ' . $testimonial->occasion : '' }}</cite>
                    </blockquote>
                @empty
                    <blockquote>
                        <span>5 stars</span>
                        "The decor was absolutely beautiful. Everything looked even better than I imagined."
                        <cite>- Sarah, Birthday Celebration</cite>
                    </blockquote>
                    <blockquote>
                        <span>5 stars</span>
                        "The flowers, backdrop, and table details worked together perfectly."
                        <cite>- Nia, Bridal Shower</cite>
                    </blockquote>
                    <blockquote>
                        <span>5 stars</span>
                        "Elegant, professional, and calm from planning to setup."
                        <cite>- Amina, Graduation Party</cite>
                    </blockquote>
                @endforelse
            </div>
        </section>

        @if ($articles->isNotEmpty())
            <section class="content-section">
                <div class="section-heading">
                    <p class="eyebrow dark">Journal</p>
                    <h2>Latest advice and inspiration from Joya Atelier.</h2>
                </div>
                <div class="why-grid">
                    @foreach ($articles as $article)
                        <article>
                            @if ($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}">
                            @endif
                            <h3>{{ $article->title }}</h3>
                            <p>{{ $article->excerpt }}</p>
                            <a href="{{ route('blog.show', $article) }}">Read Article</a>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <section id="booking" class="contact-section">
            <div class="contact-copy">
                <p class="eyebrow">Start Here</p>
                <h2>Let's Start With Your Idea</h2>
                <p>
                    Tell us what you are planning and we will guide you to the right next step,
                    whether it is full event styling, flowers, or a custom surprise setup.
                </p>
                <a class="whatsapp-panel-link" href="https://wa.me/254746761556">Chat on WhatsApp</a>
            </div>
            <div class="quick-paths" aria-label="Choose how to start with Joya Atelier">
                <a href="{{ route('booking') }}">
                    <span>01</span>
                    <strong>Plan an Event</strong>
                    <em>Use the full booking form for dates, guest count, theme, venue, and setup details.</em>
                </a>
                <a href="{{ route('flowers') }}">
                    <span>02</span>
                    <strong>Shop Products</strong>
                    <em>Explore fresh bouquets, handmade flowers, ribbon designs, and custom gift pieces.</em>
                </a>
                <a href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20would%20like%20to%20ask%20about%20an%20event%20or%20flower%20order.">
                    <span>03</span>
                    <strong>Ask a Question</strong>
                    <em>Start on WhatsApp if you are still deciding what you need or want quick guidance.</em>
                </a>
            </div>
        </section>

        <section class="social-section">
            <p class="eyebrow dark">Follow Our Latest Creations</p>
            <h2>See what Joya Atelier is creating next.</h2>
            <div class="social-links">
                <a href="https://www.instagram.com/">Instagram</a>
                <a href="https://www.tiktok.com/">TikTok</a>
                <a href="https://www.facebook.com/">Facebook</a>
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
            <p><a href="{{ route('home') }}">Home</a> | <a href="{{ route('about') }}">About</a> | <a href="{{ route('events') }}">Events</a> | <a href="{{ route('flowers') }}">Flowers</a> | <a href="{{ route('shop') }}">Shop</a> | <a href="{{ route('home') }}#work">Gallery</a> | <a href="{{ route('booking') }}">Booking</a></p>
            <p>Instagram | TikTok | Facebook</p>
        </div>
        <p class="footer-copyright">
            &copy; {{ date('Y') }} Joya Atelier. Events, decor, florals, gifting, and styling across Kenya.
        </p>
    </footer>
</body>
</html>
