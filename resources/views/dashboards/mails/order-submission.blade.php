<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>شکریہ! آپ کا Order موصول ہو چکا ہے – جلد ہم آپ سے رابطہ کریں گے</title>
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
        .content h2 {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .content p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .button {
            background-color: #337ab7;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #23527c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>شکریہ! آپ کا Order موصول ہو چکا ہے – جلد ہم آپ سے رابطہ کریں گے</h2>
        </div>
        <div class="content">
            <h2>محترم {{ Auth::user()->name ?? '' }},</h2>      
          <p>ہمیں خوشی ہے کہ آپ نے اپنا آرڈر  Atomshop پر دیا! ہم آپ کے Product کو جلد از جلد آپ تک پہنچانے کے لیے کام کر رہے ہیں۔</p>
            <p>ہماری Order Verification Team اگلے24 گھنٹوں میں آپ سے رابطہ کرے گی تاکہ آپ کی تفصیلات کنفرم کی جا سکیں اور آپ کو اگلے مراحل کے بارے میں گائیڈ کیا جا سکے۔ براہ کرم، اپنا فون آن اور دستیاب رکھیں تاکہ یہ عمل تیز اور آسان ہو سکے۔</p>
            <p>اگر آپ کو کسی بھی قسم کی مدد درکار ہو، تو اس ای میل کا جواب دیں : <a href="mailto:support@atomshop.pk">support@atomshop.pk</a></p>
            <p>Atomshop.pk پر اعتماد کرنے کا شکریہ! ہم آپ کو بہترین سروس فراہم کرنے کے لیے پُرعزم ہیں۔</p>
            <p>نیک تمنائیں،</p>
            <p>Customer Support Team</p>
        </div>
    </div>
</body>
</html>