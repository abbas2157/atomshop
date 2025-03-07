<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{OrderInstalment};

class PaymentController extends Controller
{
    public function history()
    {
        $instalments = OrderInstalment::where('user_id', Auth::user()->id)->where('status', 'Paid')->get();
        return view('website.profile.payments.history', compact('instalments'));
    }
    public function installments()
    {
        $instalments = OrderInstalment::where('user_id', Auth::user()->id)->get();
        return view('website.profile.payments.installments', compact('instalments'));
    }
}
