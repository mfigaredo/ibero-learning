<?php

namespace App\Http\Controllers;

// use App\Models\Course;

use Illuminate\Http\Request;
use App\Traits\Teacher\ManageUnits;
use App\Traits\Teacher\ManageCoupons;
use App\Traits\Teacher\ManageCourses;
use App\Traits\Teacher\ManageProfits;

class TeacherController extends Controller
{
    use ManageCourses, ManageUnits, ManageCoupons, ManageProfits;

    public function index() {
        return view('teacher.index');
    }

    
}
