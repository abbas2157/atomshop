@php
    $calculator = App\Models\InstallmentCalculator::first();
@endphp
<div class="container">
    <h2 class=" text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Installment Calculator</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Add Amount</th>
                        <th>Installment Tenure (Months)</th>
                        <th>Pr Month Percentage</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <tr>
                        <td class="align-middle">
                            <input type="text" class="form-control" id="installment_total_amount" placeholder="Enter Amount" required="required"/>
                        </td>
                        <td class="align-middle">
                            <div class="input-group installment-calculator mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" min="3" max="12" class="form-control form-control-sm bg-secondary border-0 text-center" value="3">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $calculator->per_month_percentage ?? 4 }}%</td>
                        <td class="align-middle">
                            <button class="btn btn-sm btn-danger"><i class="fa fa-calculator"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Cart End -->