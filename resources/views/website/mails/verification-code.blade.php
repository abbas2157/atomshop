<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Verify Your Email to Complete Your Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @media screen {
            @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: 400;
            src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }
            @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: 700;
            src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        table {
            border-collapse: collapse !important;
        }
        a {
            color: #1a82e2;
        }
        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>
</head>
<body style="background-color: #e9ecef;">
    <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
        Verify Your Email to Complete Your Registration
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 0px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                            <div style="background-color: #333; color: #fff; padding: 10px; text-align: center;margin-bottom: 20px;">
                                <h2>Welcome to Atomshop.pk</h2>
                            </div>
                            <h3 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Dear {{ $data->name ?? ''}},</h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p style="margin: 0;">Welcome to <b>Atomshop.pk!</b> 🎉 To complete your registration and unlock your account, please verify your email by providing the code below:</p>

                            <p>The code is  : <b>{{ $verify_code ?? '' }}</b></p>
                            <p>Why is email verification important?</p>
                            <ul>
                                <li>Secure your account and personal information.</li>
                                <li>Get important updates about your orders, payments, and offers.</li>
                                <li>Ensure smooth communication with our support team.</li>
                            </ul>
                            <p>
                                If you didn’t sign up for an account on Atomshop.pk, please ignore this email. For any assistance, feel free to reach out at <a href="mailto:atomshoppk@gmail.com">atomshoppk@gmail.com</a>.
                            </p>
                            <p> Looking forward to having you on board! 😊 </p>
                            <p>📧 support@atomshop.pk | 📞 0300-8622866</p>
                            <p>🛍️ Happy Shopping!</p>
                            <p style="margin: 0;"> <b>Best Regards</b>, <br /> {{ config('website.name') ?? '' }} Team </p>
                            <a href="{{ route('website') }}" target="_blank" style="display: inline-block;">
                                <img src="https://atomshop.pk/public/web/img/logo.png" alt="Logo" width="100" style="display: block; width: 100px; max-width: 100px; min-width: 48px;">
                            </a>
                            <div style="background-color: #333; color: #fff; padding: 10px; text-align: center; clear: both;">
                                <p><strong>Best regards,</strong><br>Customer Support Team, Atomshop.pk</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>