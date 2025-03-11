@extends('dashboards.admin.layout.app')
@section('title')
    <title>Customers - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/accounts/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Accounts Management</span>
                    <span>Customers</span>
                    <span>{{ $user->name ?? '' }}</span>
                    <span>Edit</span>
                </div>
                <h2 class="az-content-title">Customers</h2>
                <div class="az-content-label mg-b-5">Personal Detail</div>
                <p class="mg-b-10">Using this form you can edit detail customers </p>
                <form method="POST" action="{{ route('admin.customers.update', $user->uuid) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Customer name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}"
                                placeholder="Enter customer name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Customer email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}"
                                placeholder="Enter customer email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Customer phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone ?? '' }}"
                                placeholder="Enter customer phone" value="{{ old('phone') }}" required>
                            @if ($errors->has('phone'))
                                <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Select status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="block" {{ $user->status == 'block' ? 'selected' : '' }}>Block</option>
                                <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="support" {{ $user->status == 'support' ? 'selected' : '' }}>Support</option>
                            </select>
                        </div>
                    </div>
                    <div class="az-content-label mg-b-5 mg-t-30">Address Detail</div>
                    <p class="mg-b-10">Using this form you can add customer address </p>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Customer city <span class="text-danger">*</span></label>
                            <select class="form-control" name="city_id" id="select-city">
                                @if ($cities->isNotEmpty())
                                    @foreach ($cities as $item)
                                        <option value="{{ $item->id ?? '' }}"
                                            {{ !is_null($user->customer) && $item->id == $user->customer->city_id ? 'selected' : '' }}>
                                            {{ $item->title ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('city_id'))
                                <span class="text-danger text-left">{{ $errors->first('city_id') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Customer area <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="select2" name="area_id" id="area_id" id="select-area">
                                @if ($areas->isNotEmpty())
                                    @foreach ($areas as $item)
                                        <option value="{{ $item->id ?? '' }}"
                                            {{ !is_null($user->customer) && $item->id == $user->customer->area_id ? 'selected' : '' }}>
                                            {{ $item->title ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('area_id'))
                                <span class="text-danger text-left">{{ $errors->first('area_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Street Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address"
                                value="{{ $user->customer->address ?? '' }}" placeholder="Enter Street Address"
                                value="{{ old('address') }}" required>
                            @if ($errors->has('address'))
                                <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2"></div>
                    </div>
                    <div class="az-content-label mg-b-5 mg-t-30">Customer Verification</div>
                    <p class="mg-b-10">Using this form you can Verify customer details </p>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>ID Card Front Side</label>
                            <input type="file" class="form-control" name="id_card_front_side">
                            @if (!empty($user->customerVerification->id_card_front_side))
                                <img src="{{ asset($user->customerVerification->id_card_front_side) }}" width="100"
                                    height="100">
                            @endif
                            @if ($errors->has('id_card_front_side'))
                                <span class="text-danger text-left">{{ $errors->first('id_card_front_side') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>ID Card Back Side</label>
                            <input type="file" class="form-control" name="id_card_back_side">
                            @if (!empty($user->customerVerification->id_card_back_side))
                                <img src="{{ asset($user->customerVerification->id_card_back_side) }}" width="100"
                                    height="100">
                            @endif
                            @if ($errors->has('id_card_back_side'))
                                <span class="text-danger text-left">{{ $errors->first('id_card_back_side') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Selfie with Customer</label>
                            <input type="file" class="form-control" name="selfie_with_customer">
                            @if (!empty($user->customerVerification->selfie_with_customer))
                                <img src="{{ asset($user->customerVerification->selfie_with_customer) }}" width="100"
                                    height="100">
                            @endif
                            @if ($errors->has('selfie_with_customer'))
                                <span class="text-danger text-left">{{ $errors->first('selfie_with_customer') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Address Found</label>
                            <select class="form-control" name="address_found">
                                <option value="0"
                                    {{ !empty($user->customerVerification->address_found) && $user->customerVerification->address_found == '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ !empty($user->customerVerification->address_found) && $user->customerVerification->address_found == '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            @if ($errors->has('address_found'))
                                <span class="text-danger text-left">{{ $errors->first('address_found') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>House</label>
                            <select class="form-control" name="house">
                                <option value="rent"
                                    {{ !empty($user->customerVerification->house) && $user->customerVerification->house == 'rent' ? 'selected' : '' }}>
                                    Rent</option>
                                <option value="self"
                                    {{ !empty($user->customerVerification->house) && $user->customerVerification->house == 'self' ? 'selected' : '' }}>
                                    Self</option>
                            </select>
                            @if ($errors->has('house'))
                                <span class="text-danger text-left">{{ $errors->first('house') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Customer Physical Meet</label>
                            <select class="form-control" name="customer_physical_meet">
                                <option value="0"
                                    {{ !empty($user->customerVerification->customer_physical_meet) && $user->customerVerification->customer_physical_meet == '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ !empty($user->customerVerification->customer_physical_meet) && $user->customerVerification->customer_physical_meet == '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            @if ($errors->has('customer_physical_meet'))
                                <span class="text-danger text-left">{{ $errors->first('customer_physical_meet') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Work</label>
                            <select class="form-control" name="work">
                                <option value="job"
                                    {{ !empty($user->customerVerification->work) && $user->customerVerification->work == 'job' ? 'selected' : '' }}>
                                    Job</option>
                                <option value="bussiness"
                                    {{ !empty($user->customerVerification->work) && $user->customerVerification->work == 'bussiness' ? 'selected' : '' }}>
                                    Bussiness</option>
                            </select>
                            @if ($errors->has('work'))
                                <span class="text-danger text-left">{{ $errors->first('work') }}</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update customer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
