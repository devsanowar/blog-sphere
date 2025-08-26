<!-- Start Blog Two Area -->
<div class="blog-area pt-100 pb-100"
     @if(request()->routeIs('home'))
     style="background: #e7f0f9;"
    @endif
    >
    <div class="container">
        <div class="section-title">
          <span class="top-title top-title-three"
          ><i class="flaticon-flash"></i> OUR BLOG</span
          >
            <h2>Latest News & Updates</h2>
        </div>
        <div class="row justify-content-center">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6" data-cue="fadeIn" data-duration="1500">
                <div class="single-blog-card single-blog-two-content">
                    <div class="blog-img blog-img-two">
                        <a href="{{ route('blog-detail', $blog->id) }}">
                            <img
                                src="{{ asset($blog->image) }}"
                                alt="images"
                            />
                        </a>
                    </div>
                    <div class="blog-two-list-item">
                        <ul>
                            <li><i class="flaticon-calendar"></i> {{ $blog->created_at->format('F d, Y') }}</li>
                            <li><i class="flaticon-comment"></i>{{ $blog->comments->count() }} Comment</li>
                        </ul>
                        <a href="{{ route('blog-detail', $blog->id) }}">
                            <h3>{{ Str::limit($blog->title, 40, '...') }}</h3>
                        </a>
                        <a href="{{ route('blog-detail', $blog->id) }}" class="learn-more"
                        >Learn More <i class="flaticon-next"></i
                            ></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(request()->routeIs('home'))
            <div class="services-contact">
                <p>
                    Contact Us For Any Kind Of Handyman Repair Services.<a
                        href="{{ route('blog') }}"
                    >View All Blog & News.</a
                    >
                </p>
            </div>
        @endif
    </div>
</div>
<!-- End Blog Two Area -->
