<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Event Ticket - EVM</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background-color: #03001d;
            color: #e5e7eb;
            padding: 40px 20px;
            line-height: 1.6;
        }
        .email-wrapper {
            max-width: 560px;
            margin: 0 auto;
        }
        .email-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(121, 114, 254, 0.25);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }
        .email-header {
            background: linear-gradient(135deg, #7972FE 0%, #a855f7 100%);
            padding: 32px 24px;
            text-align: center;
        }
        .email-logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: #fff;
            margin-bottom: 6px;
        }
        .email-headline {
            font-size: 18px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
        }
        .email-body {
            padding: 32px 24px;
        }
        .greeting {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 16px;
        }
        .message {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 24px;
        }
        .event-box {
            background: rgba(121, 114, 254, 0.1);
            border: 1px solid rgba(121, 114, 254, 0.3);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .event-box-title {
            font-size: 16px;
            font-weight: 600;
            color: #a5b4fc;
            margin-bottom: 8px;
        }
        .event-box-name {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
        }
        @if(isset($quantity) && $quantity > 1)
        .event-box-qty {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 8px;
        }
        @endif
        .attachment-note {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            padding: 14px;
            background: rgba(121, 114, 254, 0.08);
            border-radius: 8px;
            border-left: 3px solid #7972FE;
        }
        .thanks {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 24px;
        }
        .email-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(121, 114, 254, 0.2);
            text-align: center;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-card">
            <div class="email-header">
                <div class="email-logo">EVM</div>
                <div class="email-headline">Your ticket is ready</div>
            </div>
            <div class="email-body">
                <p class="greeting">Hello{{ isset($userName) ? ', ' . $userName : '' }}!</p>
                <p class="message">Your reservation is confirmed. Please find your event ticket attached to this email.</p>
                @if(isset($eventTitle))
                <div class="event-box">
                    <div class="event-box-title">Event</div>
                    <div class="event-box-name">{{ $eventTitle }}</div>
                    @if(isset($quantity) && $quantity > 1)
                    <div class="event-box-qty">Quantity: <strong>{{ $quantity }}</strong> seats</div>
                    @endif
                </div>
                @endif
                <div class="attachment-note">📎 Your ticket PDF is attached. Present it at the venue (digital or printed).</div>
                <p class="thanks">Thank you for using EVM. We hope you enjoy the event!</p>
            </div>
            <div class="email-footer">
                EVM · Event Management
            </div>
        </div>
    </div>
</body>
</html>
