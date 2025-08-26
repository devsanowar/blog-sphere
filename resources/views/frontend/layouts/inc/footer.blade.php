</main>
<!-- Main Content End -->
<!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <div class="row text-md-start gap-2">

            <!-- Column 3: Logo and Social -->
            <div class="col-md-3">
                <div class="footer-logo">
                    <img src="{{ asset($website_setting->website_logo) }}" alt="" width="200px">
                </div>
                <p class="mt-3" style="font-size: 14px; color: #bbb; text-align: justify">
                    {{ Str::words($website_setting->footer_content, 28, '...') }}
                </p>
                <div class="social-icons">
                    <a href="{{ $website_social_icons->facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $website_social_icons->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $website_social_icons->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $website_social_icons->linkedin_url }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>

            </div>

            <!-- Column 1: Popular Categories -->
            <div class="col-md-2" style="width: 190px">
                <h5>Popular Categories</h5>
                <ul>
                    @foreach($popularCategories->take(7) as $category)
                        <li>
                            <a href="{{ route('category-blog', $category->id) }}">
                                <i class="fas fa-angle-double-right"></i> {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 1: Useful Links -->
            <div class="col-md-2" style="width: 280px">
                <h5>Popular Blogs</h5>
                <ul>
                    @foreach($trendingBlogs->take(7) as $blog)
                        <li>
                            <a class="d-flex gap-1 mb-1" href="{{ route('blog-detail', $blog->id) }}">
                                <p >
                                    <span><i class="fas fa-angle-double-right"></i></span>
                                </p>
                                <p> <span>{{ Str::limit($blog->title, 30, '..') }}</span></p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-md-2" style="width: 140px">
                <h5>Quick Links</h5>
                <ul>
                    <!-- Fixed Home Link -->
                    <li>
                        <a href="{{ route('home') }}">
                            <i class="fas fa-angle-double-right"></i> Home
                        </a>
                    </li>

                    <!-- Popular Menus -->
                    @foreach($popularMenus->take(6) as $menu)
                        <li>
                            <a href="{{ route('menu-blog', $menu->id) }}">
                                <i class="fas fa-angle-double-right"></i> {{ $menu->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 4: Newsletter + Categories -->
            <div class="col-md-3">
                <h5>Newsletter</h5>
                <h6 style="text-align: justify">Stay informed and inspired—read our latest blogs! It’s packed with updates, tips, and stories you won’t want to miss.</h6>
                <h5 class="text-center text-success">{{ session('message') }}</h5>
                <form action="{{ route('subscribe') }}" method="POST" class="newsletter">
                    @csrf

                    @if ($errors->any())
                        <div class="text-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="email" name="email" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom d-flex justify-content-center">
            <div style="font-size: 16px">
                &copy; {{ date('Y') }} <span style="color: #00bcd4; font-weight: bold">{{ $website_setting->website_title }}</span>. All Rights Reserved.
            </div>
{{--            <div>Designed by: <a href="https://www.freelanceit.com.bd/" style="font-weight: bold; color: white">Freelance IT</a></div>--}}
        </div>
    </div>
</footer>

<!-- Footer End -->

@stack('scripts')

<!-- Bootstrap JS (with Popper) -->
<script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome -->
<script src="{{ asset('frontend') }}/assets/js/all.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('frontend') }}/assets/js/script.js"></script>

<!-- Responsive Menu JS -->
<script src="{{ asset('frontend') }}/assets/js/responsiveMenu.js"></script>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<script>
    document.getElementById('globalSearchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let query = this.querySelector('input[name="query"]').value;

        fetch(`/ajax-search?query=${encodeURIComponent(query)}`)
            .then(res => res.text())
            .then(html => {
                document.querySelector('.categories-content .row.g-4').innerHTML = html;
            });
    });

</script>

</body>

</html>
