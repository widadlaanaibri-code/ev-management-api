<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVM Ticket - {{ $event->title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #03001d;
            color: #fff;
            padding: 24px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .ticket {
            width: 100%;
            max-width: 560px;
            background: linear-gradient(180deg, rgba(121, 114, 254, 0.12) 0%, rgba(3, 0, 29, 0.98) 30%);
            border: 2px solid rgba(121, 114, 254, 0.4);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(121, 114, 254, 0.15);
        }
        .ticket-header {
            background: linear-gradient(135deg, #7972FE 0%, #a855f7 100%);
            padding: 20px 24px;
            text-align: center;
        }
        .ticket-brand {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.15em;
            color: #fff;
            margin-bottom: 4px;
        }
        .ticket-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: rgba(255,255,255,0.9);
        }
        .ticket-body {
            padding: 28px 24px;
        }
        .event-title {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 20px;
            line-height: 1.3;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(121, 114, 254, 0.3);
        }
        .ticket-row {
            margin-bottom: 14px;
            clear: both;
        }
        .ticket-row:last-child { margin-bottom: 0; }
        .ticket-key {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255,255,255,0.6);
            display: block;
            margin-bottom: 2px;
        }
        .ticket-val {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            display: block;
        }
        .ticket-footer {
            padding: 16px 24px;
            background: rgba(121, 114, 254, 0.08);
            border-top: 1px solid rgba(121, 114, 254, 0.2);
            overflow: hidden;
        }
        .ticket-footer-left {
            float: left;
        }
        .ticket-footer-right {
            float: right;
        }
        .price-tag {
            font-size: 18px;
            font-weight: 700;
            color: #a5b4fc;
        }
        .qty-tag {
            font-size: 12px;
            color: rgba(255,255,255,0.7);
        }
        .qty-tag strong { color: #7972FE; font-size: 16px; }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="ticket-header">
            <div class="ticket-brand">EVM</div>
            <div class="ticket-label">Event Ticket</div>
        </div>
        <div class="ticket-body">
            <h1 class="event-title">{{ $event->title }}</h1>
            <div class="ticket-row">
                <span class="ticket-key">Guest name</span>
                <span class="ticket-val">{{ $user->name }}</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-key">Date & time</span>
                <span class="ticket-val">{{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y \a\t g:i A') }}</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-key">Location</span>
                <span class="ticket-val">{{ $event->location ?? 'To be announced' }}</span>
            </div>
            <div class="ticket-row">
                <span class="ticket-key">Quantity</span>
                <span class="ticket-val">{{ $quantity ?? 1 }} {{ ($quantity ?? 1) === 1 ? 'seat' : 'seats' }}</span>
            </div>
        </div>
        <div class="ticket-footer">
            <div class="ticket-footer-left">
                <span class="qty-tag">Tickets · <strong>{{ $quantity ?? 1 }}</strong></span>
            </div>
            <div class="ticket-footer-right">
                <span class="price-tag">{{ number_format((float) $event->price, 2) }} MAD</span>
            </div>
        </div>
    </div>
</body>
</html>
