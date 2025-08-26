<!-- Start Newsletter Three area -->
<div class="newsletter-three-area pb-100">
    <div class="container">
        <div class="newsletter-three-card-item">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div
                        class="newsletter-three-image"
                    >
                        <img
                            src="{{ asset('frontend/assets/images/newsletter-three-image.png') }}"
                            alt="images"
                        />
                        <div class="newsletter-two-shape-bgs15">
                            <img
                                src="{{ asset('frontend/assets/images/newsletter-three-shape.png') }}"
                                alt="images"
                            />
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div
                        class="single-newsletter-content newsletter-two-content newsletter-three-content"
                    >
                        <div class="section-title section-title-left">
                  <span class="top-title top-title-three"
                  ><i class="flaticon-flash"></i>OUR NEWSLETTER</span
                  >
                            <h2>Subscribe Newsletter</h2>

                        </div>
                        <div class="subscribe-from">
                            <form action="{{ route('subscribe') }}" method="POST" class="newsletter-form1">
                                @csrf
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                <button type="submit" class="default-btn btn-style-three">Subscribe Now</button>
                            </form>

                        @if(session('message'))
                                <div style="color: green;">{{ session('message') }}</div>
                            @endif

                            @if($errors->any())
                                <div style="color: red;">{{ $errors->first() }}</div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Newsletter Two area -->
