<div class="az-content-label mg-b-5 mt-4">Instalments Detail</div>
<p class="mg-b-20">All Instalments Details related to this order</p>
@php
    $total = (int) $order->total_deal_price;
    $advance = (int) $order->product_advance_price;
    $remaining_amount = $total - $advance;
    $total_tenure_percentage = 5 * ((int) $order->tenure);
    
    $total_percentage_amount = round(($total_tenure_percentage / 100) * $remaining_amount);
    $total_amount_with_percentage = $total_percentage_amount + $remaining_amount;
    if ((int) $order->tenure == 0) {
        $per_installment_price = 0;
    } else {
        $per_installment_price   =  number_format(round($total_amount_with_percentage / (int) $order->tenure));
    }
    $months = ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'];
@endphp
<div class="table-responsive">
    <table class="table az-table-reference mg-b-0" >
        <thead>
            <tr>
                <th>Instalment Month</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Payment Method</th>
                <th>Payment Receipt</th>
                <th width="60px">Status</th>
            </tr>
        </thead>
        <tbody>
            @if(in_array($order->status, ['Instalments','Completed']))
                @foreach($order_instalments as $item)
                    <tr>
                        <td class="align-middle ">{{ $item->month ?? '' }}</td>
                        <td class="align-middle ">Rs. {{  number_format($item->installment_price) }}</td>
                        <td class="text-center align-middle"> 
                            @if($item->type == 'Advnace')
                                {{ $item->created_at->format('M d, Y') ?? '' }}
                            @else
                                @if($item->status == 'Paid')
                                    {{ $item->updated_at->format('M d, Y') ?? '' }}
                                @else
                                    -
                                @endif
                                
                            @endif
                        </td>
                        <td class="text-center align-middle "> {{ $item->payment_method ?? '-' }} </td>
                        <td class="text-center align-middle"> 
                            @if(is_null($item->receipet))
                                @if($item->status == 'Paid')
                                    -
                                @else
                                    <button class="btn btn-info py-1 instalment-modal" value="{{ $item->installment_price ?? '' }}" style="min-height: auto !important;">Pay</button>
                                @endif
                            @else
                                <a target="_blank" href="{{ asset($item->receipet) }}">View</a>
                            @endif
                        </td>
                        <td> 
                            @if($item->status == 'Paid')
                                <label class="badge badge-success">Paid</label>
                            @else
                                <label class="badge badge-danger">Unpaid</label>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                @for($i = 0; $i < $order->tenure; $i++)
                    <tr>
                        <td>{{ $months[$i] ?? 0 }} Month</td>
                        <td>Rs. {{ $per_installment_price ?? 00.00 }}</td>
                        <td class="text-center"> - </td>
                        <td class="text-center"> - </td>
                        <td class="text-center"> - </td>
                        <td> <label class="badge badge-danger">Unpaid</label></td>
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>
</div>
    