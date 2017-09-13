<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Course;

class CourseController extends Controller
{
    public function detail(Request $request, Course $course){
        return view('home/course/detail',compact('course'));
    }
}
