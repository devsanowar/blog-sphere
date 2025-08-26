<!-- Start Page Banner Area -->
<div class="page-banner-area pt-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="single-page-banner-content">
                    <h1>Contact Us</h1>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-page-banner-img">
                    <img src="{{asset('frontend/assets/images/page-banner-img.png')}}" alt="images" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner Area -->

<!-- Start Contact Us Area -->
<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5" data-cue="slideInRight" data-duration="1500">
                <div class="single-contact-card">
                    <div class="contact-box">
                        <i class="flaticon-pin"></i>
                        <h3>Head Office</h3>
                        <p>{{ $website_setting->address }}</p>
                    </div>
                    <div class="contact-box">
                        <i class="flaticon-phone-call"></i>
                        <h3>Get in Touch</h3>
                        <span>
                            <a href="tel:+1(800)123-4566">
                                {{ $website_setting->phone }}
                            </a></span>
                        <span class="mail"><a
                                href="https://templates.hibotheme.com/cdn-cgi/l/email-protection#1179747d7d7e517378696422233f727e7c">
                                <span
                                    class="__cf_email__"
                                    data-cfemail="026a676e6e6d42606b7a7731302c616d6f">
                                    {{ $website_setting->email }}
                                </span>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-cue="slideInRight" data-duration="1500">
                <div class="contact-form-content">
                    <div class="section-title section-title-left">
                        <span class="top-title">Contact Us</span>
                        <h2>Request A Quote</h2>
                    </div>
                    <h6 class="text-center text-success">{{ session('message') }}</h6>
                    <form action="{{ route('sendus.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        placeholder="Name"
                                        required
                                        data-error="Please enter your name"
                                    />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="address"
                                        id="address"
                                        class="form-control"
                                        placeholder="Address"
                                        required
                                        data-error="Please enter your address"
                                    />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        placeholder="Email"
                                        required
                                        data-error="Please enter your email"
                                        class="form-control"
                                    />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="phone"
                                        id="phone"
                                        class="form-control"
                                        placeholder="Phone"
                                        required
                                        data-error="Please enter your number"
                                    />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="subject"
                                        id="subject"
                                        class="form-control"
                                        placeholder="Subject"
                                        required
                                        data-error="Please enter your subject"
                                    />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                      <textarea
                          name="message"
                          class="form-control"
                          id="message"
                          cols="5"
                          rows="7"
                          placeholder="Message"
                          required
                          data-error="Write your message"
                      ></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input
                                            name="gridCheck"
                                            value="I agree to the terms and privacy policy."
                                            class="form-check-input"
                                            type="checkbox"
                                            id="gridCheck"
                                            required
                                        />
                                        <label class="form-check-label" for="gridCheck">
                                            I Agree To The
                                            <a href="terms-conditions.html">Terms & Conditions</a>
                                            And <a href="privacy-policy.html">Privacy Policy</a>
                                        </label>
                                        <div
                                            class="help-block with-errors gridCheck-error"
                                        ></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn">
                                    Send Message
                                </button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Us Area -->

<!-- office area -->
<section style="background-color: #e7f0f9; padding: 80px">
    <div class="container">
        <div class="row" style="margin-bottom: 60px">
            @foreach($branches as $branch)
            <div class="col-lg-4 col-md-6" data-cue="fadeIn" data-duration="1500">
                <div
                    style="
                background-color: white;
                padding: 25px 12px;
                border-radius: 15px;
                margin-bottom: 20px;
              "
                >
                    <div class="contact-form-content">
                        <div class="section-title section-title-left">
                            <span class="top-title"></span>
                            <h4 style="text-align: center">{{ $branch->branch_name }}</h4>
                        </div>
                    </div>
                    <div class="footer-widget footer-left-three-widget">
                        <div class="widget-contact-list bgs-bottom-12">
                            <div class="notification-icon">
                                <i class="flaticon-pin"></i>
                            </div>
                            <p style="color: black">
                                {{ $branch->address }}
                            </p>
                        </div>
                        <div class="widget-contact-list text-black">
                            <div class="notification-icon">
                                <i class="flaticon-phone-call"></i>
                            </div>
                            <a href="tel:+8801711-107164" style="color: black">
                                {{ $branch->mobile }}
                            </a>
                            <span>
                            <a href="tel:+880132-5067799" style="color: black">
                                {{ $branch->telephone }}
                            </a>
                            </span>
                        </div>
                        <div class="widget-contact-list text-black">
                            <div class="notification-icon">
                                <img src="{{ asset('frontend/assets/images/whatsapp.png') }}" alt="" />
                            </div>
                            <a href="tel:+8801711-107164" style="color: black">
                                {{ $branch->whatsapp }}
                            </a>
                        </div>
                        <div class="widget-contact-list bgs-bottom">
                            <div class="notification-icon">
                                <i class="flaticon-email"></i>
                            </div>
                            <a
                                href="#"
                            ><span
                                    class="__cf_email__"
                                    data-cfemail="f79f929b9b98b7959e8f82d994989a"
                                    style="color: black"
                                >{{ $branch->email }}
                            </span></a
                            >
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Start Contact Map area -->
<div class="google-map-area">
    <div class="container-fluid">
        <div class="map">
            <iframe
                class="maps"
                src="{{ $location->location_url }}"
            ></iframe>
        </div>
    </div>
</div>
<!-- End Contact Map area -->
