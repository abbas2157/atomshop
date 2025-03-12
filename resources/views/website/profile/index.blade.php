@extends('website.layout.app')
@section('title')
    <title>My Profile | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="About | Atomshop - Pay in steps">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <span class="breadcrumb-item active">My Profile</span>
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
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Change Information</span></h5>
            @if(is_null(Auth::user()->customer) || Auth::user()->customer->verified == '0')
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Note !</strong> Get verified yourself immediately. Our agent will visite you soon.
                </div>
            @endif
            <div class="bg-light px-4 py-2 mb-30">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->uuid ?? '' }}" name="user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ Auth::user()->name ?? '' }}" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->email ?? '' }}" readonly required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone" value="{{ Auth::user()->phone ?? '' }}" required>
                                @if ($errors->has('phone'))
                                    <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">City</label>
                                <select class="custom-select" name="city_id" id="city_id" required>
                                    @if($cities->isNotEmpty())
                                        @foreach($cities as $item)
                                            <option value="{{ $item->id ?? '' }}" {{ (!is_null(Auth::user()->customer) && Auth::user()->customer->city_id == $item->id) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                                        @endforeach
                                    @else
                                        <option value="0">No City Found</option>
                                    @endif
                                </select>
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Area</label>
                                <select class="custom-select select2" id="select2" name="area_id" id="area_id" required>
                                    @if($areas->isNotEmpty())
                                        @foreach($areas as $item)
                                            <option value="{{ $item->id ?? '' }}" {{ (!is_null(Auth::user()->customer) && Auth::user()->customer->area_id == $item->id) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                                        @endforeach
                                    @else
                                        <option value="0">No Area Found</option>
                                    @endif
                                </select>
                                @if ($errors->has('area_id'))
                                    <span class="text-danger text-left">{{ $errors->first('area_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="123 Street" value="{{ (!is_null(Auth::user()->customer)) ? Auth::user()->customer->address : '' }}" required>
                                @if ($errors->has('address'))
                                    <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary mb-3">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    $(document).ready(function () {
        @if ($errors->has('success'))
            Toastify({
                text: "<i class='fas fa-check-circle'></i> <b> Success </b> ! {{ $errors->first('success') }}",
                duration: 3000,
                gravity: "top",
                position: "right",
                escapeMarkup: false,
                backgroundColor: "linear-gradient(to right, #FFD333, #3D464D)",
            }).showToast();
        @endif
        @if ($errors->has('error'))
            Toastify({
                text: "<i class='fas fa-check-circle'></i> <b> Error </b> ! {{ $errors->first('error') }}",
                duration: 3000,
                gravity: "top",
                position: "right",
                escapeMarkup: false,
                backgroundColor: "linear-gradient(to right, #FF0000, #000000)",
            }).showToast();
        @endif
        $('#city_id').on('change', function(){
            var city_id = $(this).val();
            $('#area_id').html('');
            $.ajax({
                url: API_URL + "/areas/"+city_id,
                type: "GET",
                data: {city_id : city_id},
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success == true) {
                        var brands = response.data;
                        if(brands.length > 0) {
                            brands.forEach(function(item) {
                                $('#area_id').append('<option value="'+item.id+'">'+item.title+'</option>');
                            });
                        }
                        else  {
                            $('#area_id').append('<option value="0">No Area Found</option>');
                        }
                    }
                    else  {
                        $('#area_id').append('<option value="0">No Area Found</option>');
                    }
                }
            });
        });
    });
</script>
@endsection
