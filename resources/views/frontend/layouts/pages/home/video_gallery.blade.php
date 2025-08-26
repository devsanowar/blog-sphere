<!-- ==================== Video Section Start ==================== -->
<!-- ==================== Video Section ==================== -->
<section class="video-section py-5" data-aos="fade-up"
         style="background-image: url('{{ asset('frontend') }}/assets/images/dot-grid.webp');">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <div class="d-flex align-items-center justify-content-center gap-1">
                <div>
                    <img
                        src="{{ asset('frontend') }}/assets/images/section-title.png"
                        class="img-fluid"
                        width="100"
                        alt=""
                    />
                </div>
                <div>
                    <h2 class="ps-4">
                        Watch <br />
                        <span class="section-span-text">Our Work</span>
                    </h2>
                </div>
            </div>
            <p>Experience Quality in Motion</p>
        </div>

        <div
            class="video-thumbnail mx-auto"
            data-bs-toggle="modal"
            data-bs-target="#videoModal1"
            data-aos="zoom-in"
        >
            @foreach($videoGalleries as $videoGallery)
                <img src="{{ asset($videoGallery->image) }}" alt="Watch our video" />
            @endforeach

            <div class="video-overlay"></div>
            <div class="video-play-btn ripple">
                <i class="fas fa-play"></i>
            </div>
        </div>
    </div>
</section>

<!-- ==================== Video Modal ==================== -->
<div
    class="modal fade video-modal"
    id="videoModal1"
    tabindex="-1"
    aria-labelledby="videoModalLabel"
    aria-hidden="true"
    data-video-url="https://www.youtube.com/embed/NWHU8wKrhok?si=xmnG0vZKztiy2F5z"
>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content position-relative">
            <button
                type="button"
                class="btn-close-custom"
                data-bs-dismiss="modal"
                aria-label="Close"
            >
                <i class="fas fa-times"></i>
            </button>
            <div class="ratio ratio-16x9">
                <iframe
                    src=""
                    title="YouTube video"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
</div>

<!-- ==================== Video Modal ==================== -->
<!-- ==================== Video Section End ==================== -->
