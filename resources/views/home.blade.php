@extends('layouts.app')
@section('extra_style')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading red"><i class="fa fa-f fa-film fa-3x"></i></div></a>
                    <div class="circle-tile-content red">
                    <div class="circle-tile-description text-faded"> Movies </div>
                    <div class="circle-tile-number text-faded ">{{ $movie }}</div>
                    <a class="circle-tile-footer" href="{{ URL::route('movies') }}">More Info<i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading blue"><i class="fa fa-f fa-film fa-3x"></i></div></a>
                    <div class="circle-tile-content blue">
                    <div class="circle-tile-description text-faded"> Cinema </div>
                    <div class="circle-tile-number text-faded ">{{ $cinema }}</div>
                    <a class="circle-tile-footer" href="{{ URL::route('cinema') }}">More Info<i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading green"><i class="fa fa fa-calendar fa-fw fa-3x"></i></div></a>
                    <div class="circle-tile-content green">
                    <div class="circle-tile-description text-faded"> Showtime</div>
                    <div class="circle-tile-number text-faded ">{{ $showtime }}</div>
                    <a class="circle-tile-footer" href="{{ URL::route('showtime') }}">More Info<i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
