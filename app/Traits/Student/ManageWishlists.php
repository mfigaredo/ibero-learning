<?php 

namespace App\Traits\Student;

use App\Events\CourseAddedToWishlist;
use App\Models\Course;
use App\Models\Wishlist;

trait ManageWishlists 
{
    public function toggleItemOnWishlist(Course $course) {
        if(request()->ajax()) {
            // $courseInMyWishlist = Wishlist::where('user_id', auth()->id())->where('course_id', $course->id)->first();
            $courseInMyWishlist = Wishlist::where('course_id', $course->id)->first();
            if(!$courseInMyWishlist) {
                $wishlist = Wishlist::create([
                    'course_id' => $course->id,
                ]);
                $wishlist->load('user', 'course.teacher');
                event(new CourseAddedToWishlist($wishlist));
                $icon_remove = 'fa-heart-o';
                $icon_add = 'fa-heart';
            } else {
                $courseInMyWishlist->delete();
                $icon_remove = 'fa-heart';
                $icon_add = 'fa-heart-o';
            }
            return response([
                'message' => 'success',
                'icon_remove' => $icon_remove,
                'icon_add' => $icon_add,
            ]);
        }
        return abort(401);
    }

    public function meWishlist() {
        $wishlist = Wishlist::with('course', 'course.students', 'course.teacher')->paginate();
        // dd($wishlist);
        return view('student.wishlist.index', compact('wishlist'));
    }

    public function destroyWishlistItem(int $id) {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        session()->flash('message', ['success', __('Has eliminado el curso de tu lista de deseos')]);
        return redirect(route('student.wishlist.me'));
    }
}