<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Technology;


class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return response()->json([
            'success' => true,
            'result' => $technologies
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $technology = Technology::with('projects', 'projects.type', 'projects.technologies')->where('slug', $slug)->first();

        if ($technology) {
            return response()->json([
                'success' => true,
                'result' => $technology
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'technology not found'
            ]);
        }
    }
}
