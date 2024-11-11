<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            margin: 40px auto;

            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .content {
            padding: 30px 20px;
            text-align: center;
        }
        .content p {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 15px;
            font-size: 14px;
            color: #777777;
            text-align: center;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Chào mừng đến với {{ config('app.name') }}, {{ $user->full_name }}!</h1>
        </div>
        <div class="content">
            <p>Cảm ơn bạn đã đăng ký tại <strong>{{ config('app.name') }}</strong>. Để hoàn tất việc tạo tài khoản, vui lòng xác nhận email của bạn bằng cách nhấp vào nút bên dưới.</p>
            <a href="{{ $url }}" class="button">Xác nhận Email</a>
            <p>Nếu bạn không nhấp được vào nút trên, sao chép và dán liên kết sau vào trình duyệt:</p>
            <p><a href="{{ $url }}">{{ $url }}</a></p>
        </div>
        <div class="footer">
            <p>Nếu bạn không yêu cầu tạo tài khoản, vui lòng bỏ qua email này.</p>
            <p>Cảm ơn,<br>Đội ngũ {{ config('app.name') }}</p>
            <p><a href="{{ config('app.url') }}">Truy cập trang web</a></p>
        </div>
    </div>
</body>
</html>
