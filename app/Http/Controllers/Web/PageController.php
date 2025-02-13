<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about() {
        return view('website.pages.about-us');
    }
    public function privacypolicy() {
        return view('website.pages.privacy-policy');
    }
    public function returnrefundpolicy() {
        return view('website.pages.return-refund-policy');
    }
    public function faqs() {
        return view('website.pages.faqs');
    }
}
