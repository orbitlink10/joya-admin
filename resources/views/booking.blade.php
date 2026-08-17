<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Book Joya Atelier event decor, floral design, balloon styling, backdrops, tablescapes, and complete event setup in advance.">
    <title>Book Your Event | Joya Atelier</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="shop-header">
        <a class="brand shop-brand" href="{{ route('home') }}" aria-label="Joya Atelier home">
            <img class="brand-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
        </a>
        <nav class="shop-nav" aria-label="Booking page navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('events') }}">Events</a>
            <a href="{{ route('flowers') }}">Flowers</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="#booking-form">Booking Form</a>
        </nav>
        <a class="header-cta" href="#booking-form">Book Now</a>
    </header>

    <main>
        <section class="booking-hero">
            <img src="{{ asset('images/events/joya-event-setup-pink-gold.png') }}" alt="Joya Atelier event setup with blush balloons, florals, candles, and table styling">
            <div class="booking-hero-copy">
                <p class="eyebrow">Book Your Event</p>
                <h1>Plan ahead for a beautifully styled celebration.</h1>
                <p>
                    Choose the service you need, share your date and inspiration, and we will help
                    prepare the decor, flowers, balloons, backdrop, tablescape, and setup details in time.
                </p>
                <a class="primary-btn" href="#booking-form">Start Booking</a>
            </div>
        </section>

        <section class="booking-options" aria-label="Joya Atelier booking services">
            <article>
                <span>01</span>
                <h2>Event Decor & Setup</h2>
                <p>Backdrops, balloons, focal points, signage, props, and full celebration styling.</p>
            </article>
            <article>
                <span>02</span>
                <h2>Floral Design</h2>
                <p>Fresh flowers, floral gifts, table arrangements, wedding flowers, and keepsake bouquets.</p>
            </article>
            <article>
                <span>03</span>
                <h2>Complete Styling</h2>
                <p>Decor, florals, tables, seating, and finishing details brought together as one vision.</p>
            </article>
        </section>

        <section id="booking-form" class="booking-page-section">
            <div class="booking-sidebar">
                <p class="eyebrow">Early Arrangements</p>
                <h2>Book early so every detail has time to come together.</h2>
                <p>
                    Early bookings help us confirm your date, source materials, prepare florals,
                    plan your setup, and reserve enough styling time for your celebration.
                </p>
                <div class="booking-steps">
                    <article>
                        <span>1</span>
                        <p>Choose the service and occasion.</p>
                    </article>
                    <article>
                        <span>2</span>
                        <p>Share your date, location, theme, and inspiration.</p>
                    </article>
                    <article>
                        <span>3</span>
                        <p>We confirm details and prepare your custom quotation.</p>
                    </article>
                    <article>
                        <span>4</span>
                        <p>Your setup is prepared and styled beautifully.</p>
                    </article>
                </div>
            </div>

            <form class="contact-form booking-form" action="{{ route('booking.request') }}" method="post" enctype="multipart/form-data" data-whatsapp-form data-whatsapp-context="Joya Atelier booking request">
                @csrf
                <div class="form-row">
                    <label>
                        <span>Full Name</span>
                        <input type="text" name="name" placeholder="Your name" required>
                    </label>
                    <label>
                        <span>Phone / WhatsApp</span>
                        <input type="tel" name="phone" placeholder="+254 746 761 556" required>
                    </label>
                </div>
                <label>
                    <span>Email Address</span>
                    <input type="email" name="email" placeholder="you@example.com">
                </label>
                <div class="form-row">
                    <label>
                        <span>Service Type</span>
                        <select name="service_type" required>
                            <option>Complete event decor and setup</option>
                            <option>Balloon and backdrop decor</option>
                            <option>Floral design only</option>
                            <option>Tablescape and venue styling</option>
                            <option>Surprise room or gift setup</option>
                            <option>Flower delivery or custom bouquet</option>
                        </select>
                    </label>
                    <label>
                        <span>Occasion</span>
                        <select name="occasion" required>
                            <option>Wedding</option>
                            <option>Birthday</option>
                            <option>Baby shower</option>
                            <option>Bridal shower</option>
                            <option>Graduation</option>
                            <option>Corporate event</option>
                            <option>Gala or dinner</option>
                            <option>Anniversary or proposal</option>
                            <option>Flower gift</option>
                            <option>Other celebration</option>
                        </select>
                    </label>
                </div>
                <div class="form-row">
                    <label>
                        <span>Event / Delivery Date</span>
                        <input type="date" name="event_date" required>
                    </label>
                    <label>
                        <span>Preferred Setup Time</span>
                        <input type="time" name="setup_time">
                    </label>
                </div>
                <div class="form-row">
                    <label>
                        <span>Location / Venue</span>
                        <input type="text" name="location" placeholder="Venue, estate, hotel, or delivery area" required>
                    </label>
                    <label>
                        <span>Guest Count</span>
                        <input type="number" name="guest_count" placeholder="80">
                    </label>
                </div>
                <div class="form-row">
                    <label>
                        <span>Preferred Theme / Colors</span>
                        <input type="text" name="theme" placeholder="Blush, ivory, gold, black and silver">
                    </label>
                    <label>
                        <span>Budget</span>
                        <span class="money-input">
                            <span>KSh</span>
                            <input type="number" name="budget_range" min="0" step="1" inputmode="numeric" placeholder="Type your budget">
                        </span>
                    </label>
                </div>
                <fieldset>
                    <legend>Services Needed</legend>
                    <div class="checkbox-grid booking-checkboxes">
                        <label><input type="checkbox" name="services[]" value="Full setup"> Full setup</label>
                        <label><input type="checkbox" name="services[]" value="Backdrop"> Backdrop</label>
                        <label><input type="checkbox" name="services[]" value="Balloons"> Balloons</label>
                        <label><input type="checkbox" name="services[]" value="Fresh flowers"> Fresh flowers</label>
                        <label><input type="checkbox" name="services[]" value="Handmade flowers"> Handmade flowers</label>
                        <label><input type="checkbox" name="services[]" value="Tablescape"> Tablescape</label>
                        <label><input type="checkbox" name="services[]" value="Seating decor"> Seating decor</label>
                        <label><input type="checkbox" name="services[]" value="Delivery"> Delivery</label>
                    </div>
                </fieldset>
                <label>
                    <span>Inspiration Photo</span>
                    <input type="file" name="inspiration_photo" accept="image/*">
                </label>
                <label>
                    <span>Tell Us More</span>
                    <textarea name="details" rows="5" placeholder="Describe the setup, flowers, theme, colors, date flexibility, venue access time, or any special details."></textarea>
                </label>
                <button type="submit">Send Booking Request on WhatsApp</button>
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
