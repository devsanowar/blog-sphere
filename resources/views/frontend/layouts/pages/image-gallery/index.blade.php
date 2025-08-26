<style>
    .image-modal {
        display: none;
        position: fixed;
        z-index: 10000;
        padding-top: 60px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.9);
        text-align: center;
    }

    .image-modal img {
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 80%;
    }

    .image-modal .close-btn {
        position: absolute;
        top: 30px;
        right: 35px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    .nav-buttons {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 30px;
    }

    .nav-buttons .prev,
    .nav-buttons .next {
        color: white;
        font-size: 40px;
        cursor: pointer;
        user-select: none;
    }
</style>


<!-- Start Page Banner Area -->
<div class="page-banner-area pt-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="single-page-banner-content">
                    <h1>Gallery</h1>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>Gallery</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-page-banner-img">
                    <img src="{{ asset('frontend/assets/images/page-banner-img.png') }}" alt="images" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner Area -->

<section class="gallery-section py-5 bg-light" id="gallery">
    <div class="container">

        <div class="section-title" data-aos="fade-up">
            <div class="d-flex align-items-center justify-content-center gap-1">
                <div>
                    <img
                        src="{{ asset('frontend/assets/images/section-title.png') }}"
                        class="img-fluid"
                        width="100"
                        alt=""
                    />
                </div>
                <div class="section-title">
                    <span class="top-title top-title-two">Our gallery</span>
                    <h2>Image gallery</h2>
                </div>
            </div>
        </div>

        <div class="row g-4 gallery-grid">
            @foreach($imageGalleries as $gallery)
            <div class="col-sm-6 col-lg-4">
                <div class="gallery-item">
                    <img
                        src="{{ asset($gallery->image) }}"
                        alt="Gallery 2"
                    />
                    <div class="overlay" data-index="1">
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const galleryItems = document.querySelectorAll('.gallery-item img');
        const modal = document.getElementById('imageModal');
        const popupImage = document.getElementById('popupImage');
        const closeBtn = document.getElementById('closeBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let currentIndex = 0;
        const imageSrcs = [];

        // Populate image source list
        galleryItems.forEach(img => {
            imageSrcs.push(img.getAttribute('src'));
        });

        function showImage(index) {
            if (index >= 0 && index < imageSrcs.length) {
                popupImage.setAttribute('src', imageSrcs[index]);
                currentIndex = index;
            }
        }

        // Open modal on click
        galleryItems.forEach((img, index) => {
            img.addEventListener('click', () => {
                showImage(index);
                modal.style.display = 'block';
            });

            const overlay = img.closest('.gallery-item').querySelector('.overlay');
            overlay?.addEventListener('click', () => {
                showImage(index);
                modal.style.display = 'block';
            });
        });

        // Close modal
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Prev/Next navigation
        prevBtn.addEventListener('click', () => {
            let newIndex = currentIndex - 1;
            if (newIndex < 0) newIndex = imageSrcs.length - 1;
            showImage(newIndex);
        });

        nextBtn.addEventListener('click', () => {
            let newIndex = currentIndex + 1;
            if (newIndex >= imageSrcs.length) newIndex = 0;
            showImage(newIndex);
        });
    });
</script>

