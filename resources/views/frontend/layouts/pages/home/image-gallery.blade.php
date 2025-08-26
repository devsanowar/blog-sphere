
<!-- ==================== Image Gallery Section Start ==================== -->
<section class="gallery-section py-5 bg-light" id="gallery"
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
                        Image <br />
                        <span class="section-span-text">Gallery</span>
                    </h2>
                </div>
            </div>
            <p>Our Work in Focus</p>
        </div>

        <div class="row g-4 gallery-grid">

            @foreach($imageGalleries as $index => $imageGallery)
                <div class="col-sm-6 col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset($imageGallery->image) }}" alt="Gallery image {{ $index + 1 }}" />
                        <div class="overlay" data-index="{{ $index }}">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Custom Popup Modal -->
<div class="image-modal" id="imageModal">
    <span class="close-btn" id="closeBtn">&times;</span>
    <img id="popupImage" />
    <div class="nav-buttons">
        <span class="prev" id="prevBtn">&#10094;</span>
        <span class="next" id="nextBtn">&#10095;</span>
    </div>

</div>
<!-- ==================== Image Gallery Section End ==================== -->
<script>
    const images = @json($imageGalleries->map(fn($img) => asset($img->image)));
</script>
