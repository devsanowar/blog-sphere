<style>
    css


    .custom-input2 {
        background: #e7f0f9;
        border-radius: 5px;
        padding: 18px;
        border: none;
        margin-bottom: 20px;
        font-family: var(--bodyFontFamily);
        font-weight: 400;
        color: var(--bodyColor);
        font-size: 16px;
    }

    #apply {
        padding: 100px 0;
    }
    .custom-input2:focus {
        outline: none;
        box-shadow: none;
        background: #e7f0f9;
        border-color: #ccc; /* optional: maintain a subtle border */
    }
    .label-area {
        font-size: 18px;
        /* font-style: inherit; */
        padding: 13px 0;
        font-weight: normal;
    }

    .apply-btn {
        background-color: #0d6efd;
        color: white;
    }

    .apply-btn:hover {
        background-color: #084298;
    }

    .apply-area {
        display: flex;
        justify-content: space-between;
        /* padding: 38px 0; */
        padding-bottom: 50px;
    }
    .apply {
        padding: 11px 32px;
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        border-top-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>

<!-- Start Page Banner Area -->
<div class="page-banner-area pt-100" style="background-color: white">
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
                    <img src="{{asset('frontend/assets/images/Career.jpg')}}" alt="images" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner Area -->

<!-- career -->

<!-- Hero Section -->

<!-- Apply Form -->

<section class="bg-light pb-3" id="apply">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="container">
                    <!-- Header -->
                    <h5 class="text-center text-success pb-5">{{ session('message') }}</h5>
                    <div class="apply-area">

                        <div>
                            <h5 style="margin-bottom: 15px">{{ $career->job_title }}</h5>
                            <p class="text-muted" style="font-size: 18px">
                                Location: {{ $career->location }} | Type: {{ $career->job_type }}
                            </p>
                        </div>
                        <div>
                            <button class="apply" type="button" id="show-apply-form">Apply Now</button>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div>
                        @php
                            $fields = [
                                'Job Description' => $career->description,
                                'Responsibilities' => $career->responsibilities,
                                'Others Requirements' => $career->others_requirements,
                                'Educational Requirements' => $career->educational_requirements,
                                'Experience Requirements' => $career->experience_requirements,
                            ];
                        @endphp

                        @foreach($fields as $label => $content)
                            @php
                                $text = trim(strip_tags($content));
                            @endphp

                            @if($text !== '')
                                <h5 style="margin-bottom: 15px; margin-top: 15px">{{ $label }}</h5>
                                <p style="font-size: 18px;">
                                    {!! $content !!}
                                </p>
                            @endif
                        @endforeach

                    </div>

                </div>

                <div id="apply-form-container" style="display: none; margin-top: 50px;">
                    <h4 class="btn btn-primary">Job Application Form</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('job-apply.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="">
                            <label for="name" class="form-label label-area">Full Name</label>
                            <input
                                type="text"
                                class="form-control custom-input2"
                                name="name"
                                id="name"
                                placeholder="John Doe"
                                required
                            />
                        </div>
                        <div class="">
                            <label for="email" class="form-label label-area"
                            >Email Address</label
                            >
                            <input
                                type="email"
                                name="email"
                                class="form-control custom-input2"
                                id="email"
                                placeholder="john@example.com"
                                required
                            />
                        </div>
                        <div class="">
                            <label for="position" class="form-label label-area"
                            >Position You're Applying For</label
                            >
                            <select class="form-control custom-input2" id="position" name="position" required>

                                <option>{{ $career->job_title }}</option>

                            </select>
                        </div>
                        <div class="">
                            <label for="resume" class="form-label label-area">Resume</label>
                            <input
                                class="form-control custom-input2"
                                name="resume"
                                type="file"
                                id="resume"
                                required
                            />
                        </div>
                        <div class="">
                            <label for="message" class="form-label label-area"
                            >Why do you want to join us?</label
                            >
                            <textarea
                                class="form-control custom-input2"
                                id="message"
                                name="why_join_us"
                                rows="4"
                                placeholder="Your message..."
                                required
                            ></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                Submit Application
                            </button>
                        </div>

                    </form>

                </div>

            </div>

            <div class="col-lg-4">
                <div class="single-services-detalis-right">

                    <div class="services-house-cleaning-card">
                        <h2>Our Services</h2>
                        <ul>
                            @foreach($services as $service)
                            <li>
                                <a href="{{ route('service-detail', $service->id) }}"
                                >{{ $service->service_title }} <i class="bx bx-arrow-back"></i
                                    ></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('show-apply-form').addEventListener('click', function () {

        const formContainer = document.getElementById('apply-form-container');
        formContainer.style.display = 'block';
        this.style.display = 'none';

        formContainer.scrollIntoView({ behavior: 'smooth' });
    });
</script>



