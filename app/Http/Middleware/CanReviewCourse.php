<?php

namespace App\Http\Middleware;

use Closure;

class CanReviewCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $course = $request->route()->parameter('course');
        $reviewed = $course->reviews->contains('user_id', auth()->id());
        if($reviewed) {
            return redirect(route('courses.learn', ['course' => $course]))->with('message',['danger', __('No puedes valorar este curso, ya lo has hecho antes.')]);
        }
        $coursePurchased = $course->students->contains(auth()->id());
        if(!$coursePurchased) {
            return redirect(route('courses.show', ['course' => $course]))->with('message',['danger', __('No puedes valorar este curso, no lo has comprado aún.')]);
        }
        return $next($request);
    }
}
