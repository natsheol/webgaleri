<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\FacilityCategory;
use App\Models\FacilityPhoto;
use App\Models\FacilityPhotoLike;
use App\Models\FacilityPhotoComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    public function index()
    {
        // Ambil semua kategori tanpa filter is_active
        $categories = FacilityCategory::with('coverPhoto')->get();

        return view('guest.facilities.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = FacilityCategory::with('photos')->where('slug', $slug)->firstOrFail();

        return view('guest.facilities.show', compact('category'));
    }

    public function trackPhotoView(Request $request, $photoId)
    {
        $photo = FacilityPhoto::findOrFail($photoId);
        
        // Increment view count
        $photo->increment('view_count');
        
        return response()->json([
            'success' => true,
            'view_count' => $photo->view_count
        ]);
    }

    public function toggleLike(Request $request, $photoId)
    {
        $photo = FacilityPhoto::findOrFail($photoId);
        $sessionId = $request->session()->getId();
        $ipAddress = $request->ip();
        $userId = auth('web')->id(); // Get logged in user ID

        // Check if already liked (by user_id if logged in, otherwise by session)
        $query = FacilityPhotoLike::where('facility_photo_id', $photoId);
        
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }
        
        $existingLike = $query->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $liked = false;
        } else {
            // Like
            FacilityPhotoLike::create([
                'facility_photo_id' => $photoId,
                'user_id' => $userId,
                'session_id' => $sessionId,
                'ip_address' => $ipAddress,
            ]);
            $liked = true;
        }

        $likeCount = FacilityPhotoLike::where('facility_photo_id', $photoId)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'like_count' => $likeCount,
        ]);
    }

    public function getComments($photoId)
    {
        $photo = FacilityPhoto::findOrFail($photoId);
        
        $comments = FacilityPhotoComment::where('facility_photo_id', $photoId)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'comments' => $comments,
        ]);
    }

    public function storeComment(Request $request, $photoId)
    {
        $photo = FacilityPhoto::findOrFail($photoId);

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

        $comment = FacilityPhotoComment::create([
            'facility_photo_id' => $photoId,
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

    public function getLikeStatus(Request $request, $photoId)
    {
        $photo = FacilityPhoto::findOrFail($photoId);
        $sessionId = $request->session()->getId();

        $liked = FacilityPhotoLike::where('facility_photo_id', $photoId)
            ->where('session_id', $sessionId)
            ->exists();

        $likeCount = FacilityPhotoLike::where('facility_photo_id', $photoId)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'like_count' => $likeCount,
        ]);
    }
}
