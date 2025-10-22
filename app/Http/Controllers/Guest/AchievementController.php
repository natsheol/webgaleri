<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\AchievementLike;
use App\Models\AchievementComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->paginate(12); // 12 per page
        return view('guest.achievements.index', compact('achievements'));
    }

    public function show($id)
    {
        $achievement = Achievement::findOrFail($id);
        return view('guest.achievements.show', compact('achievement'));
    }

    public function toggleLike(Request $request, $achievementId)
    {
        $achievement = Achievement::findOrFail($achievementId);
        $sessionId = $request->session()->getId();
        $ipAddress = $request->ip();

        // Check if already liked
        $existingLike = AchievementLike::where('achievement_id', $achievementId)
            ->where('session_id', $sessionId)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $liked = false;
        } else {
            // Like
            AchievementLike::create([
                'achievement_id' => $achievementId,
                'user_id' => auth('web')->id(),
                'session_id' => $sessionId,
                'ip_address' => $ipAddress,
            ]);
            $liked = true;
        }

        $likeCount = AchievementLike::where('achievement_id', $achievementId)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'like_count' => $likeCount,
        ]);
    }

    public function getLikeStatus(Request $request, $achievementId)
    {
        $achievement = Achievement::findOrFail($achievementId);
        $sessionId = $request->session()->getId();
        $userId = auth()->id();

        $query = AchievementLike::where('achievement_id', $achievementId);
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }
        $liked = $query->exists();

        $likeCount = AchievementLike::where('achievement_id', $achievementId)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'like_count' => $likeCount,
        ]);
    }

    public function getComments($achievementId)
    {
        $achievement = Achievement::findOrFail($achievementId);
        
        $comments = AchievementComment::where('achievement_id', $achievementId)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'comments' => $comments,
        ]);
    }

    public function storeComment(Request $request, $achievementId)
    {
        $achievement = Achievement::findOrFail($achievementId);

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

        $comment = AchievementComment::create([
            'achievement_id' => $achievementId,
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
