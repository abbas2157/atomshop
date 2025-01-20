@extends('dashboards.admin.layout.app')
@section('title')
    <title>Categories - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/components/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Product Management</span>
                <span>Products</span>
                <span>Create</span>
            </div>
            <h2 class="az-content-title">Products</h2>
            <div class="az-content-label mg-b-5">Create new</div>
            <p class="mg-b-20">Using this form you can add new product</p>
            <div id="wizard2">
                <h3>Personal Information</h3>
                <section>
                  <p class="mg-b-20">Try the keyboard navigation by clicking arrow left or right!</p>
    
                  <div class="row row-sm">
                    <div class="col-md-5 col-lg-4">
                      <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                      <input id="firstname" class="form-control" name="firstname" placeholder="Enter firstname" type="text" required>
                    </div><!-- col -->
                    <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                      <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                      <input id="lastname" class="form-control" name="lastname" placeholder="Enter lastname" type="text" required>
                    </div><!-- col -->
                  </div><!-- row -->
                </section>
                <h3>Billing Information</h3>
                <section>
                  <p>Wonderful transition effects.</p>
                  <div class="form-group wd-xs-300">
                    <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                    <input id="email" class="form-control" name="email" placeholder="Enter email address" type="email" required>
                  </div><!-- form-group -->
                </section>
                <h3>Payment Details</h3>
                <section>
                  <p>The next and previous buttons help you to navigate through your content.</p>
                </section>
              </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{!! asset('assets/lib/jquery-steps/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('assets/lib/parsleyjs/parsley.min.js') !!}"></script>
<script>
    $(function(){
        'use strict'

        $('#wizard1').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
        });

        $('#wizard2').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
          onStepChanging: function (event, currentIndex, newIndex) {
            if(currentIndex < newIndex) {
              // Step 1 form validation
              if(currentIndex === 0) {
                var fname = $('#firstname').parsley();
                var lname = $('#lastname').parsley();

                if(fname.isValid() && lname.isValid()) {
                  return true;
                } else {
                  fname.validate();
                  lname.validate();
                }
              }

              // Step 2 form validation
              if(currentIndex === 1) {
                var email = $('#email').parsley();
                if(email.isValid()) {
                  return true;
                } else { email.validate(); }
              }
            // Always allow step back to the previous step even if the current step is not valid.
            } else { return true; }
          }
        });

        $('#wizard3').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
          stepsOrientation: 1
        });
      });
</script>
@endsection