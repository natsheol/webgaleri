<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityPhotoComment;
use App\Models\FacilityPhotoLike;
use App\Models\HogwartsProphetComment;
use App\Models\HogwartsProphetLike;
use App\Models\AchievementComment;
use App\Models\AchievementLike;
use App\Models\FacilityPhoto;
use App\Models\HogwartsProphet;
use App\Models\Achievement;

class CommentManagementController extends Controller
{
    // Dashboard with statistics
    public function index()
    {
        $stats = [
            'facility_photos' => [
                'total_likes' => FacilityPhotoLike::count(),
                'total_comments' => FacilityPhotoComment::count(),
                'pending_comments' => FacilityPhotoComment::where('is_approved', false)->count(),
            ],
            'hogwarts_prophet' => [
                'total_likes' => HogwartsProphetLike::count(),
                'total_comments' => HogwartsProphetComment::count(),
                'pending_comments' => HogwartsProphetComment::where('is_approved', false)->count(),
            ],
            'achievements' => [
                'total_likes' => AchievementLike::count(),
                'total_comments' => AchievementComment::count(),
                'pending_comments' => AchievementComment::where('is_approved', false)->count(),
            ],
        ];

        return view('admin.comments.index', compact('stats'));
    }

    // Facility Photo Comments
    public function facilityComments()
    {
        $comments = FacilityPhotoComment::with('photo.category')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.comments.facility-photos', compact('comments'));
    }

    // HogwartsProphet Comments
    public function prophetComments()
    {
        $comments = HogwartsProphetComment::with('article')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.comments.hogwarts-prophet', compact('comments'));
    }

    // Achievement Comments
    public function achievementComments()
    {
        $comments = AchievementComment::with('achievement')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.comments.achievements', compact('comments'));
    }

    // Delete Facility Photo Comment
    public function deleteFacilityComment($id)
    {
        $comment = FacilityPhotoComment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }

    // Delete HogwartsProphet Comment
    public function deleteProphetComment($id)
    {
        $comment = HogwartsProphetComment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }

    // Delete Achievement Comment
    public function deleteAchievementComment($id)
    {
        $comment = AchievementComment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }

    // Toggle Approval Status
    public function toggleApproval(Request $request)
    {
        $type = $request->type;
        $id = $request->id;

        switch ($type) {
            case 'facility':
                $comment = FacilityPhotoComment::findOrFail($id);
                break;
            case 'prophet':
                $comment = HogwartsProphetComment::findOrFail($id);
                break;
            case 'achievement':
                $comment = AchievementComment::findOrFail($id);
                break;
            default:
                return response()->json(['success' => false], 400);
        }

        $comment->is_approved = !$comment->is_approved;
        $comment->save();

        return response()->json([
            'success' => true,
            'is_approved' => $comment->is_approved
        ]);
    }

    // Likes Statistics
    public function likesStats()
    {
        // Top liked facility photos
        $topFacilityPhotos = FacilityPhoto::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit(10)
            ->get();

        // Top liked articles
        $topArticles = HogwartsProphet::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit(10)
            ->get();

        // Top liked achievements
        $topAchievements = Achievement::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit(10)
            ->get();

        return view('admin.comments.likes-stats', compact('topFacilityPhotos', 'topArticles', 'topAchievements'));
    }
}
