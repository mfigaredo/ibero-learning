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
}
