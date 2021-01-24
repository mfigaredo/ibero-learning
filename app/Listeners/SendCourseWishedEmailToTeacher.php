<?php

namespace App\Listeners;

use App\Mail\StudentWishCourse;
use Illuminate\Support\Facades\Mail;
use App\Events\CourseAddedToWishlist;

class SendCourseWishedEmailToTeacher
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CourseAddedToWishlist  $event
     * @return void
     */
    public function handle(CourseAddedToWishlist $event)
    {
        Mail::to($event->wishlist->course->teacher->email)
            ->send(new StudentWishCourse($event->wishlist));
    }
}
