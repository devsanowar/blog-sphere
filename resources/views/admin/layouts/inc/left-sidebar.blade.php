@php

    $homePageRoutes = [
        'menu.*',
        'category.*',
        'blog.*',
        'comment.*'
    ];

    $isHomePageActive = false;
    foreach ($homePageRoutes as $route) {
        if (request()->routeIs($route)) {
            $isHomePageActive = true;
            break;
        }
    }

    $isSettingsActive = request()->routeIs('website_setting') || request()->routeIs('website_setting.update');

    $user = Auth::user();

    $email = Auth::user()->email;
    $parts = explode('@', $email);
    $name = substr($parts[0], 0, 5) . '***';
    $maskedEmail = $name . '@' . $parts[1];

@endphp

<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset(Auth::user()->image) }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown">{{ Auth::user()->name }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button"> keyboard_arrow_down </i>
                <ul class="dropdown-menu slideUp">
                    <li><a href="{{ route('user.profile') }}"><i class="material-icons">person</i>Profile</a></li>
                    <li class="divider"></li>
                </ul>
            </div>
            <div class="email">
                {{ $maskedEmail }}
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="active"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
            </li>

            <li class="{{ $isHomePageActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-view-headline"></i>
                    <span>Home Page</span>
                </a>
                <ul class="ml-menu">

                    <li class="{{ request()->routeIs('menu.*') ? 'active' : '' }}">
                        <a href="{{ route('menu.index') }}">Menu</a>
                    </li>
                    <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">
                        <a href="{{ route('category.index') }}">Category</a>
                    </li>
                    <li class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                        <a href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="{{ request()->routeIs('comment.*') ? 'active' : '' }}">
                        <a href="{{ route('comment.index') }}">Comment</a>
                    </li>

{{--                    @if(in_array($user->system_admin, ['Admin', 'Editor']))--}}
{{--                        <li class="{{ request()->routeIs('about.*') ? 'active' : '' }}">--}}
{{--                            <a href="{{ route('about.index') }}"><span>About</span></a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(in_array($user->system_admin, ['Admin', 'Editor']))--}}
{{--                        <li class="{{ request()->routeIs('review.*') ? 'active' : '' }}">--}}
{{--                            <a href="{{ route('review.index') }}"><span>Review</span></a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    <li class="{{ request()->routeIs('image-gallery.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('image-gallery.index') }}"><span>Image Gallery</span></a>--}}
{{--                    </li>--}}

{{--                    <li class="{{ request()->routeIs('video-gallery.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('video-gallery.index') }}"><span>Video Gallery</span></a>--}}
{{--                    </li>--}}

{{--                    <li class="{{ request()->routeIs('feature.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('feature.index') }}"><span>Feature</span></a>--}}
{{--                    </li>--}}

{{--                    @if(in_array($user->system_admin, ['Admin', 'Editor']))--}}
{{--                        <li class="{{ request()->routeIs('slider.*') ? 'active' : '' }}">--}}
{{--                            <a href="{{ route('slider.index') }}"><span>Slider</span></a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    <li class="{{ request()->routeIs('faq.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('faq.index') }}"><span>FAQ</span></a>--}}
{{--                    </li>--}}

                </ul>
            </li>

{{--            <li class="{{ $isBlogPageActive ? 'active open' : '' }}">--}}
{{--                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-blogger"></i>--}}
{{--                    <span>Blog</span>--}}
{{--                </a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="{{ request()->routeIs('menu.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('menu.index') }}">Menu</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('category.index') }}">Category</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('blog.index') }}">Blog</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ request()->routeIs('comment.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('comment.index') }}">Comment</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

{{--            <li class="{{ request()->routeIs('career.index') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('career.index') }}"><i class="zmdi zmdi-case"></i>--}}
{{--                    <span>Career</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="{{ request()->routeIs('job-apply.index') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('job-apply.index') }}"><i class="zmdi zmdi-apps"></i>--}}
{{--                    <span>Job Application</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="{{ request()->routeIs('sendus.index') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('sendus.index') }}"><i class="zmdi zmdi-email"></i>--}}
{{--                    <span>Client Message</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="">
                <a href="{{ route('teacher.index') }}"><i class="zmdi zmdi-account"></i>
                    <span>Teachers</span>
                </a>
            </li>


            <li class="{{ request()->routeIs('subscriber.index') ? 'active' : '' }}">
                <a href="{{ route('subscriber.index') }}"><i class="zmdi zmdi-account"></i>
                    <span>Subscriber</span>
                </a>
            </li>

{{--            <li class="{{ request()->routeIs('team.index') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('team.index') }}"><i class="zmdi zmdi-accounts-alt"></i>--}}
{{--                    <span>Manage Team</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="{{ request()->routeIs('team.contact') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('team.contact') }}"><i class="zmdi zmdi-accounts-list"></i>--}}
{{--                    <span>Contact Info</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="{{ request()->routeIs('location.index') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('location.index') }}"><i class="zmdi zmdi-google-maps"></i>--}}
{{--                    <span>Location</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            @if ($user->system_admin == 'Admin')
                <li class="{{ request()->routeIs('user.create') ? 'active' : '' }}">
                    <a href="{{route('user.create')}}"><i class="zmdi zmdi-accounts-add"></i>
                        <span>Manage User</span>
                    </a>
                </li>
            @endif

            @if(in_array($user->system_admin, ['Admin', 'Editor']))
                <li class="{{ $isSettingsActive ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="zmdi zmdi-settings"></i><span>Settings</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->routeIs('website_setting') ? 'active' : '' }}">
                            <a href="{{ route('website_setting') }}">Website Setting</a>
                        </li>
                    </ul>
                </li>
            @endif

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" ><i class="zmdi zmdi-power"></i><span>Logout</span> </a>
                </form>
            </li>

        </ul>
    </div>
    <!-- #Menu -->
</aside>
