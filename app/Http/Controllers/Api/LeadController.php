<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Mail\NewLeadMail;
use App\Models\Lead;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        // redirect if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        /* $data = $request->all();
        $lead = new Lead();
        $lead->fill($data);
        $lead->save(); */



        // save the new lead in the db - pacificdev
        $lead = Lead::create($request->all());

        Mail::to('info@boolpress.com')->send(new NewLeadMail($lead));

        return response()->json(
            [
                'success' => true,
                'message' => 'Form sent successfully ✅'
            ]
        );
    }
}
