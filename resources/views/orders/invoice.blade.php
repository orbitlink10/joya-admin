<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice {{ $order->invoice_number }} | Joya Atelier</title>
    <style>
        body { margin: 0; background: #f6f1eb; color: #1d1714; font-family: Arial, sans-serif; }
        .page { width: min(900px, calc(100% - 32px)); margin: 32px auto; padding: 40px; background: #fff; border-radius: 12px; }
        header { display: flex; justify-content: space-between; gap: 24px; border-bottom: 1px solid #eadfd5; padding-bottom: 24px; }
        h1, h2, h3 { margin: 0; }
        h1 { font-size: 40px; }
        .muted { color: #776b62; }
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin: 28px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 24px; }
        th, td { padding: 14px; border-bottom: 1px solid #eadfd5; text-align: left; }
        th:last-child, td:last-child { text-align: right; }
        .totals { margin-left: auto; width: min(360px, 100%); margin-top: 24px; }
        .totals div { display: flex; justify-content: space-between; padding: 8px 0; }
        .grand { font-size: 22px; font-weight: 700; border-top: 2px solid #1d1714; }
        .badge { display: inline-block; padding: 6px 10px; border-radius: 999px; background: #f2e6d8; font-weight: 700; }
        .print { margin-top: 24px; }
        @media print { body { background: #fff; } .page { margin: 0; width: auto; box-shadow: none; } .print { display: none; } }
    </style>
</head>
<body>
    <main class="page">
        <header>
            <div>
                <h1>Invoice</h1>
                <p class="muted">{{ $order->invoice_number }}</p>
            </div>
            <div>
                <h2>Joya Atelier</h2>
                <p class="muted">Events, decor, florals, gifting, and styling across Kenya.</p>
                <p>+254 746 761 556<br>joygachanja10@gmail.com<br>Nairobi, Kenya</p>
            </div>
        </header>

        <section class="grid">
            <div>
                <h3>Bill To</h3>
                <p>{{ $order->customer_name }}<br>{{ $order->customer_phone }}<br>{{ $order->customer_email }}</p>
            </div>
            <div>
                <h3>Invoice Details</h3>
                <p>Date: {{ $order->created_at->format('d M Y') }}<br>Delivery: {{ optional($order->delivery_date)->format('d M Y') ?: 'Not set' }}<br>Status: <span class="badge">{{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}</span></p>
            </div>
        </section>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>KSh {{ number_format($item->unit_price, 2) }}</td>
                        <td>KSh {{ number_format($item->line_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <section class="totals">
            <div><span>Subtotal</span><strong>KSh {{ number_format($order->subtotal, 2) }}</strong></div>
            <div><span>Delivery</span><strong>KSh {{ number_format($order->delivery_fee, 2) }}</strong></div>
            <div class="grand"><span>Total</span><strong>KSh {{ number_format($order->total, 2) }}</strong></div>
            <div><span>Amount Paid</span><strong>KSh {{ number_format($order->amount_paid, 2) }}</strong></div>
            <div><span>Balance Due</span><strong>KSh {{ number_format($order->balance_due, 2) }}</strong></div>
        </section>

        @if ($order->payment_instructions)
            <section>
                <h3>Payment Instructions</h3>
                <p>{{ $order->payment_instructions }}</p>
            </section>
        @endif

        <button class="print" onclick="window.print()">Print / Save PDF</button>
    </main>
</body>
</html>
