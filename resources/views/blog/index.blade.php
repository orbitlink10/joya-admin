<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Read Joya Atelier articles about flowers, event styling, gifting, weddings, and beautiful celebrations in Kenya.">
    <title>Blog | Joya Atelier</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="shop-header">
        <a class="brand shop-brand" href="{{ route('home') }}" aria-label="Joya Atelier home">
            <img class="brand-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
        </a>
        <nav class="shop-nav" aria-label="Blog navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('events') }}">Events</a>
            <a href="{{ route('flowers') }}">Flowers</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('booking') }}">Booking</a>
        </nav>
    </header>

    <main>
        <section class="shop-section">
            <div class="section-heading">
                <p class="eyebrow dark">Joya Atelier Journal</p>
                <h1>Helpful articles for flowers, gifting, and events.</h1>
            </div>

            <div class="product-grid">
                @forelse ($articles as $article)
                    <article class="product-card">
                        @if ($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}">
                        @endif
                        <div>
                            <span>{{ optional($article->published_at)->format('M d, Y') }}</span>
                            <h3>{{ $article->title }}</h3>
                            <p>{{ $article->excerpt }}</p>
                            <a href="{{ route('blog.show', $article) }}">Read Article</a>
                        </div>
                    </article>
                @empty
                    <p>No articles have been published yet.</p>
                @endforelse
            </div>

            {{ $articles->links() }}
        </section>
    </main>
</body>
</html>
