<!-- Start Page Banner Area -->
<div class="page-banner-area pt-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="single-page-banner-content">
                    <h1>About Us</h1>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>About Us</li>
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

<!---------------- About section start ----------------->

@include('frontend.layouts.pages.home.about')

<!---------------- About section end ----------------->

<!---------------- Review/Testimonial section start ----------------->

@include('frontend.layouts.pages.review.index')

<!---------------- Review/Testimonial section end ----------------->

<!---------------- CTA section start ----------------->

@include('frontend.layouts.pages.home.cta')

<!---------------- CTA section end ----------------->

<!---------------- Team section start ----------------->

@include('frontend.layouts.pages.team.index')

<!---------------- Team section end ----------------->

<!---------------- Newsletter section start ----------------->

@include('frontend.layouts.pages.home.newsletter')

<!---------------- Newsletter section end ----------------->
