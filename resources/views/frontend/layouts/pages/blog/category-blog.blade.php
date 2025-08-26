<!-- blog details section body -->
<section class="blog-details-section">
    <div class="container py-5">
        <div class="row">

            <!-- Main Content -->
            <div class="col-md-8">
                <div class="categories-content">
                    <div class="row g-4">

                        <h2 class="category-title-heading">{{ $category->name ?? 'Blogs' }}</h2>

                        @forelse($categoryBlogs as $blog)
                            <div class="col-12">
                                <div
                                    class="blog-card shadow-sm d-flex flex-lg-row flex-column align-items-start animate-fade-in">
                                    <img src="{{ asset($blog->image ?? 'frontend/assets/images/default.png') }}" alt="Post Image"
                                         class="blog-image me-lg-4 mb-3 mb-lg-0 rounded-3">
                                    <div class="blog-content">
                                        <div class="blog-meta text-uppercase">
                                            {{ $blog->category->name ?? 'Uncategorized' }} / {{ $blog->created_at->diffForHumans() }}
                                        </div>
                                        <h5 class="blog-title">
                                            <a href="{{ route('blog-detail', $blog->id) }}">{{ $blog->title }}</a>
                                        </h5>
                                        <p class="blog-desc">
                                            {!! Str::limit(strip_tags($blog->blog_content), 100, '...') !!}
                                        </p>
                                        <p class="pt-2">
                                            <i class="fas fa-eye"></i> {{ $blog->views }} Views
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div
                                    class="blog-card shadow-sm d-flex flex-lg-row flex-column align-items-start animate-fade-in">
                                    <p>No blogs found in this category.</p>
                                </div>
                            </div>
                        @endforelse

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
