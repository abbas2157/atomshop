@extends('website.layout.app')
@section('title')
    <title>Faqs | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Faqs | Atomshop - Pay in steps">
@endsection
@section('content')
<style>
    .urdu-list {
    direction: rtl;
    text-align: right;
    list-style-position: inside;
}
</style>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <span class="breadcrumb-item active">Faqs</span>
            </nav>
        </div>
    </div>
    <div class="row px-xl-5 mb-5">
        <div class="col-12">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Faqs</span></h5>
            <div class="bg-light p-30">
                <div class="text-center mb-3">
                    <h4>Frequently Asked Questions (FAQs) – <b>AtomShop.pk</b></h4>
                </div>
                <div>
                    <h4 class="text-center"><b>For Buyers | خریداروں کے لیے</b></h4>
                    <h5 class="">✅ How can I purchase products on installments?</h5>
                    <h5 class="text-right mr-5">میں اقساط پر مصنوعات کیسے خرید سکتا ہوں؟ ✅</h5>
                    <p>
                        You can select any product from our website or Android/iOS app and choose an installment plan that suits you. You can also create a custom plan based on your preference.
                    </p>
                    <p class="text-center">
                        آپ ہماری ویب سائٹ یا ایپ سے کوئی بھی پروڈکٹ منتخب کر سکتے ہیں اور اپنی پسند کے مطابق اقساط کا منصوبہ منتخب کر سکتے ہیں۔ آپ اپنی مرضی کا قسط پلان بھی بنا سکتے ہیں۔
                    </p>
                    <h5 class="">✅ What documents are required for installments?</h5>
                    <h5 class="text-right mr-5">قسطوں کے لیے کون سے دستاویزات درکار ہیں؟ ✅</h5>
                    <p>
                        To apply, you need:
                        <ul>
                            <li>A valid <b>CNIC</b></li>
                            <li>Two references (personal or professional)</li>
                            <li>Proof of income (salary slip, bank statement, or business proof)</li>
                            <li>A post-dated cheque (if required)</li>
                        </ul>
                        📌 Requirements may vary based on the product and financing plan.
                    </p>
                    <p class="text-right">
                        اقساط کے لیے آپ کو درج ذیل دستاویزات فراہم کرنی ہوں گی
                        <ul class="urdu-list">
                            <li>قومی شناختی کارڈ</li>
                            <li>دو ذاتی یا پیشہ ورانہ ریفرنسز</li>
                            <li>(تنخواہ کی سلپ، بینک اسٹیٹمنٹ، یا کاروباری ثبوت)آمدنی کا ثبوت</li>
                            <li>(اگر درکار ہو) پوسٹ ڈیٹڈ چیک </li>
                        </ul>
                        <p class="text-right">
                            شرائط پروڈکٹ اور فنانسنگ پلان کے مطابق مختلف ہو سکتی ہیں۔
                        </p>
                    </p>
                    <h5 class="">✅ Is there any upfront payment required?</h5>
                    <h5 class="text-right mr-5">کیا کوئی ایڈوانس ادائیگی ضروری ہے؟ ✅</h5>

                    <p>
                        Yes, a down payment may be required depending on the product and installment plan.
                    </p>
                    <p class="text-right mr-5">
                        ہاں، کچھ اقساطی منصوبوں اور مصنوعات کی کیٹیگریز کے مطابق ڈاؤن پیمنٹ درکار ہو سکتی ہے۔
                    </p>
                    <h5 class="">✅ How long does installment approval take?</h5>
                    <h5 class="text-right mr-5"> قسطوں کی منظوری میں کتنا وقت لگتا ہے؟ ✅</h5>
                    <p>
                        Approval usually takes 24-48 hours, depending on document verification and eligibility checks.
                    </p>
                    <p class="text-right mr-5">
                        عام طور پر 24 سے 48 گھنٹے، دستاویزات کی تصدیق اور اہلیت کے چیک پر منحصر ہے۔
                    </p>
                    <h5 class="">✅ What happens if I miss an installment payment?</h5>
                    <h5 class="text-right mr-5">اگر میں قسط وقت پر ادا نہ کر سکا تو کیا ہوگا؟ ✅</h5>
                    <p>
                        Missing payments may result in penalties, restrictions on future purchases, and legal action. Always ensure timely payments to maintain a good credit standing.
                    </p>
                    <p class="text-right mr-5">
                        تاخیر کی صورت میں جرمانہ، مستقبل کی خریداریوں پر پابندی، اور قانونی کارروائی ہو سکتی ہے۔ ہمیشہ وقت پر ادائیگی کریں تاکہ کریڈٹ اسکور بہتر رہے۔
                    </p>
                    <h5 class="">✅ Can I purchase a product that is not available on the website?</h5>
                    <h5 class="text-right mr-5">کیا میں کوئی ایسی پروڈکٹ خرید سکتا ہوں جو ویب سائٹ پر موجود نہیں؟ ✅</h5>
                    <p>
                        Yes! You can select a product from the market and use our Custom Product Order Installment Calculator to place an order.
                    </p>
                    <p class="text-right mr-5">
                        جی ہاں! آپ مارکیٹ سے کوئی بھی پروڈکٹ منتخب کرکے ہماری کسٹم پروڈکٹ آرڈر قسط کیلکولیٹر کے ذریعے آرڈر دے سکتے ہیں۔
                    </p>
                    <h4 class="text-center"><b>For Sellers | فروخت کنندگان کے لیے</b></h4>
                    <h5 class="">✅ How can I start selling on Atomshop.pk?</h5>
                    <h5 class="text-right mr-5">پر بیچنا کیسے شروع کر سکتا ہوں؟Atomshop.pk میں ✅</h5>
                    <p>
                        You can register as a seller on our website, provide business details, and choose a suitable plan to start selling.
                    </p>
                    <p class="text-right mr-5">
                        بس ہماری ویب سائٹ پر بیچنے والے کے طور پر رجسٹر کریں، کاروباری تفصیلات فراہم کریں، اور مناسب پلان کا انتخاب کریں۔
                    </p>
                    <h5 class="">✅ What are the benefits of selling on Atomshop.pk?</h5>
                    <h5 class="text-right mr-5">پر بیچنے کے کیا فوائد ہیں؟ ✅ Atomshop.pk</h5>
                    <p>
                         You get access to a ready-to-use <b>SaaS platform</b>, marketing support, and access to a large customer base looking for installment-based shopping.
                    </p>
                    <p dir="rtl" class="text-right mr-5">
                        آپ کو ایک ریڈی ٹو یوز SaaS پلیٹ فارم، مارکیٹنگ سپورٹ، اور قسطوں پر خریداری کرنے والے کسٹمرز تک رسائی ملے گی۔
                    </p>
                    <h5 class="">✅ How do I receive payments for my sales?</h5>
                    <h5 class="text-right mr-5"> مجھے اپنی فروخت کی ادائیگی کیسے ملے گی؟ ✅</h5>
                    <p>
                        Payments are transferred directly to your registered bank account as per the agreed settlement terms.
                    </p>
                    <p class="text-right mr-5">
                       آپ کی رجسٹرڈ بینک اکاؤنٹ میں معاہدہ شدہ سیٹلمنٹ شرائط کے مطابق ادائیگی منتقل کی جائے گی۔
                    </p>

                    <h5 class="">✅Can I set my own installment plans?</h5>
                    <h5 class="text-right mr-5">کیا میں اپنی اقساطی منصوبہ بندی خود کر سکتا ہوں؟ ✅</h5>
                    <p>
                       Yes! Sellers have the flexibility to define their own installment structures based on their business model.
                    </p>
                    <p class="text-right mr-5">
                         جی ہاں! فروخت کنندگان کو اپنی کاروباری حکمت عملی کے مطابق قسطوں کے منصوبے بنانے کی مکمل آزادی حاصل ہے۔
                    </p>
                    <h5 class="">✅ Is there a fee for selling on Atomshop.pk?</h5>
                    <h5 class="text-right mr-5"> پر بیچنے کے لیے کوئی فیس ہے؟ Atomshop.pk کیا ✅</h5>
                    <p>
                        Yes, a service fee applies based on the chosen <b>SaaS plan</b>. Check the seller registration section for details.
                    </p>
                    <p dir="rtl" class="text-right mr-5">
                        جی ہاں، منتخب کردہ SaaS پلان کے مطابق سروس فیس وصول کی جاتی ہے۔ مزید تفصیلات کے لیے بیچنے والے کی رجسٹریشن سیکشن دیکھیں۔
                    </p>
                </div>
            </div>
        </div>

    </div>
    @include('website.home.partials.featured-start')
</div>
@endsection
