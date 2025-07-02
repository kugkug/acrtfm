<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Replied Post Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 10px 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .post-info {
            margin: 20px 0;
        }
        .post-title {
            font-size: 18px;
            font-weight: bold;
        }
        .reply {
            margin-top: 10px;
        }
        .reply-title {
            font-weight: bold;
        }
        .reply-content {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Comment Notification</h1>
        </div>
        <div class="content">
            <p>Hi, </p>
            <p>We wanted to let you know that your post has received a reply:</p>
            
            <p>To view the full reply and participate in the discussion, click the button below:</p>
            <a href="{{ $link }}" class="button" style="color: #FFFFFF;">View Comment</a>
        </div>
    </div>
</body>
</html>
