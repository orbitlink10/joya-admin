<?php

use App\Mail\BookingRequestMail;
use App\Models\AnalyticsEvent;
use App\Models\Article;
use App\Models\EventGalleryImage;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\SpeedTestResult;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredProducts = Product::query()
        ->with('productCategory')
        ->where('is_published', true)
        ->where('is_featured', true)
        ->latest()
        ->limit(4)
        ->get();

    if ($featuredProducts->isEmpty()) {
        $featuredProducts = Product::query()
            ->with('productCategory')
            ->where('is_published', true)
            ->latest()
            ->limit(4)
            ->get();
    }

    $services = Service::query()
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->latest()
        ->limit(4)
        ->get();

    $testimonials = Testimonial::query()
        ->where('is_published', true)
        ->latest()
        ->limit(3)
        ->get();

    $articles = Article::query()
        ->where('is_published', true)
        ->latest('published_at')
        ->latest()
        ->limit(3)
        ->get();

    return view('welcome', compact('featuredProducts', 'services', 'testimonials', 'articles'));
})->name('home');

Route::get('/flowers', function () {
    $products = Product::query()
        ->with('productCategory')
        ->where('is_published', true)
        ->latest()
        ->get();

    return view('flowers', compact('products'));
})->name('flowers');

Route::get('/shop', function () {
    $products = Product::query()
        ->with('productCategory')
        ->where('is_published', true)
        ->latest()
        ->get();

    return view('shop', compact('products'));
})->name('shop');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/events', function () {
    $services = Service::query()
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->latest()
        ->get();

    $eventGalleryImages = EventGalleryImage::query()
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->latest()
        ->get()
        ->groupBy('event_type');

    return view('events', compact('services', 'eventGalleryImages'));
})->name('events');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');

Route::get('/blog', function () {
    $articles = Article::query()
        ->where('is_published', true)
        ->latest('published_at')
        ->latest()
        ->paginate(9);

    return view('blog.index', compact('articles'));
})->name('blog.index');

Route::get('/blog/{article:slug}', function (Article $article) {
    abort_unless($article->is_published, 404);

    return view('blog.show', compact('article'));
})->name('blog.show');

Route::get('/admin/articles/{article}/review', function (Article $article) {
    abort_unless(auth()->check(), 403);

    return view('blog.show', [
        'article' => $article,
        'isPreview' => true,
    ]);
})->name('admin.articles.review');

Route::get('/admin/orders/{order}/invoice', function (Order $order) {
    abort_unless(auth()->check(), 403);

    $order->load('items');

    return view('orders.invoice', compact('order'));
})->name('admin.orders.invoice');

Route::get('/admin/orders/{order}/receipt', function (Order $order) {
    abort_unless(auth()->check(), 403);

    $order->load('items');

    return view('orders.receipt', compact('order'));
})->name('admin.orders.receipt');

Route::post('/booking-request', function (Request $request) {
    $validated = $request->validate([
        'name' => ['nullable', 'string', 'max:120'],
        'phone' => ['nullable', 'string', 'max:80'],
        'email' => ['nullable', 'email', 'max:160'],
        'inspiration_photo' => ['nullable', 'file', 'image', 'max:5120'],
    ]);

    $fields = collect($request->except(['_token', 'inspiration_photo']))
        ->map(fn ($value) => is_array($value) ? implode(', ', array_filter($value)) : $value)
        ->filter(fn ($value) => filled($value))
        ->all();

    try {
        Mail::to(config('mail.booking_to'))->send(
            new BookingRequestMail(
                $fields,
                $request->file('inspiration_photo'),
                $validated['email'] ?? null
            )
        );
    } catch (Throwable $exception) {
        Log::error('Booking request email failed.', [
            'message' => $exception->getMessage(),
        ]);

        return response()->json([
            'message' => 'We could not send the email copy right now.',
        ], 500);
    }

    return response()->json([
        'message' => 'Booking request emailed successfully.',
    ]);
})->name('booking.request');

Route::post('/analytics/track', function (Request $request) {
    $validated = $request->validate([
        'event_type' => ['required', 'string', 'max:80'],
        'visitor_id' => ['nullable', 'string', 'max:120'],
        'session_id' => ['nullable', 'string', 'max:120'],
        'page_url' => ['nullable', 'string', 'max:255'],
        'page_path' => ['nullable', 'string', 'max:255'],
        'page_title' => ['nullable', 'string', 'max:255'],
        'label' => ['nullable', 'string', 'max:255'],
        'referrer' => ['nullable', 'string', 'max:255'],
        'utm_source' => ['nullable', 'string', 'max:120'],
        'utm_medium' => ['nullable', 'string', 'max:120'],
        'utm_campaign' => ['nullable', 'string', 'max:120'],
        'metadata' => ['nullable', 'array'],
    ]);

    AnalyticsEvent::create([
        ...$validated,
        'ip_hash' => hash('sha256', (string) $request->ip()),
        'user_agent' => substr((string) $request->userAgent(), 0, 1000),
    ]);

    return response()->json(['tracked' => true]);
})->name('analytics.track');

Route::get('/admin/speed-test/ping', function () {
    abort_unless(auth()->check(), 403);

    return response()->json([
        'ok' => true,
        'server_time' => now()->toISOString(),
    ]);
})->name('admin.speed-test.ping');

Route::get('/admin/speed-test/download', function (Request $request) {
    abort_unless(auth()->check(), 403);

    $size = min(max((int) $request->query('size', 1048576), 65536), 8388608);
    $chunk = str_repeat('JoyaAtelierSpeedTest', 1024);
    $body = substr(str_repeat($chunk, (int) ceil($size / strlen($chunk))), 0, $size);

    return response($body, 200, [
        'Content-Type' => 'application/octet-stream',
        'Content-Length' => (string) strlen($body),
        'Cache-Control' => 'no-store, no-cache, must-revalidate',
    ]);
})->name('admin.speed-test.download');

Route::post('/admin/speed-test/upload', function (Request $request) {
    abort_unless(auth()->check(), 403);

    return response()->json([
        'received_bytes' => strlen($request->getContent()),
    ]);
})->name('admin.speed-test.upload');

Route::post('/admin/speed-test/results', function (Request $request) {
    abort_unless(auth()->check(), 403);

    $validated = $request->validate([
        'ping_ms' => ['nullable', 'numeric', 'min:0', 'max:999999'],
        'download_mbps' => ['nullable', 'numeric', 'min:0', 'max:999999'],
        'upload_mbps' => ['nullable', 'numeric', 'min:0', 'max:999999'],
        'test_mode' => ['required', 'string', 'in:quick,standard,detailed'],
    ]);

    SpeedTestResult::create([
        ...$validated,
        'server_name' => $request->getHost(),
        'ip_hash' => hash('sha256', (string) $request->ip()),
        'user_agent' => substr((string) $request->userAgent(), 0, 1000),
    ]);

    return response()->json(['saved' => true]);
})->name('admin.speed-test.results');
