<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use App\Services\Cart;
use App\Helpers\Currency;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::filtered();
        // $session = session('search[courses]');
        // dd(session('search[courses]'));
        $count = $courses->count();
        return view('learning.courses.index', compact('courses'));

    }

    public function search() {
        session()->remove('search[courses]');
        if(request('search')) {
            session()->put('search[courses]', request('search'));
            session()->save();
        }
        return redirect(route('courses.index'));
    }

    public function show(Course $course) {
        $course->load('units', 'students', 'reviews');
        // dd($course);
        // $amount = 12.5;
        // dd(Currency::formatCurrency($amount));
        // dd( (new Cart)->courseInCart($course) );
        return view('learning.courses.show', compact('course'));
    }

    public function learn(Course $course) {
        $course->load('units');
        return view('learning.courses.learn', compact('course'));
    }

    public function createReview(Course $course) {
        
        // $this->authorize('review', $course);
        if( auth()->user()->cannot('review', $course)) {
            return redirect(route('courses.show', ['course' => $course]));
            // message se flashea a sesión en CoursePolicy.        
        }
        return view('learning.courses.reviews.form', compact('course'));
    }

    public function storeReview(Course $course) {
        
        if( auth()->user()->cannot('review', $course)) {
            return redirect(route('courses.show', ['course' => $course]));
            // message se flashea a sesión en CoursePolicy.
        }

        $this->validate(request(), [
            "review" => "required|string|min:10",
            "stars" => "required"
        ]);

        $review = Review::create([
            "user_id" => auth()->id(),
            "course_id" => $course->id,
            "stars" => (int) request("stars"),
            "review" => request("review"),
            "created_at" => now()
        ]);

        return redirect(route("courses.learn", ["course" => $course]))
            ->with("message", ["success", __("Muchas gracias por valorar el curso")]);
    }

    
}
