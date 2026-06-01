<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to EVM - Application Received</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Helvetica Neue', sans-serif;
            background-color: #f4f4f7;
            padding: 40px 20px;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #7972FE 0%, #a855f7 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header-title {
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
        }

        .checkmark-wrapper {
            background: #ffffff;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .checkmark svg {
            width: 40px;
            height: 40px;
            stroke: #ffffff;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
        }

        .email-body {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 20px;
        }

        .message {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 30px;
        }

        .info-box {
            background: linear-gradient(135deg, rgba(121, 114, 254, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
            border-left: 4px solid #7972FE;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .info-box h3 {
            color: #7972FE;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .info-box h3::before {
            content: '📧';
            margin-right: 10px;
            font-size: 24px;
        }

        .info-box ul {
            list-style: none;
            padding: 0;
        }

        .info-box li {
            color: #4b5563;
            margin-bottom: 12px;
            padding-left: 30px;
            position: relative;
            font-size: 15px;
        }

        .info-box li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #10B981;
            font-weight: bold;
            font-size: 18px;
        }

        .timeline {
            background: #f9fafb;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .timeline h3 {
            color: #111827;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .timeline-item {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            position: relative;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 35px;
            width: 2px;
            height: calc(100% + 10px);
            background: #e5e7eb;
        }

        .timeline-item:last-child::before {
            display: none;
        }

        .timeline-marker {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .timeline-item.completed .timeline-marker {
            background: #10B981;
        }

        .timeline-item.active .timeline-marker {
            background: #7972FE;
        }

        .timeline-item.pending .timeline-marker {
            background: #e5e7eb;
            border: 2px solid #d1d5db;
        }

        .timeline-content h4 {
            color: #111827;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .timeline-content p {
            color: #6b7280;
            font-size: 14px;
        }

        .contact-box {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.1) 0%, rgba(121, 114, 254, 0.1) 100%);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .contact-box p {
            color: #4b5563;
            font-size: 15px;
        }

        .contact-box a {
            color: #7972FE;
            text-decoration: none;
            font-weight: 600;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #7972FE 0%, #a855f7 100%);
            color: #ffffff;
            padding: 16px 40px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            margin: 0 auto;
        }

        .email-footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .email-footer p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #7972FE;
            text-decoration: none;
            font-size: 14px;
        }

        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 30px 20px;
            }

            .header-title {
                font-size: 24px;
            }

            .greeting {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo">⚡</div>
            <h1 class="header-title">Application Received!</h1>
            <p class="header-subtitle">Your organizer application is under review</p>
        </div>

        <!-- Checkmark Section -->
        <div class="checkmark-wrapper">
            <div class="checkmark">
                <svg viewBox="0 0 52 52">
                    <path d="M14 27l8 8 16-16"/>
                </svg>
            </div>
            <h2 style="color: #10B981; font-size: 22px; font-weight: 600;">Successfully Submitted!</h2>
        </div>

        <!-- Body Content -->
        <div class="email-body">
            <h2 class="greeting">Hello {{ $user->name }},</h2>

            <p class="message">
                Thank you for registering as an <strong>Event Organizer</strong> with EVM! We're excited to have you join our community of event creators.
            </p>

            <p class="message">
                Your application has been successfully submitted and is currently under review by our team.
            </p>

            <!-- What's Next Box -->
            <div class="info-box">
                <h3>What's Next?</h3>
                <ul>
                    <li>Your application is being carefully reviewed by our team</li>
                    <li>We'll evaluate your organizer profile and establishment details</li>
                    <li>Review typically takes <strong>up to 24 hours</strong></li>
                    <li>You'll receive an email notification once approved</li>
                    <li>After approval, you can start creating and managing events</li>
                </ul>
            </div>

            <!-- Timeline -->
            <div class="timeline">
                <h3>Review Timeline</h3>

                <div class="timeline-item completed">
                    <div class="timeline-marker">✓</div>
                    <div class="timeline-content">
                        <h4>Application Submitted</h4>
                        <p>Your registration has been received</p>
                    </div>
                </div>

                <div class="timeline-item active">
                    <div class="timeline-marker">⏳</div>
                    <div class="timeline-content">
                        <h4>Under Review</h4>
                        <p>Our team is reviewing your application</p>
                    </div>
                </div>

                <div class="timeline-item pending">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>Approval & Activation</h4>
                        <p>Within 24 hours</p>
                    </div>
                </div>
            </div>

            <!-- Your Details -->
            <div style="background: #f9fafb; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                <h3 style="color: #111827; font-size: 16px; font-weight: 600; margin-bottom: 15px;">Your Application Details</h3>
                <table style="width: 100%; font-size: 14px;">
                    <tr>
                        <td style="padding: 8px 0; color: #6b7280; width: 40%;"><strong>Name:</strong></td>
                        <td style="padding: 8px 0; color: #111827;">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #6b7280;"><strong>Email:</strong></td>
                        <td style="padding: 8px 0; color: #111827;">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #6b7280;"><strong>Phone:</strong></td>
                        <td style="padding: 8px 0; color: #111827;">{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #6b7280;"><strong>Status:</strong></td>
                        <td style="padding: 8px 0; color: #f59e0b; font-weight: 600;">⏳ Pending Review</td>
                    </tr>
                </table>
            </div>

            <!-- Contact Box -->
            <div class="contact-box">
                <p>
                    Have questions? Contact our support team at<br>
                    <a href="mailto:support@evmanagement.com">support@evmanagement.com</a>
                </p>
            </div>

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ config('app.frontend_url') }}/pending-approval" class="button">
                    View Application Status
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p><strong>EVM - Event Management Platform</strong></p>
            <p>Creating amazing event experiences for organizers and spectators</p>
            <p style="margin-top: 20px; font-size: 12px; color: #9ca3af;">
                This email was sent to {{ $user->email }}. If you didn't register for this account, please ignore this email.
            </p>
            <div class="social-links">
                <a href="#">Website</a> |
                <a href="#">Twitter</a> |
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a>
            </div>
            <p style="margin-top: 20px; font-size: 12px; color: #9ca3af;">
                &copy; {{ date('Y') }} EVM. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
