<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;
use App\Services\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function purchaseCourse(User $user, Course $course) {
        $isTeacher = $user->id === $course->user_id;
        $coursePurchased = $course->students->contains($user->id);
        $courseInCart = (new Cart)->courseInCart($course);
        return !$isTeacher && !$coursePurchased && !$courseInCart;
    }

    public function review(User $user, Course $course) {
        $coursePurchased = $course->students->contains($user->id);
        if(!$coursePurchased) {
            session()->flash('message',['danger', __('No has comprado el curso.')]);
        }
        $reviewed = $course->reviews->contains('user_id', $user->id);
        if($reviewed) {
            session()->flash('message',['danger', __('Ya valoraste este curso.')]);
        }
        return $coursePurchased && !$reviewed;
    }
}
