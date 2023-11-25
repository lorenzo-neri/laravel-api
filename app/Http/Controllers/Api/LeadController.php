<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Mail\NewContact;
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

        $data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // save the new lead in the db - pacificdev
        #$new_lead = Lead::create($request->all());

        Mail::to('info@boolpress.com')->send(new NewContact($new_lead));

        return response()->json(
            [
                'success' => true,
                'message' => 'Form sent successfully ✅'
            ]
        );
    }
}
