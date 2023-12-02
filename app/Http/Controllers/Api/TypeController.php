<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return response()->json([
            'success' => true,
            'result' => $types
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $type = Type::with('projects', 'projects.technologies', 'projects.type')->where('slug', $slug)->first();

        if ($type) {
            return response()->json([
                'success' => true,
                'result' => $type
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Type not found'
            ]);
        }
    }
}
