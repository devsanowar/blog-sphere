<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title', ($website_setting && $website_setting->website_title) ? $website_setting->website_title : 'Admin | Dashboard')</title>

    <!-- Favicon -->
    @if ($website_setting && $website_setting->website_favicon)
        <link rel="icon" href="{{ asset($website_setting->website_favicon) }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('default-favicon.ico') }}" type="image/x-icon">
    @endif

    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend') }}/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('frontend') }}/assets/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('frontend') }}/assets/css/style.css" rel="stylesheet">

    <!-- blog details css -->
    <link href="{{ asset('frontend') }}/assets/css/blog.css" rel="stylesheet">

    <!-- Categories css -->
    <link href="{{ asset('frontend') }}/assets/css/categoires.css" rel="stylesheet">

    <!-- Favicon (Optional) -->
    <link rel="icon" href="{{ asset('frontend') }}/assets/images/favicon.png" type="image/png">

    @stack('styles')

</head>

</head>

<body>
<!-- Header -->
<!-- Header Top -->
<header class="custom-header text-white py-3">
    <div class="container">
        <div class="row align-items-center text-center text-md-start header-logo-area" style="
    padding: 40px 0;">
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start gap-3">
                <a href="{{ $website_social_icons->facebook_url }}" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ $website_social_icons->twitter_url }}" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="{{ $website_social_icons->instagram_url }}" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="{{ $website_social_icons->linkedin_url }}" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-12 col-md-4 text-center">
                <a href="{{ route('home') }}" class="navbar-brand logo-text">
                    <img src="{{ asset($website_setting->website_logo) }}" alt="" width="200px">
                </a>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-end gap-2">
                <span class="time-date"><i class="far fa-calendar-alt me-1"></i>{{ \Carbon\Carbon::now()->format('l, M d, Y') }}</span>
            </div>
        </div>
    </div>
</header>

<!-- Bottom Sticky Nav -->
<nav class="header-bottom sticky-top shadow-sm">
    <div class="container d-flex align-items-center justify-content-between py-2">
        <!-- Hamburger for Mobile -->
        <button class="btn d-md-none" id="menu-toggle">
            <i class="fas fa-bars fs-5"></i>
        </button>

        @php
            // Filter menus that have categories or are Home
            $validMenus = $menus->filter(function ($menu) use ($categories) {
                return $menu->name == 'Home' || $categories->where('menu_id', $menu->id)->count() > 0;
            });

            // First 8 menus to show normally
            $firstMenus = $validMenus->take(8);

            // Remaining menus (from 9th onward) to put in "Others"
            $otherMenus = $validMenus->slice(8);
        @endphp

        <ul class="nav d-none d-md-flex flex-wrap mb-0">

            {{-- First 8 menus --}}
            @foreach($firstMenus as $menu)
                @php
                    $menuCategories = $categories->where('menu_id', $menu->id);
                @endphp

                @if($menuCategories->count() > 0)
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{ $menu->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($menuCategories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category-blog', $category->id) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            {{ $menu->name }}
                        </a>
                    </li>
                @endif
            @endforeach

            {{-- "Others" dropdown with remaining menus --}}
            @if($otherMenus->count() > 0)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        Others
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($otherMenus as $menu)
                            <li>
                                <a class="dropdown-item" href="{{ route('menu-blog', $menu->id) }}">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif

        </ul>

        <form class="search-box" id="globalSearchForm" role="search">
            <input type="search" name="query" class="form-control form-control-sm search-input"
                   placeholder="Search..." aria-label="Search">
            <button class="btn btn-primary btn-sm btn-search" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>

    </div>
</nav>

<!-- Mobile Slide Menu -->
<div id="mobileMenu" class="mobile-menu">
    <button id="closeMenu" class="btn-close btn-close-white ms-auto m-3"></button>
    <ul class="list-unstyled ps-2 pt-4 pe-4">

        <!-- Technology -->
        @foreach($menus as $menu)
            @php
                $menuCategories = $categories->where('menu_id', $menu->id);
            @endphp

            @if($menuCategories->count() > 0)
                <li>
                    <a href="#">{{ $menu->name }}</a>
                    <ul class="submenu">
                        @foreach($menuCategories as $category)
                        <li>
                            <a href="{{ route('category-blog', $category->id) }}">{{ $category->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ route('home') }}">
                        {{ $menu->name }}
                    </a>
                </li>
            @endif

        @endforeach
    </ul>
</div>

<!-- Main Content Start -->
<main>
