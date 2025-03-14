<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Atomshop.pk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .content ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .content ul li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .content ul li:last-child {
            border-bottom: none;
        }
        .footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            clear: both;
        }
        a {
            text-decoration: none;
            color: #337ab7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Welcome to Atomshop.pk</h2>
        </div>
        <div class="content">
            <h2>محترم {{ $user->name }},</h2>
            <p>Atomshop.pk پر رجسٹریشن کا شکریہ! ہمیں خوشی ہے کہ آپ ہمارے Platform کا حصہ بن گئے ہیں، اور ہم آپ کو ایک بہترین Shopping Experience فراہم کرنے کے لیے پرجوش ہیں۔</p>
            <ul>
                <li>✔ Easy Installments پر بے شمار Products کو ایکسپلور کریں۔</li>
                <li>✔ اپنے Orders کو Track کریں اور اپنی خریداری کو آسانی سے Manage کریں۔</li>
                <li>✔ خصوصی Deals اور آفرز سے فائدہ اٹھائیں جو صرف آپ کے لیے ہیں۔</li>
            </ul>
            <p>🚀 اپنے Account میں لاگ ان کرنے کے لیے <a href="{{ route('login') }}">یہاں کلک کریں</a></p>
            <p>📧 support@atomshop.pk | 📞 0300-8622866</p>
            <p>🛍️ Happy Shopping!</p>
        </div>
        <div class="footer">
            <p>
              <strong>Best regards,</strong>
              <br> Customer Support Team, Atomshop.pk
            </p>
            <img src="https://atomshop.pk/public/web/img/logo.png" alt="Logo" width="100" style="display: block; width: 100px; max-width: 100px; min-width: 48px;">
        </div>
    </div>
</body>
</html>