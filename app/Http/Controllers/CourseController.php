<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
}
