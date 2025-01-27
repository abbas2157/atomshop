<div class="az-footer ht-40">
    <div class="container ht-100p pd-t-0-f">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © atomshop.pk {{ date('Y') }}</span>
    </div>
</div>

@if ($errors->has('success'))
    <div class="demo-static-toast toaster-style" >
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small id="toast-time"></small>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> --}}
            </div>
            <div class="toast-body">
                {{ $errors->first('success') }}
            </div>
        </div>
    </div>
@endif

@if ($errors->has('error'))
    <div class="demo-static-toast toaster-style" >
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small id="toast-time"></small>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> --}}
            </div>
            <div class="toast-body">
                {{ $errors->first('error') }}
            </div>
        </div>
    </div>
@endif