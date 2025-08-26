<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Career;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\ImageGallery;
use App\Models\Menu;
use App\Models\Review;
use App\Models\SendUsAMessage;
use App\Models\Slider;
use App\Models\Subscriber;
use App\Models\Team;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use App\Models\Location;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::where('is_active', 1)->get(['id', 'slider_title', 'slider_sub_title', 'slider_description', 'contact_us_btn', 'image']);
        $about = About::first();
        $features = Feature::where('is_active', 1)->get();
        $reviews = Review::latest()->get();
        $chunks = $reviews->chunk(3);
//        $faqs = Faq::latest()->get(['id', 'question', 'answer']);
        $teams = Team::latest()->take(3)->get();
        $imageGalleries = ImageGallery::latest()->take(6)->get();
        $videoGallery = VideoGallery::first();
        $brands = Brand::latest()->get();
        $blogs = Blog::with(['category', 'author'])->latest()->get();
        $trendingBlogs = Blog::with('category')->orderBy('views', 'desc')->get();
        $totalSubscribers = Subscriber::count();

        return view('frontend.home', compact([
            'sliders',
            'about',
            'features',
            'reviews',
//            'faqs',
            'teams',
            'chunks',
            'imageGalleries',
            'videoGallery',
            'brands',
            'blogs',
            'trendingBlogs',
            'totalSubscribers',
        ]));
    }

    public function about()
    {
        $about = About::first();
        $reviews = Review::latest()->get();
        $features = Feature::where('is_active', 1)->get();
        $brands = Brand::latest()->get();
        $teams = Team::latest()->limit(3)->get();
        $videoGallery = VideoGallery::first();

        return view('frontend.about', compact([
            'about', 'reviews', 'features', 'brands', 'teams', 'videoGallery',
        ]));
    }

    public function team()
    {
        $teams = Team::all();
        return view('frontend.layouts.pages.team.full-team', compact([
            'teams',
        ]));
    }

    public function review()
    {
        $reviews = Review::latest()->get();

        return view('frontend.review', compact([
            'reviews'
        ]));
    }

    public function blog()
    {
        $blogs = Blog::latest()->get();
        return view('frontend.blog', compact('blogs'));
    }

    public function categoryBlog($id)
    {
        $category = Category::findOrFail($id);

        $categoryBlogs = Blog::with(['category', 'author'])
            ->where('category_id', $id)
            ->where('is_active', 1)
            ->latest()
            ->get();

        $trendingBlogs = Blog::with('category')
            ->orderBy('views', 'desc')
            ->get();

        $blogs = Blog::with(['category', 'author'])->latest()->get();
        $trendingBlogs = Blog::with('category')->orderBy('views', 'desc')->get();

        return view('frontend.category-blog', compact('blogs', 'category', 'categoryBlogs', 'trendingBlogs'));
    }

    public function menuBlog($id, Request $request)
    {
        $menu = Menu::findOrFail($id);

        $menuBlogs = Blog::with(['category', 'author'])
            ->where('menu_id', $id)
            ->where('is_active', 1)
            ->when($request->query('query'), function ($q) use ($request) {
                $search = $request->query('query');
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('sub_title', 'LIKE', "%{$search}%")
                        ->orWhere('blog_content', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        $trendingBlogs = Blog::with('category')
            ->orderBy('views', 'desc')
            ->get();

        $blogs = Blog::with(['category', 'author'])->latest()->get();

        return view('frontend.menu-blog', [
            'menu'          => $menu,
            'categoryBlogs' => $menuBlogs,
            'trendingBlogs' => $trendingBlogs,
            'blogs'         => $blogs
        ]);
    }

    public function blogDetail($id)
    {
        $blog = Blog::with(['category', 'author', 'comments'])->findOrFail($id);
//        $categories = Category::withCount('blogs')->get();
        $blogs = Blog::where('id', '!=', $id)->latest()->get();
        $comments = Comment::where('blog_id', $id)->latest()->get();
        $commentCount = $comments->count();
        $blog->increment('views');
        $trendingBlogs = Blog::with('category')->orderBy('views', 'desc')->get();

        return view('frontend.blog-detail', compact([
            'blog',
            'blogs',
            'trendingBlogs',
//            'categories',
            'comments',
            'commentCount',
        ]));
    }

    public function contact()
    {
        $brands = Brand::latest()->get();
        $location = Location::where('is_active', 1)->first();

        return view('frontend.contact', compact([
            'location', 'brands',
        ]));
    }

    public function imageGallery()
    {
        $imageGalleries = ImageGallery::latest()->get();
        return view('frontend.image-gallery', compact('imageGalleries'));
    }

    public function career(Career $career)
    {
        $careers = Career::where('is_active', 1)->latest()->get();
        return view('frontend.career', compact('careers', 'career'));
    }

    public function careerDetail(Career $career)
    {
        return view('frontend.career-detail', compact('career'));
    }

    public function getCategories($menu_id)
    {
        $categories = Category::where('menu_id', $menu_id)->get();
        return response()->json($categories);
    }

    public function ajaxSearch(Request $request)
    {
        $search = $request->query('query');

        $blogs = Blog::with(['category', 'author'])
            ->where('is_active', 1)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('sub_title', 'LIKE', "%{$search}%")
                        ->orWhere('blog_content', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('partials.blog-list', compact('blogs'))->render();
    }

    public function ajaxHomeSearch(Request $request)
    {
        $search = $request->query('query');

        $blogs = Blog::with(['category', 'author'])
            ->where('is_active', 1)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('sub_title', 'LIKE', "%{$search}%")
                        ->orWhere('blog_content', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        $mainBlogsHtml = view('partials.home-main-blogs', compact('blogs'))->render();
        $moreNewsHtml = view('partials.home-more-news', compact('blogs'))->render();

        return response()->json([
            'mainBlogs' => $mainBlogsHtml,
            'moreNews' => $moreNewsHtml,
        ]);
    }

}
