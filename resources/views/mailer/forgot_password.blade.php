<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            font-size: 16px;
            color: #ffffff !important;
            background-color: #007bff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Forgot Your Password?</h1>
        <p>Hello {{ ucwords(strtolower($name)) }},</p>
        <p>We received a request to reset your password. If you made this request, please click the button below to reset your password.</p>
        
        <a href="{!! $link !!}" class="button">Reset Password</a>
        <p>If you didn’t request a password reset, you can ignore this email.</p>
        <div class="footer">
            <p>Thank you,<br>ACRTFM</p>
            <p><a href="https://acrtfm.com/">Visit our website</a></p>
        </div>
    </div>
</body>
</html>