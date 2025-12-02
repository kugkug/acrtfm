<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quote Signature Request</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .wrapper {
            width: 100%;
            padding: 30px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-align: center;
            padding: 24px 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            margin-top: 0;
            font-size: 18px;
            color: #2c3e50;
        }
        .content p {
            line-height: 1.6;
            margin: 12px 0;
        }
        .cta {
            margin: 30px 0;
            text-align: center;
        }
        .cta a {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .cta a:hover {
            opacity: 0.9;
        }
        .footer {
            background-color: #f1f2f6;
            text-align: center;
            padding: 20px 30px;
            font-size: 12px;
            color: #7f8c8d;
        }
        .details {
            border: 1px solid #e0e4f0;
            border-radius: 6px;
            padding: 15px 20px;
            background-color: #f8f9ff;
            margin-top: 20px;
        }
        .details p {
            margin: 6px 0;
            font-size: 14px;
        }
        .muted {
            color: #7f8c8d;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>Quote Signature Request</h1>
            </div>
            <div class="content">
                <h2>Hello {{ $workOrder['customer']['name'] ?: $workOrder['customer']['company'] ?: 'there' }},</h2>
                <p>
                    {{ ($sender?->name ?? config('app.name')) }} has prepared a quotation for you to review and sign online.
                </p>
                <p>
                    Please click the button below to review the work order details and provide your electronic signature.
                </p>

                <div class="cta">
                    <a href="{{ $signUrl }}" target="_blank" rel="noopener">Review & Sign Quote</a>
                </div>

                <div class="details">
                    <p><strong>Work Order:</strong> WO-{{ str_pad($workOrder['id'], 6, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Title:</strong> {{ $workOrder['title'] ?? 'Quote' }}</p>
                    <p><strong>Requestor:</strong> {{ $sender?->name ?? 'Our Team' }}</p>
                    <p><strong>Expires:</strong> {{ $expiresAt->setTimezone(config('app.timezone'))->format('F j, Y g:i A') }} ({{ config('app.timezone') }})</p>
                </div>

                <p class="muted">
                    If you are unable to click the button above, copy and paste this link into your browser:
                    <br>
                    <a href="{{ $signUrl }}" target="_blank" rel="noopener">{{ $signUrl }}</a>
                </p>

                <p>
                    Thank you,<br>
                    {{ $sender?->name ?? config('app.name') }}
                </p>
            </div>
            <div class="footer">
                This link will expire on {{ $expiresAt->setTimezone(config('app.timezone'))->format('F j, Y g:i A') }}.<br>
                Please contact us if you need a new link or have any questions.
            </div>
        </div>
    </div>
</body>
</html>

