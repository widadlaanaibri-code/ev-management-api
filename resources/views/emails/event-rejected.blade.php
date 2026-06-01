<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Rejected</title>
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
            background-color: #ef4444;
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
            border-left: 4px solid #ef4444;
        }
        .rejection-reason {
            background-color: #fef2f2;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            border-left: 4px solid #ef4444;
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
        .warning-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="warning-icon">✕</div>
        <h1>Event Not Approved</h1>
    </div>

    <div class="content">
        <p>Dear {{ $event->creater->name }},</p>

        <p>We regret to inform you that your event submission has not been approved by our admin team.</p>

        <div class="event-details">
            <h3 style="margin-top: 0; color: #ef4444;">Event Details</h3>

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
                <span class="label">Category:</span>
                <span>{{ $event->category->name ?? 'N/A' }}</span>
            </div>
        </div>

        @if($rejectionReason)
        <div class="rejection-reason">
            <h4 style="margin-top: 0; color: #ef4444;">Reason for Rejection:</h4>
            <p style="margin-bottom: 0;">{{ $rejectionReason }}</p>
        </div>
        @endif

        <p>You can modify your event details and resubmit it for approval. Please ensure that your event meets our platform guidelines and policies.</p>

        <p><strong>Next Steps:</strong></p>
        <ul>
            <li>Review the rejection reason carefully</li>
            <li>Make necessary modifications to your event</li>
            <li>Resubmit your event for approval</li>
            <li>Contact our support team if you need clarification</li>
        </ul>

        <p>We appreciate your understanding and look forward to helping you host successful events on our platform.</p>

        <p>Best regards,<br>
        <strong>Event Management Team</strong></p>
    </div>

    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} Event Management Platform. All rights reserved.</p>
    </div>
</body>
</html>
