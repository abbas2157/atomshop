<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use Illuminate\Http\Request;
use App\Models\{ActiveSeller,Order, OrderInstalment,};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InstalmentController extends Controller
{

    public function index(Request $request)
    {
        $active_areas_ids = ActiveSeller::where('user_id', Auth::id())->pluck('area_id')->toArray();
        $orderIds = Order::whereIn('area_id', $active_areas_ids)->pluck('id');

        $query = OrderInstalment::select('id', 'user_id', 'order_id', 'month', 'installment_price', 'receipet', 'payment_method', 'type', 'status', 'created_at')
            ->whereIn('order_id', $orderIds)
            ->with('order.cart.product');

        if ($request->has('order_id') && !empty($request->order_id)) {
            $query->where('order_id', $request->order_id);
        }

        if ($request->has('status') && in_array($request->status, ['Paid', 'Unpaid'])) {
            $query->where('status', $request->status);
        }

        if ($request->has('upcoming')) {
            $query->where('status', 'Unpaid')
                ->whereIn('id', function ($subQuery) {
                    $subQuery->selectRaw('MIN(id)')->from('order_instalments')
                    ->whereColumn('order_id', 'order_instalments.order_id')->where('status', 'Unpaid')->groupBy('order_id');
                });
        }
        $instalments = $query->orderBy('id', 'desc')->paginate(10);
        $allOrderIds = OrderInstalment::whereIn('order_id', $orderIds)->pluck('order_id')->unique();
        $totalPaid = (clone $query)->where('status', 'Paid')->sum('installment_price');
        $totalUnpaid = (clone $query)->where('status', 'Unpaid')->sum('installment_price');

        return view('dashboards.sellers.instalment.index', compact('instalments', 'allOrderIds', 'totalPaid', 'totalUnpaid'));
    }


}
