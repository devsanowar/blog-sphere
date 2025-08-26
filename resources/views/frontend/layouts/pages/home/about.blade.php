<!-- start About Us Three Area -->
<div id="about" class="about-us-three-area pt-100 pb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-cue="slideInLeft" data-duration="1500">
                <div class="single-about-us-three-img">
                    <img
                        src="{{ asset($about->image) }}"
                        alt="images"/>
                    <div class="about-three-shape1">
                        <img
                            src="{{ asset('frontend/assets/images/about/about-three-shape1.png') }}"
                            alt="images"
                        />
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-cue="slideInRight" data-duration="1500">
                <div class="single-about-us-three-content">
                    <div class="section-title section-title-left">
                        <span class="top-title top-title-three">
                            <i class="flaticon-flash"></i>ABOUT US</span>
                        <h2>{{ $about->about_title }}</h2>
                        <p>
                            {!! $about->description !!}
                        </p>
                    </div>
                    <div class="about-three-list">
                        <ul>
                            @foreach($features as $feature)
                            <li>
                                <img
                                    src="{{ asset('frontend/assets/images/about/about-three-icon.svg') }}"
                                    alt="images"
                                />
                                {{ $feature->feature_title }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="about-three-btn">
                        <a
                            href="{{ route('about') }}"
                            class="default-btn btn-style-fore"
                        >Learn More</a
                        >
                        <div class="need-help">
                            <i class="flaticon-phone-with-wire"></i>
                            <p>Need Help ? Contact Number</p>
                            <a href="tel:(808)555-0111">{{ $website_setting->phone }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About Us Three Area -->
