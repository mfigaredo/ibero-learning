<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('courses')->get();
        $featuredCourses = Course::withCount('students')
            ->with('categories', 'teacher', 'wishlists')
            ->whereFeatured(true)
            ->whereStatus(Course::PUBLISHED)
            ->get();

        $total = $featuredCourses->count();

        return view('welcome', compact('categories', 'featuredCourses', 'total'));
    }
}
