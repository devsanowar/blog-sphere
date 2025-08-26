<!-- Start Page Banner Area -->
<div class="page-banner-area pt-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="single-page-banner-content">
                    <h1>Career</h1>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>Career</li>
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

<!-- career -->

<!-- Benefits Section -->
<section class="container my-5">
    <h2 class="mb-5 text-center">Why Work With Us?</h2>
    <div class="row text-center" style="margin-top: 100px">
        <div class="col-md-4">
            <div class="career-card">
                <h5>🌐 Flexible Work</h5>
                <p>Remote-friendly culture and flexible hours.</p>
            </div>
        </div>
        <div class="col-md-4">
            <h5>🚀 Career Growth</h5>
            <p>Opportunities to grow, learn, and lead.</p>
        </div>
        <div class="col-md-4">
            <h5>💼 Great Benefits</h5>
            <p>Health insurance, paid leaves, and more.</p>
        </div>
    </div>
</section>

<!-- Job Listings -->
<section class="container my-5">
    <h2 class="mb-4 text-center">Current Openings</h2>
    @foreach($careers as $career)
    <div class="job-card" style="margin-top: 40px">
        <h4 style="margin-bottom: 15px">{{ $career->job_title }}</h4>
        <p style="margin-bottom: 15px">
            <strong>Location:</strong> {{ $career->location }} | <strong>Type:</strong> {{ $career->job_type }} | <strong>Salary:</strong> {{ $career->salary }}
        </p>
        <p style="margin-bottom: 15px">
            {!! $career->description !!}
        </p>
        <a href="{{ route('career-detail', $career->id) }}" class="btn apply-btn">Job Detail</a>
    </div>
    @endforeach
</section>
