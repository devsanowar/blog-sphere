<h2 class="category-title-heading">{{ $category->name ?? 'Blogs' }}</h2>

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
