<!-- start Our Testimonial Area -->
<div class="testimonial-three-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="testimonial-three-video-play-content">
                    <div class="section-title section-title-left">
                <span class="top-title top-title-three"
                ><i class="flaticon-flash"></i>WATCH VIDEO</span
                >
                        <h2>Our Successful Projects</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                            eiusmod temp incididunt ut labore et dolore magn amet.
                        </p>
                    </div>
                    <div class="video-play">
                        <a
                            href="{{ $videoGallery->video_url }}"
                            class="popup-youtube"
                        >
                            <i class="bx bx-play"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-three-card">
                    <div class="section-title section-title-left">
                <span class="top-title top-title-three"
                ><i class="flaticon-flash"></i> OUR TESTIMONIAL</span
                >
                        <h2>Customer Reviews</h2>
                    </div>
                    <div class="testimonial-three-slider owl-carousel owl-theme">
                        @foreach($reviews as $review)
                        <div class="testimonial-three-slider-content">
                            <p style="text-align: justify">
                                {{ $review->review }}
                            </p>
                            <div class="anthony-item">
                                <img
                                    src="{{ asset($review->image) }}"
                                    alt="images"
                                />
                                <h3>{{ $review->name }}</h3>
                                <p>{{ $review->profession }}</p>
                            </div>
                            <div class="quote-icon">
                                <i class="flaticon-quote"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Our Testimonial Area -->

<script>
    $(document).ready(function () {
        $('.popup-youtube').magnificPopup({
            type: 'iframe',
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                    }
                }
            }
        });
    });
</script>
