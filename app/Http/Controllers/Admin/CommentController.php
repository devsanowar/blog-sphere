<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\File;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('admin.layouts.pages.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'comment_text' => 'required|string|max:1000',
        ]);

        $imagePath = auth()->user()->image ?? null;

        Comment::create([
            'blog_id' => $request->blog_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment_text' => $request->comment_text,
            'image' => $imagePath,
        ]);

        return back()->with('message', 'Comment submitted successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->image && file_exists(public_path($comment->image))) {
            File::delete(public_path($comment->image));
        }
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
