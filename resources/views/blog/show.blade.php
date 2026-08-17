<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $article->seo_description ?: $article->excerpt }}">
    @if ($article->seo_keywords)
        <meta name="keywords" content="{{ $article->seo_keywords }}">
    @endif
    @if ($article->canonical_url)
        <link rel="canonical" href="{{ $article->canonical_url }}">
    @endif
    <title>{{ $article->seo_title ?: $article->title }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="shop-header">
        <a class="brand shop-brand" href="{{ route('home') }}" aria-label="Joya Atelier home">
            <img class="brand-logo" src="{{ $siteLogoUrl }}" alt="Joya Atelier logo">
        </a>
        <nav class="shop-nav" aria-label="Article navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('events') }}">Events</a>
            <a href="{{ route('flowers') }}">Flowers</a>
            <a href="{{ route('shop') }}">Shop</a>
            <a href="{{ route('booking') }}">Booking</a>
        </nav>
    </header>

    <main>
        <article class="shop-section">
            @if (! empty($isPreview))
                <p class="eyebrow dark">Review Mode - visitors cannot see this draft until it is published.</p>
            @endif

            <div class="section-heading">
                <p class="eyebrow dark">Joya Atelier Journal</p>
                <h1>{{ $article->title }}</h1>
                @if ($article->excerpt)
                    <p class="section-intro">{{ $article->excerpt }}</p>
                @endif
            </div>

            @if ($article->featured_image)
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" style="width: 100%; max-height: 520px; object-fit: cover; border-radius: 24px; margin-bottom: 32px;">
            @endif

            <div class="section-intro">
                {!! $article->body !!}
            </div>
        </article>
    </main>
</body>
</html>
