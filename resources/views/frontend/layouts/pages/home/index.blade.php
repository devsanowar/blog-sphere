<!-- blog section body -->
<section class="blog-main pt-5">
    <div class="container">
        <div class="row">

            <!-- Left Sidebar: Trending -->
            <div class="col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h5 class="section-top-left-title">
                    <span class="line"></span>
                    <span class="trending-title">TRENDING</span>
                    <span class="line"></span>
                </h5>

                <div class="trending-post">
                    @foreach($trendingBlogs->take(8) as $blog)
                        <div class="trending-item mb-3 d-flex gap-3">
                            <img src="{{ asset($blog->image) }}" class="img-fluid trending-img" alt="">
                            <div class="d-flex">
                                <div class="number">{{ $loop->iteration }}</div> <!-- Dynamic number -->
                                <div>
                                    <p class="meta">{{ $blog->category->name }} / {{ $blog->created_at->diffForHumans() }}</p>
                                    <h6><a href="{{ route('blog-detail', $blog->id) }}">{{ $blog->title }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="col-lg-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
                @foreach($blogs->take(3) as $key => $blog)
                    <div class="main-post {{ $key === 0 ? 'main-post-large' : '' }} position-relative text-white mb-4 main-blog-card">
                        <img src="{{ asset($blog->image) }}" class="img-fluid" alt="Main Post Image">
                        <div class="overlay-black"></div>
                        <div class="overlay-content position-absolute">
                            <p class="meta text-uppercase small">{{ $blog->category->name }} / {{ $blog->created_at->diffForHumans() }} | <i class="fas fa-eye"></i> {{ $blog->views }} Views</p>
                            <h2 class="fw-bold main-title-heading">
                                <a href="{{ route('blog-detail', $blog->id) }}">
                                    {{ $blog->title }}
                                </a>
                            </h2>
                            <p class="mb-0">
                                {!! Str::limit(strip_tags($blog->blog_content, '<strong>'), 150, '...') !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right Sidebar: Latest -->
            <div class="col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="500">
                <h5 class="section-top-left-title">
                    <span class="line"></span>
                    <span class="trending-title">Latest</span>
                    <span class="line"></span>
                </h5>
                <div class="latest-posts">
                    @foreach($blogs->take(12) as $blog)
                    <div class="latest-item d-flex align-items-start mb-4">
                        <img src="{{ asset($blog->image) }}" class="img-thumb me-3" alt="">
                        <div class="post-info">
                            <p class="meta small mb-1">{{ $blog->category->name }} / {{ $blog->created_at->diffForHumans() }}</p>
                            <h6><a href="{{ route('blog-detail', $blog->id) }}">{{ $blog->title }}</a></h6>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- More News Section -->
<section class="more-news-section">
    <div class="container">
        <h5 class="section-top-left-title">
            <span class="line"></span>
            <span class="trending-title">MORE NEWS</span>
            <span class="line"></span>
        </h5>
        <div class="row">
            <!-- LEFT CONTENT -->
            <div class="col-lg-8 col-md-12">
                <div class="row g-4">
                @foreach($blogs->skip(3)->take(3) as $blog)
                    <!-- BLOG CARD -->
                        <div class="col-12">
                            <div
                                class="blog-card shadow-sm d-flex flex-lg-row flex-column align-items-start animate-fade-in">
                                <img src="{{ asset($blog->image) }}" alt="Post Image"
                                     class="blog-image me-lg-4 mb-3 mb-lg-0 rounded-3">
                                <div class="blog-content">
                                    <div class="blog-meta text-uppercase">
                                        {{ $blog->category->name }} / {{ $blog->created_at->diffForHumans() }}
                                    </div>
                                    <h5 class="blog-title">
                                        <a href="{{ route('blog-detail', $blog->id) }}">{{ $blog->title }}</a>
                                    </h5>
                                    <p class="blog-desc">
                                        {!! Str::limit(strip_tags($blog->blog_content, '<strong>'), 100, '...') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- RIGHT CONTENT (TABS) -->
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
                <ul class="nav nav-tabs" id="newsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="latest-tab" data-bs-toggle="tab"
                                data-bs-target="#latest" type="button" role="tab">Latest</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="trending-tab" data-bs-toggle="tab"
                                data-bs-target="#trending" type="button" role="tab">Trending</button>
                    </li>
                </ul>

                <div class="tab-content border border-top-0 p-3" id="newsTabContent">
                    <!-- LATEST TAB -->
                    <div class="tab-pane fade show active" id="latest" role="tabpanel">
                        @foreach($blogs->take(8) as $blog)
                        <div class="d-flex mb-3 tab-post">
                            <img src="{{ asset($blog->image) }}" alt="">
                            <div>
                                <div class="blog-meta">{{ $blog->category->name }} / {{ $blog->created_at->diffForHumans() }}</div>
                                <a href="{{ route('blog-detail', $blog->id) }}" class="tab-post-title">{{ $blog->title }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- TRENDING TAB -->
                    <div class="tab-pane fade" id="trending" role="tabpanel">
                        @foreach($trendingBlogs->take(8) as $blog)
                        <div class="d-flex mb-3 tab-post">
                            <img src="{{ asset($blog->image) }}" alt="">
                            <div>
                                <div class="blog-meta">{{ $blog->category->name }} / {{ $blog->created_at->diffForHumans() }}</div>
                                <a href="{{ route('blog-detail', $blog->id) }}" class="tab-post-title">{{ $blog->title }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Subscribe Section -->
<section class="subscribe-section" data-aos="fade-up" data-aos-duration="1000">
    <div class="subscribe-box" data-aos="zoom-in" data-aos-delay="200">
        <h2 data-aos="fade-down" data-aos-delay="300">
            <i class="fas fa-envelope-open-text me-2"></i>Subscribe to Our Blog
        </h2>
        <p data-aos="fade-down" data-aos-delay="400">
            Weekly insights, tips, and updates – directly in your inbox.
        </p>

        <h5 class="text-center text-success">{{ session('message') }}</h5>

        @if ($errors->any())
            <div class="text-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('subscribe') }}" method="POST" class="d-flex form-inline justify-content-center mt-4" data-aos="fade-up"
              data-aos-delay="500">
            @csrf

            <div class="form-group me-2">
                <i class="fas fa-envelope input-icon" style="color: white"></i>
                <input type="email" name="email" class="form-control w-100" placeholder="  Your email address" required
                       id="emailInput">
            </div>
            <button type="submit" class="btn btn-subscribe">
                <i class="fas fa-paper-plane me-1"></i>Subscribe
            </button>
        </form>

        <div class="social-proof" data-aos="fade-up" data-aos-delay="700">
            <i class="fas fa-users"></i> Join over <strong>{{ $totalSubscribers }}</strong> other readers!
        </div>
    </div>
</section>

<script>

    document.getElementById('globalSearchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let query = this.querySelector('input[name="query"]').value;

        fetch(`/ajax-home-search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                // Replace main blog cards container
                document.querySelector('.col-lg-6.mb-4[data-aos="zoom-in"]').innerHTML = data.mainBlogs;

                // Replace more news section container
                document.querySelector('.more-news-section .row.g-4').innerHTML = data.moreNews;
            })
            .catch(() => {
                alert('Search failed. Please try again.');
            });
    });

</script>
