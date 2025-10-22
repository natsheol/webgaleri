<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\HogwartsProphet;
use App\Models\HogwartsProphetLike;
use App\Models\HogwartsProphetComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HogwartsProphetController extends Controller
{
    public function index()
    {
        // Ambil berita terbaru dengan pagination
        $news = HogwartsProphet::latest()->paginate(6);

        return view('guest.hogwarts-prophet.index', compact('news'));
    }

    public function show($id)
    {
        $hogwartsProphet = HogwartsProphet::findOrFail($id);

        return view('guest.hogwarts-prophet.show', compact('hogwartsProphet'));
    }

    public function toggleLike(Request $request, $articleId)
    {
        $article = HogwartsProphet::findOrFail($articleId);
        $sessionId = $request->session()->getId();
        $ipAddress = $request->ip();

        // Check if already liked
        $existingLike = HogwartsProphetLike::where('hogwarts_prophet_id', $articleId)
            ->where('session_id', $sessionId)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $liked = false;
        } else {
            // Like
            HogwartsProphetLike::create([
                'hogwarts_prophet_id' => $articleId,
                'user_id' => auth('web')->id(),
                'session_id' => $sessionId,
                'ip_address' => $ipAddress,
            ]);
            $liked = true;
        }

        $likeCount = HogwartsProphetLike::where('hogwarts_prophet_id', $articleId)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'like_count' => $likeCount,
        ]);
    }

    public function getLikeStatus(Request $request, $articleId)
    {
        $article = HogwartsProphet::findOrFail($articleId);
        $sessionId = $request->session()->getId();
        $userId = auth()->id();

        $query = HogwartsProphetLike::where('hogwarts_prophet_id', $articleId);
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }
        $liked = $query->exists();

        $likeCount = HogwartsProphetLike::where('hogwarts_prophet_id', $articleId)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'like_count' => $likeCount,
        ]);
    }

    public function getComments($articleId)
    {
        $article = HogwartsProphet::findOrFail($articleId);
        
        $comments = HogwartsProphetComment::where('hogwarts_prophet_id', $articleId)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'comments' => $comments,
        ]);
    }

    public function storeComment(Request $request, $articleId)
    {
        $article = HogwartsProphet::findOrFail($articleId);

        // Honeypot check
        if ($request->filled('website')) {
            return response()->json([
                'success' => false,
                'message' => 'Spam detected.'
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:100',
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $userId = auth('web')->id();
        $userName = auth('web')->check() ? auth('web')->user()->name : ($request->name ?: 'Anonymous');

        $comment = HogwartsProphetComment::create([
            'hogwarts_prophet_id' => $articleId,
            'user_id' => $userId,
            'name' => $userName,
            'content' => $request->content,
            'is_approved' => true, // Auto-approve
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment posted successfully!',
            'comment' => $comment,
        ], 201);
    }
}
