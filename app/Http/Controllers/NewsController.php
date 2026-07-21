<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsComment;
use App\Models\NewsLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('category')->active();

        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $news = $query->latest()->paginate(12);
        $categories = NewsCategory::withCount('news')->get();

        return view('news.index', compact('news', 'categories'));
    }

    public function show($slug)
    {
        $news = News::with(['category', 'comments.replies'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        $news->incrementViewCount();

        $comments = $news->comments()
            ->with('replies')
            ->approved()
            ->latest()
            ->get();

        $relatedNews = News::with('category')
            ->where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->active()
            ->take(4)
            ->get();

        return view('news.show', compact('news', 'comments', 'relatedNews'));
    }

    public function like($id)
    {
        $news = News::findOrFail($id);
        $ipAddress = request()->ip();

        $existingLike = NewsLike::where('news_id', $news->id)
            ->where('ip_address', $ipAddress)
            ->first();

        if ($existingLike) {
            return response()->json([
                'success' => false,
                'message' => 'Already liked',
                'like_count' => $news->like_count
            ]);
        }

        NewsLike::create([
            'news_id' => $news->id,
            'ip_address' => $ipAddress,
        ]);

        $news->increment('like_count');

        return response()->json([
            'success' => true,
            'message' => 'Liked successfully',
            'like_count' => $news->fresh()->like_count
        ]);
    }

    public function comment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:news_comments,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $news = News::findOrFail($id);

        NewsComment::create([
            'news_id' => $news->id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'is_approved' => false, // Requires admin approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment submitted successfully. It will be visible after approval.'
        ]);
    }
}
