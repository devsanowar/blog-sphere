<!-- Start Banner Three Area -->
<div class="banner-three-area">
    <div class="banner-three-slider owl-carousel owl-theme">

        @foreach($sliders as $slider)
            <div class="single-banner-three-item"
                 style="background-image: url({{ $slider->image }});
                          background-size: cover;
                          background-repeat: no-repeat;
                          background-position: center center;">
                <div class="container-fluid">
                    <div class="banner-three-content">
                        <span><i class="flaticon-flash"></i>{{ $slider->slider_title }}</span>
                        <h1>
                            {{ $slider->slider_sub_title }}
                            <img
                                src="{{ asset('frontend/assets/images/banner/banner-three-light-img.png') }}"
                                alt="images"
                            />
                        </h1>
                        <p>
                            {{ $slider->slider_description }}
                        </p>
                        <a href="#pricing-plan" class="default-btn btn-style-fore"
                        >Our Best Offers</a
                        >
                    </div>
                </div>
                <div class="scroll-bar-icon">
                    <a href="#about"><i class="flaticon-scroll-bar"></i></a>
                </div>
            </div>
        @endforeach

    </div>
    <div class="banner-three-shape-1">
        <img src="{{ asset('frontend/assets/images/banner/banner-threebg-shape.png') }}" alt="images" />
    </div>
</div>
<!-- End Banner Three Area -->
