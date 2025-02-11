
<div class="container">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Minimum Advance Amount</th>
                        <th>Installment Tenure (Months)</th>
                        <th>Monthly Amount Pecentage</th>
                        <th>Total Deal Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <tr>
                        <td class="align-middle">
                            <input type="number" class="form-control" value="{{ $product['min_advance_price'] ?? 0 }}" id="min_advance_price" placeholder="Enter Amount" required="required"/>
                        </td>
                        <td class="align-middle">
                            <div class="input-group installment-calculator-detail mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="tenure_months" min="3" max="12" class="form-control form-control-sm bg-secondary border-0 text-center" value="3">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $calculator->per_month_percentage ?? 4 }}%</td>
                        <td class="align-middle">Rs. <span class="variation-price">{{ number_format($product['variation_price']) }}</span></td>
                        
                        <td class="align-middle">
                            <button class="btn btn-sm btn-danger make-installment">Make Installments</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @php
        $total = (int) $product['variation_price'];
        $advance = (int) $product['min_advance_price'];
        $remaining_amount = $total - $advance;
        if(is_null($calculator)) {
            $total_tenure_percentage = 4 * 3;
        }
        else {
            $total_tenure_percentage = ((int) $calculator->per_month_percentage) * 3;
        }
        $total_percentage_amount = round(($total_tenure_percentage / 100) * $remaining_amount);
        $total_amount_with_percentage = $total_percentage_amount + $remaining_amount;
        $per_installment_price   =  number_format(round($total_amount_with_percentage / 3));
        $months = ['1st','2nd','3rd'];
    @endphp
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Sr No.</th>
                        <th>Months</th>
                        <th>Installment Price</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="installment-rows">
                    @for($i = 0; $i < 3; $i++) 
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $months[$i] ?? 0 }} Month</td>
                            <td>Rs. {{ $per_installment_price ?? 00.00 }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>