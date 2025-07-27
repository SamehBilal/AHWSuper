<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Invitation - {{ $app->name }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .logo {
            width: 60px;
            height: 60px;
            background: #d32f2f;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .app-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #d32f2f;
        }
        .button-group {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 0 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            min-width: 120px;
        }
        .btn-accept {
            background: #10b981;
            color: white;
        }
        .btn-reject {
            background: #ef4444;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .personal-message {
            background: #e0f2fe;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #0284c7;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">AH</div>
            <h1 style="margin: 0; color: #1f2937;">You're Invited to Test!</h1>
            <p style="color: #6b7280; margin: 10px 0 0 0;">{{ $tester->invitedBy->name }} wants you to help test their application</p>
        </div>

        <div class="app-info">
            <h3 style="margin: 0 0 10px 0; color: #1f2937;">{{ $app->name }}</h3>
            <p style="margin: 0; color: #6b7280;">{{ $app->description ?? 'An innovative application on the Arabhardware platform.' }}</p>
        </div>

        @if($tester->message)
        <div class="personal-message">
            <h4 style="margin: 0 0 10px 0; color: #0284c7;">Personal Message</h4>
            <p style="margin: 0; font-style: italic;">"{{ $tester->message }}"</p>
            <p style="margin: 10px 0 0 0; color: #6b7280; font-size: 14px;">- {{ $tester->invitedBy->name }}</p>
        </div>
        @endif

        <p>Hi {{ $tester->user->name }},</p>

        <p>You've been invited to be a beta tester for <strong>{{ $app->name }}</strong> on the Arabhardware platform! As a tester, you'll get early access to new features and help shape the future of this application.</p>

        <p><strong>What does this mean?</strong></p>
        <ul>
            <li>🎯 Early access to new features before they're public</li>
            <li>🔍 Help identify bugs and provide valuable feedback</li>
            <li>💬 Direct communication channel with the development team</li>
            <li>🏆 Recognition as a valued community contributor</li>
        </ul>

        <div class="button-group">
            <a href="{{ $acceptUrl }}" class="btn btn-accept">Accept Invitation</a>
            <a href="{{ $rejectUrl }}" class="btn btn-reject">Decline</a>
        </div>

        <div class="divider"></div>

        <p style="font-size: 14px; color: #6b7280;">
            <strong>Note:</strong> You must be logged into your Arabhardware account to accept this invitation.
            This invitation is specifically for {{ $tester->email }} and cannot be transferred.
        </p>

        <div class="footer">
            <p>This invitation was sent by {{ $tester->invitedBy->name }} via the Arabhardware Developer Platform.</p>
            <p>
                <a href="{{ $appUrl }}" style="color: #d32f2f;">Visit Arabhardware</a> |
                <a href="{{ $appUrl }}/developer" style="color: #d32f2f;">Developer Portal</a>
            </p>
            <p style="margin-top: 20px;">
                If you didn't expect this invitation, you can safely ignore this email.
            </p>
        </div>
    </div>
</body>
</html>
