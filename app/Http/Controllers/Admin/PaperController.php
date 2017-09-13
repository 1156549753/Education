<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaperController extends Controller
{
    public function index(Request $request)
    {
        $info = Paper::get();
        return view('admin/paper/index',compact('info'));
    }
}
