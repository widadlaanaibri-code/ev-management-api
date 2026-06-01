<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Accepted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #10b981;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .event-details {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            border-left: 4px solid #10b981;
        }
        .detail-row {
            margin: 10px 0;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #777;
            font-size: 14px;
        }
        .success-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="success-icon">✓</div>
        <h1>Event Approved!</h1>
    </div>

    <div class="content">
        <p>Dear {{ $event->creater->name }},</p>

        <p>Great news! Your event has been approved by our admin team and is now live on our platform.</p>

        <div class="event-details">
            <h3 style="margin-top: 0; color: #10b981;">Event Details</h3>

            <div class="detail-row">
                <span class="label">Event Title:</span>
                <span>{{ $event->title }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Date:</span>
                <span>{{ \Carbon\Carbon::parse($event->date)->format('F d, Y - h:i A') }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Location:</span>
                <span>{{ $event->location }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Total Seats:</span>
                <span>{{ $event->total_seats }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Price:</span>
                <span>${{ number_format($event->price, 2) }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Category:</span>
                <span>{{ $event->category->name ?? 'N/A' }}</span>
            </div>
        </div>

        <p>Your event is now visible to all users and they can start making reservations. You will receive notifications when users book tickets for your event.</p>

        <p>Thank you for using our platform to host your event!</p>

        <p>Best regards,<br>
        <strong>Event Management Team</strong></p>
    </div>

    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} Event Management Platform. All rights reserved.</p>
    </div>
</body>
</html>
