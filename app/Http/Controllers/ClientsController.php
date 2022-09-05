<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientsController extends Controller
{


    public function index(){
        return Client::all();
    }

    public function create(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'barangay' => 'required|string',
            'municipality' => 'required|string',
            'province' => 'required|string'
        ]);

        $client = Client::create([
            'id' => Str::uuid(),
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name'=> $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'barangay' => $request->barangay,
            'municipality' => $request->municipality,
            'province' => $request->province
        ]);

        if($client) return response()->json(['status'=>'success', 'message' => 'Successfully created a client.']);
        return response()->json(['status'=>'failed', 'message'=>'Failed to create a client.']);
    }
}
