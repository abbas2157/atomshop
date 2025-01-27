@extends('dashboards.admin.layout.app')
@section('title')
    <title>Website Settings - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/web-app/website.partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Website & App</span>
                <span>Website</span>
            </div>
            <h2 class="az-content-title">Website</h2>
            <div class="az-content-label mg-b-5">Home Page</div>
            <p class="mg-b-20">All Home section will be edit from here</p>
            <div class="az-content-label mg-b-5">Home Page Categories</div>
            <div class="board-wrapper pt-2">
                <div class="board-portlet">
                  <ul id="portlet-card-list-1" class="portlet-card-list">
                    @foreach($categories as $item)
                        <li class="portlet-card">
                            <p class="task-date">{{ $item->created_at->format('M d, Y') ?? '' }}</p>
                            <h4 class="task-title">{{ $item->title ?? '' }}</h4>
                            <div class="image-grouped">
                                <img src="{{ $item->category_picture ?? '' }}" alt="profile image">
                            </div>
                        </li>
                    @endforeach
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function(){
      'use strict'

      $('#checkAll').on('click', function(){
        if($(this).is(':checked')) {
          $('.az-mail-list .ckbox input').each(function(){
            $(this).closest('.az-mail-item').addClass('selected');
            $(this).attr('checked', true);
          });

          $('.az-mail-options .btn:not(:first-child)').removeClass('disabled');
        } else {
          $('.az-mail-list .ckbox input').each(function(){
            $(this).closest('.az-mail-item').removeClass('selected');
            $(this).attr('checked', false);
          });

          $('.az-mail-options .btn:not(:first-child)').addClass('disabled');
        }
      });

      $('.az-mail-item .az-mail-checkbox input').on('click', function(){
        if($(this).is(':checked')) {
          $(this).attr('checked', false);
          $(this).closest('.az-mail-item').addClass('selected');

          $('.az-mail-options .btn:not(:first-child)').removeClass('disabled');

        } else {
          $(this).attr('checked', true);
          $(this).closest('.az-mail-item').removeClass('selected');

          if(!$('.az-mail-list .selected').length) {
            $('.az-mail-options .btn:not(:first-child)').addClass('disabled');
          }
        }
      });

      $('.az-mail-star').on('click', function(e){
        $(this).toggleClass('active');
      });

      $('#btnCompose').on('click', function(e){
        e.preventDefault();
        $('.az-mail-compose').show();
      });

      $('.az-mail-compose-header a:first-child').on('click', function(e){
        e.preventDefault();
        $('.az-mail-compose').toggleClass('az-mail-compose-minimize');
      })

      $('.az-mail-compose-header a:nth-child(2)').on('click', function(e){
        e.preventDefault();
        $(this).find('.fas').toggleClass('fa-compress');
        $(this).find('.fas').toggleClass('fa-expand');
        $('.az-mail-compose').toggleClass('az-mail-compose-compress');
        $('.az-mail-compose').removeClass('az-mail-compose-minimize');
      });

      $('.az-mail-compose-header a:last-child').on('click', function(e){
        e.preventDefault();
        $('.az-mail-compose').hide(100);
        $('.az-mail-compose').removeClass('az-mail-compose-minimize');
      });


    });
  </script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <script>
    $(function()
    {
      $("#portlet-card-list-1, #portlet-card-list-2, #portlet-card-list-3").sortable(
      {
        connectWith: "#portlet-card-list-1, #portlet-card-list-2, #portlet-card-list-3",
        items: ".portlet-card"
      });
    });
  </script>

@endsection