<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function history()
    {
        return view('website.profile.payments.history');
    }
    public function installments()
    {
        return view('website.profile.payments.installments');
    }
}
