<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\User;
use App\Models\Topic;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\Topic as TopicResource;
use App\Http\Resources\User as UserResource;

class TopicController extends Controller
{
    public function index(Course $course) {
        return view('learning.topics.index', compact('course'));
    }

    public function json(Course $course) {
        if(request()->ajax()) {
            $topics = Topic::where('course_id', $course->id)
                ->with('user', 'course.teacher')
                ->withCount('replies')
                ->orderBy('created_at', 'DESC')
                ->paginate();
            return TopicResource::collection($topics)->additional([
                // 'meta' => [
                    'teacher' => new UserResource($course->teacher),
                // ],
            ]);
        }
        abort(401);
    }

    public function store(TopicRequest $request, Course $course) {
        Topic::create([
            'title' => $request->input('title'),
            'content' => clean($request->input('content')),
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'created_at' => now(),
        ]);
        return response()->json(['message' => 'success']);
    }
}
