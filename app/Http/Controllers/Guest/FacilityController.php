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
    // LIST categories + photos for Alpine
    public function index()
    {
        $categories = FacilityCategory::with(['photos', 'coverPhoto'])->get();

        $categoriesData = $categories->map(function ($c) {
            return [
                'id' => $c->id,
                'name' => $c->name,
                'slug' => $c->slug ?? null,
                'cover' => $c->coverPhoto?->image,
                'photos' => $c->photos->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'name' => $p->name,
                        'image' => $p->image,
                        'caption' => $p->caption ?? '',
                        'description' => $p->description ?? '',
                    ];
                })->toArray(),
            ];
        })->toArray();

        return view('guest.facilities.index', [
            'categoriesData' => $categoriesData
        ]);
    }

    // OPTIONAL: single category page
    public function show($slug)
    {
        $category = FacilityCategory::with('photos')->where('slug', $slug)->firstOrFail();
        return view('guest.facilities.show', compact('category'));
    }

    // public: track view count
    public function trackPhotoView(Request $request, $photoId)
    {
        $photo = FacilityPhoto::findOrFail($photoId);
        $photo->increment('view_count');

        return response()->json([
            'success' => true,
            'view_count' => $photo->view_count
        ]);
    }

    // return whether current logged user liked + total count
    public function getLikeStatus(Request $request, $photoId)
    {
        $photo = FacilityPhoto::findOrFail($photoId);

        $liked = false;
        if (auth('web')->check()) {
            $liked = FacilityPhotoLike::where('facility_photo_id', $photoId)
                ->where('user_id', auth('web')->id())
                ->exists();
        }

        return response()->json([
            'success' => true,
            'liked' => (bool)$liked,
            'like_count' => FacilityPhotoLike::where('facility_photo_id', $photoId)->count(),
        ]);
    }

    // toggle like (requires auth by your routes)
    public function toggleLike(Request $request, $photoId)
    {
        if (!auth('web')->check()) {
            return response()->json([
                'success' => false,
                'redirect' => route('login'),
            ], 401);
        }

        $photo = FacilityPhoto::findOrFail($photoId);
        $user = auth('web')->user();
        $sessionId = $request->session()->getId();

        // Find existing like by either current user or current session (to prevent duplicates)
        $existing = FacilityPhotoLike::where('facility_photo_id', $photoId)
            ->where(function($q) use ($user, $sessionId) {
                $q->where('user_id', $user->id)
                  ->orWhere('session_id', $sessionId);
            })
            ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            FacilityPhotoLike::create([
                'facility_photo_id' => $photoId,
                'user_id' => $user->id,
                'session_id' => $sessionId,
                'ip_address' => $request->ip(),
            ]);
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'like_count' => FacilityPhotoLike::where('facility_photo_id', $photoId)->count(),
        ]);
    }


    // get approved comments for a photo (public)
    public function getComments($photoId)
    {
        $comments = FacilityPhotoComment::where('facility_photo_id', $photoId)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'user_id', 'name', 'content', 'created_at']);

        // normalize to simple array for JS
        $commentsArray = $comments->map(function ($c) {
            return [
                'id' => $c->id,
                'user_id' => $c->user_id,
                'name' => $c->name ?? 'Guest',
                'content' => $c->content,
                'created_at' => $c->created_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'success' => true,
            'comments' => $commentsArray,
        ]);
    }

    // store comment (your routes protect it with auth middleware)
    public function storeComment(Request $request, $photoId)
    {
        if (!auth('web')->check()) {
            return response()->json([
                'success' => false,
                'redirect' => route('user.login'),
                'message' => 'Please login to comment.'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $photo = FacilityPhoto::findOrFail($photoId);
        $user = auth('web')->user();

        $comment = FacilityPhotoComment::create([
            'facility_photo_id' => $photoId,
            'user_id' => $user->id,
            'name' => $user->name,
            'content' => $request->input('content'),
            'is_approved' => true,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment posted successfully!',
            'comment' => [
                'id' => $comment->id,
                'user_id' => $comment->user_id,
                'name' => $comment->name,
                'content' => $comment->content,
                'created_at' => $comment->created_at->toDateTimeString(),
            ],
        ], 201);
    }
}
