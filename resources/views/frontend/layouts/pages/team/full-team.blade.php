@extends('frontend.layouts.app')

@section('body')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area pt-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="single-page-banner-content">
                        <h1>Our Team</h1>
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>Team</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-page-banner-img">
                        <img src="{{ asset('frontend/assets/images/page-banner-img.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!---------------- Team section start ----------------->

    @include('frontend.layouts.pages.team.index')

    <!---------------- Team section end ----------------->

@endsection
