<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Explore event decor and styling services by Joya Atelier for weddings, birthdays, baby showers, bridal showers, graduations, corporate events, galas, anniversaries, and intimate gatherings.">
    <title>Events | Joya Atelier</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="shop-header">
        <a class="brand shop-brand" href="{{ route('home') }}" aria-label="Joya Atelier home">
            <img class="brand-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
        </a>
        <nav class="shop-nav" aria-label="Events page navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('flowers') }}">Flowers</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="#event-types">Event Types</a>
            <a href="{{ route('booking') }}">Booking</a>
        </nav>
        <a class="header-cta" href="{{ route('booking') }}">Book Your Event</a>
    </header>

    <main>
        <section class="events-hero">
            <img src="{{ asset('images/events/joya-event-setup-pink-gold.png') }}" alt="Pink and gold event setup with balloons, florals, candles, and table styling">
            <div>
                <p class="eyebrow">Joya Atelier Events</p>
                <h1>Celebrations styled beautifully from concept to setup.</h1>
                <p>
                    We create thoughtful event decor, floral design, balloon styling, tablescapes,
                    backdrops, and complete setups for life's most meaningful celebrations.
                </p>
                <a class="primary-btn" href="{{ route('booking') }}">Start Planning</a>
            </div>
        </section>

        @if ($services->isNotEmpty())
            <section id="services" class="events-section">
                <div class="section-heading">
                    <p class="eyebrow dark">Services</p>
                    <h2>Services managed from your admin dashboard.</h2>
                </div>
                <div class="events-grid">
                    @foreach ($services as $service)
                        <article data-gallery-group="{{ Str::slug($service->title) }}">
                            @if ($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                            @else
                                <img src="{{ asset('images/events/joya-event-setup-pink-gold.png') }}" alt="{{ $service->title }}">
                            @endif
                            <div>
                                <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $service->title }}</h3>
                                <p>{{ $service->description }}</p>
                                <a href="{{ route('booking') }}">Enquire About This</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <section id="event-types" class="events-section">
            <div class="section-heading">
                <p class="eyebrow dark">Event Types</p>
                <h2>Tell us what you are celebrating.</h2>
            </div>
            <div class="events-grid">
                <article data-gallery-group="weddings">
                    <img src="{{ asset('images/events/floral-wedding-aisle.jpg') }}" alt="Floral wedding aisle decor inspiration">
                    <div>
                        <span>01</span>
                        <h3>Weddings</h3>
                        <p>Ceremony styling, reception tables, sweetheart setups, aisle decor, florals, and elegant backdrops.</p>
                        <a href="{{ route('booking') }}">Book Wedding Decor</a>
                    </div>
                </article>
                <article data-gallery-group="birthdays">
                    <img src="{{ asset('images/events/black-bows-birthday.jpg') }}" alt="Black and silver birthday balloon setup inspiration">
                    <div>
                        <span>02</span>
                        <h3>Birthdays</h3>
                        <p>Balloon garlands, cake table styling, themed backdrops, kids' parties, and milestone birthday setups.</p>
                        <a href="{{ route('booking') }}">Plan a Birthday</a>
                    </div>
                </article>
                <article data-gallery-group="bridal-showers">
                    <img src="{{ asset('images/events/bride-to-be-pink.jpg') }}" alt="Pink bride to be bridal shower balloon backdrop">
                    <div>
                        <span>03</span>
                        <h3>Bridal Showers</h3>
                        <p>Soft feminine styling, floral corners, balloon features, table decor, and photo-ready details.</p>
                        <a href="{{ route('booking') }}">Style a Bridal Shower</a>
                    </div>
                </article>
                <article data-gallery-group="baby-showers">
                    <img src="{{ asset('images/events/baby-shower-pink-gold.jpg') }}" alt="Pink white and gold baby shower decor inspiration">
                    <div>
                        <span>04</span>
                        <h3>Baby Showers</h3>
                        <p>Sweet themed setups, gender reveals, balloon decor, dessert tables, floral details, and cozy styling.</p>
                        <a href="{{ route('booking') }}">Plan a Baby Shower</a>
                    </div>
                </article>
                <article data-gallery-group="graduations">
                    <img src="{{ asset('images/events/bedroom-birthday-balloons.jpg') }}" alt="Bedroom balloon surprise inspiration">
                    <div>
                        <span>05</span>
                        <h3>Graduations</h3>
                        <p>Achievement backdrops, balloon installations, table styling, floral gifts, and photo moments.</p>
                        <a href="{{ route('booking') }}">Style a Graduation</a>
                    </div>
                </article>
                <article data-gallery-group="corporate-events">
                    <img src="{{ asset('images/events/wedding-candle-tablescape.jpeg') }}" alt="Elegant candlelit tablescape inspiration">
                    <div>
                        <span>06</span>
                        <h3>Corporate Events</h3>
                        <p>Launches, dinners, office celebrations, branded decor, centerpieces, and professional event styling.</p>
                        <a href="{{ route('booking') }}">Book Corporate Styling</a>
                    </div>
                </article>
                <article data-gallery-group="galas-dinners">
                    <img src="{{ asset('images/events/wedding-lights-tablescape.jpg') }}" alt="Warm wedding lights and tablescape inspiration">
                    <div>
                        <span>07</span>
                        <h3>Galas & Dinners</h3>
                        <p>Elegant tablescapes, florals, stage styling, statement decor, and sophisticated ambience.</p>
                        <a href="{{ route('booking') }}">Plan a Gala</a>
                    </div>
                </article>
                <article data-gallery-group="anniversaries">
                    <img src="{{ asset('images/events/romantic-love-setup.jpg') }}" alt="Romantic love and candle setup inspiration">
                    <div>
                        <span>08</span>
                        <h3>Anniversaries & Intimate Gatherings</h3>
                        <p>Romantic dinners, proposals, family gatherings, private parties, and meaningful small celebrations.</p>
                        <a href="{{ route('booking') }}">Create a Moment</a>
                    </div>
                </article>
            </div>
        </section>

        <section class="events-section inspiration-section">
            <div class="section-heading">
                <p class="eyebrow dark">Inspiration Gallery</p>
                <h2>Ideas we can style around your moment.</h2>
            </div>
            <div class="event-inspo-grid">
                <figure class="wide" data-gallery-group="weddings">
                    <img src="{{ asset('images/events/wedding-lights-tablescape.jpg') }}" alt="Wedding table with flowers, candles, and string lights">
                    <figcaption>Warm wedding dinner styling</figcaption>
                </figure>
                <figure data-gallery-group="anniversaries">
                    <img src="{{ asset('images/events/romantic-love-setup.jpg') }}" alt="Romantic surprise setup with candles and rose petals">
                    <figcaption>Romantic surprise setup</figcaption>
                </figure>
                <figure data-gallery-group="birthdays">
                    <img src="{{ asset('images/events/black-bows-birthday.jpg') }}" alt="Black and silver birthday balloon wall">
                    <figcaption>Black bow birthday decor</figcaption>
                </figure>
                <figure data-gallery-group="bridal-showers">
                    <img src="{{ asset('images/events/bride-to-be-pink.jpg') }}" alt="Pink bride to be bridal shower backdrop">
                    <figcaption>Bridal shower backdrop</figcaption>
                </figure>
                <figure class="tall" data-gallery-group="birthdays">
                    <img src="{{ asset('images/events/bedroom-birthday-balloons.jpg') }}" alt="Bedroom birthday balloon surprise">
                    <figcaption>Bedroom birthday surprise</figcaption>
                </figure>
                <figure data-gallery-group="baby-showers">
                    <img src="{{ asset('images/events/baby-shower-pink-gold.jpg') }}" alt="Pink and gold baby shower decor">
                    <figcaption>Baby shower styling</figcaption>
                </figure>
                <figure data-gallery-group="bridal-showers">
                    <img src="{{ asset('images/events/bridal-shower-neutral.webp') }}" alt="Neutral bridal shower Miss to Mrs backdrop">
                    <figcaption>Neutral Miss to Mrs setup</figcaption>
                </figure>
                <figure data-gallery-group="weddings">
                    <img src="{{ asset('images/events/floral-wedding-aisle.jpg') }}" alt="Floral wedding aisle with pink flowers">
                    <figcaption>Floral wedding aisle</figcaption>
                </figure>
                <figure data-gallery-group="weddings">
                    <img src="{{ asset('images/events/wedding-candle-tablescape.jpeg') }}" alt="Candlelit luxury wedding tablescape">
                    <figcaption>Candlelit tablescape</figcaption>
                </figure>
                <figure data-gallery-group="anniversaries">
                    <img src="{{ asset('images/events/valentine-surprise.avif') }}" alt="Valentine surprise decor inspiration">
                    <figcaption>Valentine surprise</figcaption>
                </figure>
                <figure data-gallery-group="anniversaries">
                    <img src="{{ asset('images/events/surprise-setup.avif') }}" alt="Surprise event decor inspiration">
                    <figcaption>Custom surprise setup</figcaption>
                </figure>
            </div>
        </section>

        @if ($eventGalleryImages->isNotEmpty())
            <section class="events-section inspiration-section">
                <div class="section-heading">
                    <p class="eyebrow dark">Real Event Gallery</p>
                    <h2>Past setups added from the admin dashboard.</h2>
                </div>
                <div class="event-inspo-grid">
                    @foreach ($eventGalleryImages as $eventType => $images)
                        @foreach ($images as $galleryImage)
                            <figure data-gallery-group="{{ $eventType }}" @class(['wide' => $loop->parent->first && $loop->first])>
                                <img src="{{ asset('storage/' . $galleryImage->image) }}" alt="{{ $galleryImage->title }}">
                                <figcaption>{{ $galleryImage->caption ?: $galleryImage->title }}</figcaption>
                            </figure>
                        @endforeach
                    @endforeach
                </div>
            </section>
        @endif

        <section class="events-section event-includes">
            <div class="section-heading">
                <p class="eyebrow dark">What Can Be Included</p>
                <h2>Everything styled into one beautiful vision.</h2>
            </div>
            <div class="why-grid">
                <article>
                    <h3>Backdrops</h3>
                    <p>Panel backdrops, shimmer walls, flower walls, name signage, and custom focal points.</p>
                </article>
                <article>
                    <h3>Balloons</h3>
                    <p>Organic garlands, arches, columns, balloon walls, kids' themes, and luxury balloon accents.</p>
                </article>
                <article>
                    <h3>Florals</h3>
                    <p>Fresh arrangements, faux florals, bouquet styling, centerpieces, and floral installations.</p>
                </article>
                <article>
                    <h3>Tables & Seating</h3>
                    <p>Tablescapes, linens, centerpieces, chair decor, guest tables, and sweetheart tables.</p>
                </article>
            </div>
        </section>

        <section id="event-booking" class="contact-section">
            <div class="contact-copy">
                <p class="eyebrow">Book an Event</p>
                <h2>Ready to style your celebration?</h2>
                <p>
                    Send us your event type, date, location, guest count, colors, and inspiration.
                    We will help you choose the best styling direction and prepare a quotation.
                </p>
                <a class="whatsapp-panel-link" href="https://wa.me/254746761556?text=Hello%20Joya%20Atelier%2C%20I%20would%20like%20to%20book%20event%20decor.">Chat on WhatsApp</a>
            </div>
            <form class="contact-form" action="{{ route('booking.request') }}" method="post" enctype="multipart/form-data" data-whatsapp-form data-whatsapp-context="Joya Atelier event booking request">
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
                    <span>Event Type</span>
                    <select name="event_type">
                        <option>Wedding</option>
                        <option>Birthday</option>
                        <option>Bridal shower</option>
                        <option>Baby shower</option>
                        <option>Graduation</option>
                        <option>Corporate event</option>
                        <option>Gala or dinner</option>
                        <option>Anniversary or private gathering</option>
                    </select>
                </label>
                <div class="form-row">
                    <label>
                        <span>Event Date</span>
                        <input type="date" name="event_date">
                    </label>
                    <label>
                        <span>Guest Count</span>
                        <input type="number" name="guests" placeholder="80">
                    </label>
                </div>
                <label>
                    <span>Venue / Location</span>
                    <input type="text" name="location" placeholder="Venue name or area">
                </label>
                <label>
                    <span>Theme / Colors</span>
                    <input type="text" name="theme" placeholder="Ivory, blush, gold">
                </label>
                <fieldset>
                    <legend>Services Needed</legend>
                    <div class="checkbox-grid">
                        <label><input type="checkbox" name="services[]" value="Backdrop"> Backdrop</label>
                        <label><input type="checkbox" name="services[]" value="Balloons"> Balloons</label>
                        <label><input type="checkbox" name="services[]" value="Florals"> Florals</label>
                        <label><input type="checkbox" name="services[]" value="Tables"> Tables</label>
                        <label><input type="checkbox" name="services[]" value="Seating"> Seating</label>
                        <label><input type="checkbox" name="services[]" value="Full setup"> Full setup</label>
                    </div>
                </fieldset>
                <label>
                    <span>Inspiration Photo</span>
                    <input type="file" name="inspiration_photo" accept="image/*">
                </label>
                <label>
                    <span>Details</span>
                    <textarea name="details" rows="4" placeholder="Tell us what you imagine for the event"></textarea>
                </label>
                <button type="submit">Send Event Request</button>
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
            <p><a href="{{ route('home') }}">Home</a> | <a href="{{ route('about') }}">About</a> | <a href="{{ route('events') }}">Events</a> | <a href="{{ route('flowers') }}">Flowers</a> | <a href="{{ route('shop') }}">Shop</a></p>
            <p>Instagram | TikTok | Facebook</p>
        </div>
    </footer>
</body>
</html>
