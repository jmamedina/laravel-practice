<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getAllDepartments(Request $request){
        $departments = Department::all();
        return view('index', ['departments' => $departments]);
    }
}
