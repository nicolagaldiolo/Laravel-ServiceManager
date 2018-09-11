@extends('layouts.error')

@section('content')
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid  m-error-6" style="background-image: url({{ asset('images/error/bg6.jpg')}});">
            <div class="m-error_container">
                <div class="m-error_subtitle m--font-light">
                    <h1>{{__('messages.error_404_title')}}</h1>
                </div>
                <p class="m-error_description m--font-light">{{__('messages.error_404_desc')}}</p>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
@stop
