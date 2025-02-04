@extends('dashboards.admin.layout.app')
@section('title')
    <title>Installment Calculator - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('css')
<link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/calculator/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Website & App</span>
                <span>Installment Calculator</span>
            </div>
            <h2 class="az-content-title">Installment Calculator</h2>
            <div class="az-content-label mg-b-5">Settings</div>
            <p class="mg-b-20">All settings of installment calculator</p>
            <form method="POST" action="{{ route('admin.installment-calculator.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row row-sm">
                    <div class="col-lg mt-2">
                        <label>Select Per Month Percentage <span class="text-danger">*</span></label>
                        <select class="form-control" name="per_month_percentage" required>
                            @if(!empty(config('website.calculator')) && !empty(config('website.calculator.percentages')))
                                @foreach(config('website.calculator.percentages') as $item)
                                    <option value="{{ $item ?? '' }}" {{ (($calculator) && $item == $calculator->per_month_percentage) ? 'selected' : '' }}>{{ $item ?? '' }}%</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('per_month_percentage'))
                            <span class="text-danger text-left">{{ $errors->first('per_month_percentage') }}</span>
                        @endif
                    </div>
                    <div class="col-lg mt-2">
                        <label>Select Installment Tenures <span class="text-danger">*</span></label>
                        <select id="installment_tenure" class="form-control select2" multiple="multiple" name="installment_tenure[]">
                            @if(!empty(config('website.calculator')) && !empty(config('website.calculator.tenures')))
                                @foreach(config('website.calculator.tenures') as $item)
                                    <option value="{{ $item ?? '' }}" {{ (($calculator) && in_array($item, json_decode($calculator->installment_tenure))) ? 'selected' : '' }}>{{ $item ?? '' }} Months</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('installment_tenure'))
                            <span class="text-danger text-left">{{ $errors->first('installment_tenure') }}</span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Update Calculator</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>
<script>
    $(function() {
        'use strict';
        $('.select2').select2({
            placeholder: 'Choose items',
            searchInputPlaceholder: 'Search'
        });
    });
</script>
@endsection