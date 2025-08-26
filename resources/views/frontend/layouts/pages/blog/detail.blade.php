<!-- blog details section body -->
<section class="blog-details-section">
    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <span class="badge-custom">{{ $blog->category->name }}</span>
                <h1 class="blog-title">{{ $blog->title }}</h1>
                <p class="blog-subtitle">{{ $blog->sub_title }}</p>

                <div class="author-info">
                    <img src="{{ asset($blog->author->image ?? 'https://randomuser.me/api/portraits/lego/1.jpg') }}" alt="Author">
                    <div>
                        <div><strong>{{ $blog->author->name ?? 'Unknown Author' }}</strong></div>
                        <small class="text-muted">
                            Published {{ $blog->created_at->diffForHumans() ?? 'some time ago' }} on {{ $blog->created_at->format('M d, Y') ?? '' }} | <i class="fas fa-eye"></i> {{ $blog->views }} Views
                        </small>
                    </div>
                </div>

                <img src="{{ asset($blog->image) }}"
                     class="blog-image" alt="Speech Image">

                <div class="content blog-details">

                    <!-- Introduction -->
                    <p>
                        {!! $blog->blog_content !!}
                    </p>
                </div>

                <!-- Comments Section -->
                <div class="comments-section mt-5">
                    <!-- Title -->
                    <h4 class="comments-title">Comments ({{ $commentCount }})</h4>

                    <!-- Comments List -->
                    <div class="comment-list">
                        <!-- Single Comment -->
                        @foreach($comments as $comment)
                        <div class="comment-box d-flex gap-3 mb-4">
                            <div class="comment-avatar">
                                <img src="{{ $comment->image ? asset($comment->image) : 'https://randomuser.me/api/portraits/lego/3.jpg' }}" alt="User" />
                            </div>
                            <div class="comment-content">
                                <h6 class="mb-1">{{ $comment->name }}</h6>
                                <p class="comment-date text-muted small">{{ $comment->created_at->format('F d, Y') }}</p>
                                <p class="mb-0">
                                    {{ $comment->comment_text }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Comment Form -->
                    <div class="comment-form mt-4">
                        <h5 class="mb-3">Leave a Comment</h5>
                        <p class="text-success text-center">{{ session('message') }}</p>
                        <form action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">

                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required />
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email"
                                           required />
                                </div>
                                <div class="col-12">
                                            <textarea class="form-control" name="comment_text" rows="4" placeholder="Write your comment..."
                                                      required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-comment border-0">
                                        Post Comment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                        @foreach($blogs->take(7) as $blog)
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
                        @foreach($trendingBlogs->take(7) as $blog)
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

                <!-- sidebar categoires -->
                <div class="categories-blog">
                    <div class="sidebar-widget categories-widget animated fadeInUp">
                        <h4 class="widget-title">All Categories</h4>
                        <ul class="list-unstyled category-list">
                            @foreach($menus as $menu)
                                @php
                                    $categoryCount = $menu->categories()->count();
                                    $blogCount = $menu->blogs()->count();
                                @endphp

                                @if(strtolower($menu->name) !== 'home' && $categoryCount > 0)
                                    <li>
                                        <a href="{{ route('menu-blog', $menu->id) }}">
                                            <span><i class="fas {{ $menu->icon_class }}"></i> {{ $menu->name }}</span>
                                            <span class="count">{{ $blogCount }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
