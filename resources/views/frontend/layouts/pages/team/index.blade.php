<!-- Start Our Team Three Area -->
<div class="our-team-three-area pt-100 pb-100"
     @if (request()->routeIs('home') || request()->routeIs('about'))
     style="background: #e7f0f9;"
    @endif>

    <div class="container">
        <div class="section-title">
          <span class="top-title top-title-three"
          ><i class="flaticon-flash"></i>OUR TEAM</span
          >
            <h2>Our Services Team</h2>
        </div>
        <div class="row justify-content-center">
            @foreach($teams as $team)
            <div class="col-lg-4 col-md-6" data-cue="fadeIn" data-duration="2000">
                <div class="team-three-content">
                    <img
                            src="{{ asset($team->image) }}"
                            alt="images"
                        />
                    <div class="single-team-card-content">
                        <div class="cleaning-text">
                            <h3>{{ $team->name }}</h3>
                            <p>{{ $team->position }}</p>
                        </div>
                        <ul class="team-list">
                            <li>
                                <a href="{{ $team->facebook_url }}" target="_blank">
                                    <i class="flaticon-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ $team->twitter_url }}"
                                    target="_blank"
                                    class="border-twitter"
                                >
                                    <i class="flaticon-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $team->youtube_url }}" target="_blank">
                                    <i class="flaticon-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ $team->instagram_url }}"
                                    target="_blank"
                                    class="border-twitter"
                                >
                                    <i class="flaticon-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(request()->routeIs('home') || request()->routeIs('about'))
            <div class="services-contact">
            <p>
                Contact Us For Any Kind Of Handyman Cleaning Services.<a
                    href="{{ route('team') }}"
                >View All Team Member.</a
                >
            </p>
            </div>
        @endif

    </div>
</div>
<!-- End Our Team Three Area -->
