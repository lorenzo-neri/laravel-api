<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'result' => Project::with('type', 'technologies')->paginate(10)
        ]);
    }
}
