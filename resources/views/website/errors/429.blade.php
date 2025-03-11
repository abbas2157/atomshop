@extends('website.layout.app')
@section('title')
    <title>Too Many Requests - Atomshop - Pay in steps</title>
    <meta content="Atomshop - Pay in steps" name="description">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
<div class="container error-body d-flex justify-content-center align-items-center error-container">
    <div class="error-box text-center">
        <h1 class="error-title">429</h1>
        <p class="error-text">Oops! Too Many Requests.</p>
        <p class="error-text">You are making too many requests. Please slow down !</p>
    </div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{!! asset('web/js/login.js') !!}"></script>
@endsection
