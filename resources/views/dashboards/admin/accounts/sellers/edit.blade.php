@extends('dashboards.admin.layout.app')
@section('title')
    <title>Sellers - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/accounts/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Accounts Management</span>
                <span>Sellers</span>
                <span>Edit</span>
            </div>
            <h2 class="az-content-title">Sellers</h2>
            <div class="az-content-label mg-b-5">Product Sellers Information</div>
            <p class="mg-b-20">Using this form you can edit Seller </p>
            <form id="product-form-name" method="POST" action="{{ route('admin.sellers.update', $seller->id) }}" enctype="multipart/form-data">
                @csrf
                <div id="product-form">
                    <h3>Sellers Information</h3>
                    @include('dashboards/admin/accounts/sellers/edit-partials/personal-information')
                    <h3>Business Address</h3>
                    @include('dashboards/admin/accounts/sellers/edit-partials/business-address')
                    <h3>Business Details</h3>
                    @include('dashboards/admin/accounts/sellers/edit-partials/product-details')
                    <h3>Publish Sellers</h3>
                    <section>
                        <p>The next and previous buttons help you to navigate through your content.</p>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label>Seller is verified ? <span class="text-danger">*</span></label>
                                <select class="form-control" name="verified">
                                    <option value="1" {{ old('verified', $seller->verified ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('verified', $seller->verified ?? '') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="col-lg mt-2"></div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{!! asset('assets/lib/jquery-steps/jquery.steps.min.js') !!}"></script>
    <script src="{!! asset('assets/lib/parsleyjs/parsley.min.js') !!}"></script>
    <script>
        $(function() {
            'use strict';
            $('#product-form').steps({
                headerTag: 'h3',
                bodyTag: 'section',
                autoFocus: true,
                titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                labels: {
                    finish: "Publish Sellers",
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    if (currentIndex < newIndex) {
                        if (currentIndex === 0) {
                            var business_name = $('#business_name').parsley();
                            var name = $('#name').parsley();
                            var cnic_number = $('#cnic_number').parsley();
                            var email = $('#email').parsley();
                            var phone = $('#phone').parsley();
                            if (business_name.isValid() && name.isValid() && cnic_number.isValid() && email.isValid() && phone.isValid()) {
                                return true;
                            } 
                            else {
                                business_name.validate();
                                Sellers_name.validate();
                                cnic_number.validate();
                                email.validate();
                                phone.validate();
                            }
                        } 
                        else if (currentIndex === 1) {
                            var area_id = $('#area_id').parsley();
                            var city_id = $('#city_id').parsley();
                            var business_address = $('#business_address').parsley();
                            if (city_id.isValid() && area_id.isValid() && business_address.isValid()) {
                                return true;
                            } 
                            else {
                                area_id.validate();
                                city_id.validate();
                                business_address.validate();
                            }
                        }
                        else if (currentIndex === 2) {
                            return true;
                            var picture = $('#picture').parsley();
                            if (picture.isValid()) {
                                return true;
                            } 
                            else {
                                picture.validate();
                            }
                        }
                    } 
                    else {
                        return true;
                    }
                },
                onFinishing: function (event, currentIndex) {
                    console.log('Finishing... Current Index:', currentIndex);
                    var formData = new FormData(document.getElementById('product-form-name'));
                    $.ajax({
                        url: "{{ route('admin.sellers.update', $seller->id) }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'X-HTTP-Method-Override': 'PUT'
                        },

                        success: function (response) {
                            console.log(response);
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            alert('An error occurred. Please try again.');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
            
            // Add Parsley.js validations to form fields
            $('#title').attr('data-parsley-required', 'true');
            $('#category_id').attr('data-parsley-required', 'true');
            $('#brand_id').attr('data-parsley-required', 'true');
            $('#memory_id').attr('data-parsley-required', 'true');
            $('#color_id').attr('data-parsley-required', 'true');
            $('#status').attr('data-parsley-required', 'true');

            // File upload validation
            $('#customFile').attr('data-parsley-required', 'true');

            // Initialize Parsley on the form
            $('#product-form form').parsley();

            $('.az-toggle').on('click', function(){
                $(this).toggleClass('on');
            })
        });
    </script>
@endsection