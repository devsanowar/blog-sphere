
@foreach($blogs->skip(3)->take(3) as $blog)
    <div class="col-12">
        <div class="blog-card shadow-sm d-flex flex-lg-row flex-column align-items-start animate-fade-in">
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
