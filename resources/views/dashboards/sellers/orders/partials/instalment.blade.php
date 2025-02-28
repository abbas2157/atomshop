<div class="az-content-label mg-b-5 mt-4">Installments Detail</div>
<p class="mg-b-20">All Installments Details related to this order</p>
@php
    $calculator = App\Models\InstallmentCalculator::first();
    $total = (int) $order->total_deal_price;
    $advance = (int) $order->product_advance_price;
    $remaining_amount = $total - $advance;
    if(is_null($calculator)) {
        $total_tenure_percentage = 4 * ((int) $order->instalment_tenure);
    }
    else {
        $total_tenure_percentage = ((int) $calculator->per_month_percentage) * ((int) $order->instalment_tenure);
    }
    
    $total_percentage_amount = round(($total_tenure_percentage / 100) * $remaining_amount);
    $total_amount_with_percentage = $total_percentage_amount + $remaining_amount;
    $per_installment_price   =  number_format(round($total_amount_with_percentage / (int) $order->instalment_tenure));
    $months = ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'];
@endphp
<div class="table-responsive">
    <table class="table az-table-reference mg-b-0" >
        <thead>
            <tr>
                <th>Instalment Month</th>
                <th>Amount</th>
                <th>Installment Date</th>
                <th>Payment Date</th>
                <th>Payment Method</th>
                <th>Payment Receipt</th>
                <th width="60px">Status</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < $order->instalment_tenure; $i++)
                <tr>
                    <td>{{ $months[$i] ?? 0 }} Month</td>
                    <td>Rs. {{ $per_installment_price ?? 00.00 }}</td>
                    <td class="text-center"> - </td>
                    <td class="text-center"> - </td>
                    <td class="text-center"> - </td>
                    <td class="text-center"> - </td>
                    <td> <label class="badge badge-danger">Unpaid</label></td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>
    