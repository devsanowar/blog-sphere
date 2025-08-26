<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Menu;
use App\Models\Review;
use App\Models\SendUsAMessage;
use App\Models\Subscriber;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return $this->dashboardView();
    }

    public function editorDashboard()
    {
        return $this->dashboardView();
    }

    public function userDashboard()
    {
        return $this->dashboardView();
    }

    public function dashboardView()
    {
        $totalMenu = Menu::where('is_active', 1)->count();
        $totalCategories = Category::where('is_active', 1)->count();
        $totalTeam = Team::count();
        $totalReviews = Review::count();
        $totalMessages = SendUsAMessage::count();
        $totalSubscribers = Subscriber::count();
        $totalComments = Comment::count();
        $totalJob = Career::where('is_active', 1)->count();
        $trendingBlogs = Blog::with('category')->orderBy('views', 'desc')->get();
        $allBlogs = Blog::where('is_active', 1)->count();
        $comments = Comment::latest()->get();

        // Prepare chart data (last 5 months)
        $months = [];
        $menuData = [];
        $categoryData = [];
        $blogData = [];
        $commentData = [];
        $subscriberData = [];

        for ($i = 4; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('F');
            $months[] = $month;

            $start = Carbon::now()->subMonths($i)->startOfMonth();
            $end = Carbon::now()->subMonths($i)->endOfMonth();

            $menuData[] = Menu::where('is_active', 1)->whereBetween('created_at', [$start, $end])->count();
            $categoryData[] = Category::where('is_active', 1)->whereBetween('created_at', [$start, $end])->count();
            $blogData[] = Blog::where('is_active', 1)->whereBetween('created_at', [$start, $end])->count();
            $commentData[] = Comment::whereBetween('created_at', [$start, $end])->count();
            $subscriberData[] = Subscriber::whereBetween('created_at', [$start, $end])->count();
        }

        return view('admin.dashboard', compact([
            'totalMenu','totalTeam','totalCategories',
            'totalReviews','comments',
            'totalMessages','totalSubscribers',
            'allBlogs','totalComments','totalJob','trendingBlogs',
            'months','menuData','categoryData','blogData','commentData','subscriberData',
        ]));
    }

}
