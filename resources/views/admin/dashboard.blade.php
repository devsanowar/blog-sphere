@extends('admin.layouts.app')

@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
    <style>
        .row.equal-height {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
        }

        .row.equal-height > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }

        .row.equal-height > [class*='col-'] .card {
            flex: 1;
        }

    </style>
@endpush

@section('admin_content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard
                    <small class="text-muted">Welcome to <b>{{ $website_setting->website_title }}</b> Dashboard</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i> {{ $website_setting->website_title }} </a></li>
                    <li class="breadcrumb-item active"><b>{{ auth()->user()->system_admin}}</b> Dashboard</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row clearfix social-widget">

            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect google-widget">
                    <div class="icon"><i class="zmdi zmdi-menu"></i></div>
                    <div class="content">
                        <div class="text">Total Menu</div>
                        <div class="number">{{ $totalMenu }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect linkedin-widget">
                    <div class="icon"><i class="zmdi zmdi-folder"></i></div>
                    <div class="content">
                        <div class="text">Total Categories</div>
                        <div class="number">{{ $totalCategories }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect facebook-widget">
                    <div class="icon"><i class="zmdi zmdi-blogger"></i></div>
                    <div class="content">
                        <div class="text">Total Blog</div>
                        <div class="number">{{ $allBlogs }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect twitter-widget">
                    <div class="icon"><i class="zmdi zmdi-comment-text"></i></div>
                    <div class="content">
                        <div class="text">Total Comments</div>
                        <div class="number">{{ $totalComments }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect instagram-widget">
                    <div class="icon"><i class="zmdi zmdi-account"></i></div>
                    <div class="content">
                        <div class="text">Total Subscribers</div>
                        <div class="number">{{ $totalSubscribers }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect behance-widget">
                    <div class="icon"><i class="zmdi zmdi-eye"></i></div>
                    <div class="content">
                        <div class="text">Top Viewed (Times)</div>
                        <div class="number">
                            {{ optional($trendingBlogs->first())->views ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-8">
                <div class="card product-report">
                    <div class="header">
                        <h2>Monthly Stats (Last 5 Months)</h2>
                    </div>
                    <div class="body">
                        <canvas id="monthlyChart" class="graph" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix equal-height">
            <div class="col-sm-12 col-md-6 col-lg-8">
                <div class="card">

                    <div class="card-header">
                        <h4>
                            All Published Blog List
                        </h4>
                    </div>

                    <div class="body table-responsive members_profiles">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th style="width:60px;">Image</th>
{{--                                <th>Menu</th>--}}
{{--                                <th>Category</th>--}}
                                <th>Title</th>
                                <th><i class="zmdi zmdi-eye"></i>  Views</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($trendingBlogs as $blog)
                                <tr>
                                    <td><img class="" src="{{ asset($blog->image) }}" alt="user" width="40"></td>
{{--                                    <td style="text-align: left">{{ $blog->menu->name }}</td>--}}
{{--                                    <td style="text-align: left">{{ $blog->category->name }}</td>--}}
                                    <td style="text-align: left"><a href="{{ route('blog-detail', $blog->id) }}" target="_blank">{{ $blog->title }}</a></td>
                                    <td>{{ $blog->views }} Views</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card ">
                    <div class="card-header">
                        <h4>Recent Comments</h4>
                    </div>
                    <div class="body">
                        <ul class="inbox-widget list-unstyled clearfix">
                            @foreach($comments->take(7) as $comment)
                            <li class="inbox-inner" style="padding: 20px 0px !important;">
                                <div class="inbox-item">
                                    <div class="inbox-img">
                                        <img src="{{ $comment->image ? asset($comment->image) : 'https://randomuser.me/api/portraits/lego/3.jpg' }}" alt="Commenter" />
                                    </div>
                                    <div class="inbox-item-info">
                                        <p class="author">{{ $comment->name }}</p>
                                        <p class="inbox-message">{{ $comment->comment_text }}</p>
                                        <p class="inbox-date">{{ $comment->created_at->format('F d, Y (h:i A)') }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')

    <script>
        const ctx = document.getElementById('monthlyChart').getContext('2d');

        // Gradients
        const gradientMenu = ctx.createLinearGradient(0, 0, 0, 400);
        gradientMenu.addColorStop(0, 'rgba(255, 99, 132, 0.5)');
        gradientMenu.addColorStop(1, 'rgba(255, 99, 132, 0)');

        const gradientCategory = ctx.createLinearGradient(0, 0, 0, 400);
        gradientCategory.addColorStop(0, 'rgba(54, 162, 235, 0.5)');
        gradientCategory.addColorStop(1, 'rgba(54, 162, 235, 0)');

        const gradientBlog = ctx.createLinearGradient(0, 0, 0, 400);
        gradientBlog.addColorStop(0, 'rgba(255, 206, 86, 0.5)');
        gradientBlog.addColorStop(1, 'rgba(255, 206, 86, 0)');

        const gradientComment = ctx.createLinearGradient(0, 0, 0, 400);
        gradientComment.addColorStop(0, 'rgba(75, 192, 192, 0.5)');
        gradientComment.addColorStop(1, 'rgba(75, 192, 192, 0)');

        const gradientSubscriber = ctx.createLinearGradient(0, 0, 0, 400);
        gradientSubscriber.addColorStop(0, 'rgba(153, 102, 255, 0.5)');
        gradientSubscriber.addColorStop(1, 'rgba(153, 102, 255, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [
                    {
                        label: 'Menus',
                        data: @json($menuData),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: gradientMenu,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Categories',
                        data: @json($categoryData),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: gradientCategory,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Blogs',
                        data: @json($blogData),
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: gradientBlog,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Comments',
                        data: @json($commentData),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: gradientComment,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Subscribers',
                        data: @json($subscriberData),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: gradientSubscriber,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom', labels: { font: { size: 14 } } },
                    title: { display: true, text: 'Monthly Dashboard Stats', font: { size: 18 } },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#000',
                        titleFont: { size: 16 },
                        bodyFont: { size: 14 },
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(200,200,200,0.2)' }
                    },
                    x: {
                        grid: { color: 'rgba(200,200,200,0.2)' }
                    }
                }
            }
        });
    </script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend') }}/assets/bundles/datatablescripts.bundle.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>

@endpush
