<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $mailData['title'] ?? 'OTP Verification' }}</title>
    <style>
        .container {
            max-width: 600px;
            margin: auto;
            font-family: Arial, sans-serif;
            border: 1px solid #ddd;
            padding: 30px;
            background-color: #f9f9f9;
        }
        .otp-box {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 10px;
            text-align: center;
            background-color: #fff;
            border: 2px dashed #d9534f;
            padding: 15px;
            margin: 20px 0;
            color: #d9534f;
        }
        .footer {
            font-size: 14px;
            color: #888;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $mailData['title'] ?? 'OTP Verification' }}</h2>

        <p>{{ $mailData['body'] ?? 'Use the OTP below to proceed with your request:' }}</p>

        <div class="otp-box">
            {{ $mailData['otp'] }}
        </div>

        <p>If you did not request this, please ignore this email.</p>

        <div class="footer">
            <p>Thanks,<br>House of Timely Investments</p>
        </div>
    </div>
</body>
</html>
