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

    public function installments(Request $request)
    {
        $query = OrderInstalment::where('user_id', Auth::id());

        if ($request->has('order_id') && !empty($request->order_id)) {
            $query->where('order_id', $request->order_id);
        }

        $instalments = $query->orderBy('id', 'desc')->paginate(10);
        $allOrderIds = OrderInstalment::where('user_id', Auth::id())->pluck('order_id')->unique();

        return view('website.profile.payments.installments', compact('instalments', 'allOrderIds'));
    }

}
