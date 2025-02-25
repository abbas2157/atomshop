<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>Welcome (خوش آمدید) to Atomshop.pk.</title>
    <style>
        body {
            font-family: 'Noto Nastaliq Urdu', 'Jameel Noori Nastaleeq', Arial, sans-serif;
            direction: rtl;
            text-align: right;
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
            <h2>Welcome (خوش آمدید) to Atomshop.pk.</h2>
        </div>
        <div dir="rtl" class="content" style="direction: rtl; text-align: right;">
            <h2 style="direction: rtl; text-align: right;">محترم {{ $user->name }},</h2>
            <p style="direction: rtl; text-align: right;">Atomshop.pk پر رجسٹریشن کا شکریہ! ہمیں خوشی ہے کہ آپ ہمارے Platform کا حصہ بن گئے ہیں، اور ہم آپ کو ایک بہترین Shopping Experience فراہم کرنے کے لیے پرجوش ہیں۔</p>
            <ul style="direction: rtl; text-align: right;">
                <li style="direction: rtl; text-align: right;">✔ Easy Installments پر بے شمار Products کو ایکسپلور کریں۔</li>
                <li style="direction: rtl; text-align: right;">✔ اپنے Orders کو Track کریں اور اپنی خریداری کو آسانی سے Manage کریں۔</li>
                <li style="direction: rtl; text-align: right;">✔ خصوصی Deals اور آفرز سے فائدہ اٹھائیں جو صرف آپ کے لیے ہیں۔</li>
            </ul>
            <p style="direction: rtl; text-align: right;">🚀 اپنے Account میں لاگ ان کرنے کے لیے <a href="{{ route('login') }}">یہاں کلک کریں</a></p>
            <p style="direction: rtl; text-align: right;">📧 support@atomshop.pk | 📞 0300-8622866</p>
            <p style="direction: rtl; text-align: right;">🛍️ Happy Shopping!</p>
            <img src="https://atomshop.pk/public/web/img/logo.png" alt="Logo" width="100" style="display: block; width: 100px; max-width: 100px; min-width: 48px;">
        </div>
        <div class="footer">
            <p>
                <strong>Best regards,</strong>
                <br> Customer Support Team, Atomshop.pk
            </p>
        </div>
    </div>
</body>
</html>