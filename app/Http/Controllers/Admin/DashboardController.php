<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {

        $project_count = Project::count();
        $last_project = Project::orderBy('id', 'desc')->first();

        return view('admin.home', compact('project_count', 'last_project'));
    }
}
