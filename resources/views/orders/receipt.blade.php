<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt {{ $order->receipt_number }} | Joya Atelier</title>
    <style>
        body { margin: 0; background: #f6f1eb; color: #1d1714; font-family: Arial, sans-serif; }
        .page { width: min(820px, calc(100% - 32px)); margin: 32px auto; padding: 40px; background: #fff; border-radius: 12px; }
        header { display: flex; justify-content: space-between; gap: 24px; border-bottom: 1px solid #eadfd5; padding-bottom: 24px; }
        h1, h2, h3 { margin: 0; }
        h1 { font-size: 40px; }
        .muted { color: #776b62; }
        .paid { margin: 28px 0; padding: 24px; background: #f1eadf; border-radius: 10px; }
        .row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eadfd5; }
        .big { font-size: 24px; font-weight: 700; }
        .badge { display: inline-block; padding: 6px 10px; border-radius: 999px; background: #e7f6e9; font-weight: 700; }
        .print { margin-top: 24px; }
        @media print { body { background: #fff; } .page { margin: 0; width: auto; } .print { display: none; } }
    </style>
</head>
<body>
    <main class="page">
        <header>
            <div>
                <h1>Receipt</h1>
                <p class="muted">{{ $order->receipt_number }}</p>
            </div>
            <div>
                <h2>Joya Atelier</h2>
                <p>+254 746 761 556<br>joygachanja10@gmail.com<br>Nairobi, Kenya</p>
            </div>
        </header>

        <section class="paid">
            <p class="badge">{{ $order->payment_status === 'paid' ? 'Paid in full' : 'Deposit / partial payment' }}</p>
            <h2>KSh {{ number_format($order->amount_paid, 2) }} received</h2>
            <p class="muted">From {{ $order->customer_name }} for order {{ $order->order_number }}.</p>
        </section>

        <section>
            <div class="row"><span>Payment date</span><strong>{{ optional($order->payment_date)->format('d M Y') ?: now()->format('d M Y') }}</strong></div>
            <div class="row"><span>Payment method</span><strong>{{ $order->payment_method ? ucfirst($order->payment_method) : 'Not specified' }}</strong></div>
            <div class="row"><span>Order total</span><strong>KSh {{ number_format($order->total, 2) }}</strong></div>
            <div class="row"><span>Amount paid</span><strong>KSh {{ number_format($order->amount_paid, 2) }}</strong></div>
            <div class="row big"><span>Balance due</span><strong>KSh {{ number_format($order->balance_due, 2) }}</strong></div>
        </section>

        <p class="muted">Thank you for choosing Joya Atelier.</p>
        <button class="print" onclick="window.print()">Print / Save PDF</button>
    </main>
</body>
</html>
