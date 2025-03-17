@extends('website.layout.app')
@section('title')
    <title>All Installments | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="About | Atomshop - Pay in steps">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ route('profile') }}">My Profile</a>
                <span class="breadcrumb-item active" >All Installments</span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
            @include('website.profile.partials.sidebar')
        </div>
        <div class="col-lg-9 col-md-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">All Installments</span></h5>
            @if(is_null(Auth::user()->customer) || Auth::user()->customer->verified == '0') 
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Note !</strong> Get verified yourself immediately. Our agent will visite you soon.
                </div>
            @endif
            <div class="bg-light mb-30">
                <div class="table-responsive mb-3">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Instalment Month</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th>Payment Method</th>
                                <th>Payment Receipt</th>
                                <th width="60px">Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @if($instalments->isNotEmpty())
                                @foreach($instalments as $item)
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
                                                -
                                            @else
                                                <a target="_blank" href="{{ asset($item->receipet) }}">View</a>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle"> 
                                            @if($item->status == 'Paid')
                                                <i class="fas fa-check-circle text-success"></i>
                                            @else
                                            <i class="fas fa-times-circle text-danger"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center align-middle"> No instalment found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    
</script>
@endsection
