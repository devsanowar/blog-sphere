<!--services-section-->
<section class="ttm-row services-section ttm-bgcolor-grey clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="padding_top75 res-991-padding_top0"></div>
                <!-- section title -->
                <div class="section-title title-style-center_text">
                    <div class="title-header">
                        <h3>BUSINESS GROW</h3>
                        <h2 class="title">
                            Your Business <b>Grow & Successful </b>
                        </h2>
                    </div>
                </div>
                <!-- section title end -->
            </div>
        </div>
        <!-- row -->
        <div
            class="row slick_slider mb_15"
            data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "arrows":false, "autoplay":false, "dots":false, "infinite":true, "responsive":[{"breakpoint":992,"settings":{"slidesToShow": 2}},{"breakpoint":840,"settings":{"slidesToShow": 2}},{"breakpoint":650,"settings":{"slidesToShow": 1}}]}'
        >
            @foreach($services as $service)
                <div class="col-md-4 col-sm-6">
                    <!--featured-imagebox-->
                    <div
                        class="featured-imagebox featured-imagebox-services style1"
                    >
                        <!-- featured-thumbnail -->
                        <div class="featured-thumbnail">
                            <a href="{{ route('service-detail', $service->id) }}">
                                <img
                                    class="img-fluid"
                                    src="{{ asset($service->image) }}"
                                    alt="image"
                                />
                            </a>
                        </div>
                        <!-- featured-thumbnail end-->
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3>
                                    <a href="{{ route('service-detail', $service->id) }}">{{ $service->service_title }}</a>
                                </h3>
                                <div class="ttm-details-link">
                                    <a href="{{ route('service-detail', $service->id) }}"
                                    ><i class="themifyicon ti-arrow-top-right"></i
                                        ></a>
                                </div>
                            </div>
                            <div class="featured-desc" style="text-align: justify">
                                <p>
                                    {!! Str::words($service->description, 12, '...') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- featured-imagebox end-->
                </div>
            @endforeach

        </div>
        <!-- row end -->
    </div>
</section>
<!--services-section end -->
