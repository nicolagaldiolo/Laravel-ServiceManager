@extends('layouts.error')

@section('content')
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-error-4" style="background-image: url({{ asset('images/error/bg4.jpg')}});">
            <div class="m-error_container">
                <h1 class="m-error_number">
                    403
                </h1>
                <p class="m-error_title">
                    ERROR
                </p>
                <p class="m-error_description">
                    Nothing left to do here.
                </p>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
@stop
