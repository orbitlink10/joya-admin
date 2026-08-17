<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="About Joya Atelier, an event planning, decor, styling, and floral studio creating beautiful moments through flowers, spaces, and thoughtful details.">
    <title>About Joya Atelier | Events, Decor & Florals</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="shop-header">
        <a class="brand shop-brand" href="{{ route('home') }}" aria-label="Joya Atelier home">
            <img class="brand-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
        </a>
        <nav class="shop-nav" aria-label="About page navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('events') }}">Events</a>
            <a href="{{ route('flowers') }}">Flowers</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="#story">Our Story</a>
            <a href="#services">What We Do</a>
            <a href="#process">How We Work</a>
        </nav>
        <a class="header-cta" href="{{ route('booking') }}">Book Your Event</a>
    </header>

    <main>
        <section class="about-hero">
            <div>
                <p class="eyebrow dark">About Joya Atelier</p>
                <h1>Where Beautiful Moments Come to Life</h1>
            </div>
            <p>
                Joya Atelier began with something simple: a love for flowers, beautiful spaces,
                and the art of creating moments that feel special.
            </p>
        </section>

        <section class="about-photo-hero" aria-label="Joya Atelier styled event setup">
            <img src="{{ asset('images/joya-atelier-hero-clean.png') }}" alt="Luxury Joya Atelier event setup with balloons, florals, and table styling">
        </section>

        <section id="story" class="about-story">
            <div class="about-story-main">
                <h2>Our Story</h2>
                <p>
                    What started as a small creative passion project grew from a desire to transform
                    that love for beauty and creativity into something meaningful: helping people
                    celebrate life's most important moments in a way that feels personal, elegant,
                    and unforgettable.
                </p>
                <p>
                    We believe that a celebration is more than just an event. It is the laughter
                    shared with loved ones, the excitement of seeing everything come together,
                    the flowers chosen with thought, the beautiful details captured in photographs,
                    and the memories that remain long after the celebration is over.
                </p>
                <p><strong>That is the feeling we want to create at Joya Atelier.</strong></p>
                <p>
                    Whether it is a birthday, wedding, graduation, bridal shower, baby shower,
                    anniversary, or an intimate gathering, your celebration should reflect you.
                </p>
            </div>
            <aside class="about-quote">
                <img src="{{ asset('images/flowers/pink-fuzzy-roses.jpg') }}" alt="Pink handcrafted fuzzy-wire bouquet with pearl details">
                <p>
                    Your vision, your moment, beautifully styled.
                </p>
            </aside>
        </section>

        <section class="about-mood-gallery" aria-label="Joya Atelier visual story">
            <figure>
                <img src="{{ asset('images/flowers/basket-fuzzy-flowers.jpeg') }}" alt="Handcrafted flower basket with roses and lilies">
                <figcaption>Handcrafted floral keepsakes</figcaption>
            </figure>
            <figure>
                <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&w=900&q=85" alt="Elegant outdoor wedding reception decor">
                <figcaption>Celebrations styled with care</figcaption>
            </figure>
            <figure>
                <img src="{{ asset('images/ribbon/red-pink-ribbon-roses.webp') }}" alt="Red and pink ribbon rose bouquet">
                <figcaption>Ribbon flowers for lasting gifts</figcaption>
            </figure>
        </section>

        <section id="services" class="about-section-block">
            <div class="section-heading">
                <p class="eyebrow dark">What We Do</p>
                <h2>Event planning, styling, decor, and floral design.</h2>
            </div>
            <div class="about-card-grid">
                <article>
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=700&q=85" alt="Elegant event table styling with flowers">
                    <span>01</span>
                    <h3>Event Planning & Styling</h3>
                    <p>We bring your celebration together from the initial concept to the final setup.</p>
                </article>
                <article>
                    <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?auto=format&fit=crop&w=700&q=85" alt="Birthday balloon decor">
                    <span>02</span>
                    <h3>Balloon & Backdrop Decor</h3>
                    <p>Elegant balloon installations, organic garlands, statement backdrops, and personalized designs.</p>
                </article>
                <article>
                    <img src="{{ asset('images/flowers/pink-blue-fuzzy-bouquet.jpg') }}" alt="Pink and blue handcrafted fuzzy-wire flowers">
                    <span>03</span>
                    <h3>Floral Design</h3>
                    <p>Fresh arrangements, bouquets, flower boxes, centerpieces, wedding flowers, and floral gifts.</p>
                </article>
                <article>
                    <img src="{{ asset('images/events/pretty-table-styling.jpg') }}" alt="Styled event tables with seating, centerpieces, linens, and place settings">
                    <span>04</span>
                    <h3>Table & Venue Styling</h3>
                    <p>Styled tables, seating arrangements, centerpieces, linens, and decorative finishing touches.</p>
                </article>
                <article>
                    <img src="{{ asset('images/joya-atelier-hero-clean.png') }}" alt="Complete event setup with florals and balloons">
                    <span>05</span>
                    <h3>Complete Event Decor</h3>
                    <p>Decor, florals, styling, and setup brought together into one complete vision.</p>
                </article>
            </div>
        </section>

        <section id="process" class="about-section-block process-about">
            <div class="section-heading">
                <p class="eyebrow dark">How We Work</p>
                <h2>From your first idea to the final reveal.</h2>
            </div>
            <ol class="about-process-list">
                <li>
                    <span>01</span>
                    <h3>We Listen</h3>
                    <p>We understand your occasion, preferences, colors, theme, venue, and the feeling you want guests to experience.</p>
                </li>
                <li>
                    <span>02</span>
                    <h3>We Create</h3>
                    <p>We turn your ideas into a thoughtful styling concept with flowers, textures, colors, decor, and details.</p>
                </li>
                <li>
                    <span>03</span>
                    <h3>We Style</h3>
                    <p>We prepare the decor, arrange flowers, style tables, set up backdrops, and add finishing touches.</p>
                </li>
                <li>
                    <span>04</span>
                    <h3>You Celebrate</h3>
                    <p>You step back, relax, and enjoy your moment without worrying about the details.</p>
                </li>
            </ol>
        </section>

        <section class="about-editorial">
            <div>
                <p class="eyebrow dark">More Than Decor</p>
                <h2>It is about creating an atmosphere.</h2>
            </div>
            <div>
                <img src="{{ asset('images/events/joya-hero-better-together.png') }}" alt="Elegant event atmosphere with styled tables, flowers, candles, balloons, and a glowing backdrop" class="about-inline-image">
                <p>
                    Event styling is not simply about balloons, flowers, or beautiful backdrops.
                    It is the feeling of walking into a space and seeing your vision come to life.
                </p>
                <p>
                    It is the excitement of receiving a bouquet that feels like it was made just for you.
                    It is the little details that make your guests stop and say, "Wow."
                </p>
                <p>
                    Most importantly, it is about creating a setting where beautiful memories can be made.
                </p>
            </div>
        </section>

        <section class="about-section-block">
            <div class="section-heading">
                <p class="eyebrow dark">Our Philosophy</p>
                <h2>Beauty is found in the details.</h2>
            </div>
            <div class="philosophy-list">
                <article>
                    <img src="{{ asset('images/flowers/pink-fuzzy-roses.jpg') }}" alt="Carefully chosen pink flower arrangement">
                    <p>A carefully chosen flower.</p>
                </article>
                <article>
                    <img src="{{ asset('images/events/pretty-table-styling.jpg') }}" alt="Beautifully styled event table with white and gold place settings">
                    <p>A beautifully styled table.</p>
                </article>
                <article>
                    <img src="{{ asset('images/events/baby-shower-pink-gold.jpg') }}" alt="Pink and gold event decor color palette">
                    <p>The perfect combination of colors.</p>
                </article>
                <article>
                    <img src="{{ asset('images/events/black-pink-backdrop.jpg') }}" alt="Decorated event backdrop for photographs">
                    <p>A backdrop that becomes the centre of every photograph.</p>
                </article>
                <article>
                    <img src="{{ asset('images/events/valentine-surprise.avif') }}" alt="Personal celebration setup with thoughtful details">
                    <p>A small personal touch that makes the celebration uniquely yours.</p>
                </article>
            </div>
            <p class="about-closing">
                We approach every celebration with creativity, care, attention to detail, and a genuine
                passion for making moments beautiful. Our goal is not simply to decorate your event.
                <strong>Our goal is to make you feel something when you walk into it.</strong>
            </p>
        </section>

        <section class="about-vision">
            <p class="eyebrow">Our Vision</p>
            <h2>To become a trusted name in event styling and floral design.</h2>
            <p>
                From intimate moments to grand celebrations, we want to be part of the occasions
                that matter most to you and help turn them into memories worth keeping.
            </p>
            <a class="primary-btn" href="{{ route('booking') }}">Book Your Moment</a>
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
            <p><a href="{{ route('home') }}">Home</a> | <a href="{{ route('about') }}">About</a> | <a href="{{ route('events') }}">Events</a> | <a href="{{ route('flowers') }}">Flowers</a> | <a href="{{ route('shop') }}">Shop</a> | <a href="{{ route('booking') }}">Booking</a></p>
            <p>Instagram | TikTok | Facebook</p>
        </div>
    </footer>
</body>
</html>
