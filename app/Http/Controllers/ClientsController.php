<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientsController extends Controller
{


    public function index(){
        $client = Client::paginate(5);
        $pagination = [
            'total' => $client->total(),
            'per_page' => $client->perPage(),
            'current_page' => $client->currentPage(),
            'last_page' => $client->lastPage(),
            'from' => $client->firstItem(),
            'to' => $client->lastItem()
        ];
        return response()->json(['pagination' => $pagination, 'data' => $client]);
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

        try{
            if($client) return response()->json(['status'=>'success', 'message' => 'Successfully created a client.']);
        }catch(Exception $err){
            return response()->json(['status'=>'failed', 'message'=> $err->getMessage()]);
        }
    }

    public function show($lastname){
       if($lastname !== '') return Client::where('last_name','LIKE', '%'.$lastname.'%')->paginate(5);
       return Client::paginate(5);
    }

    public function edit($id){
        $client = Client::where('id', $id)->with(['assistances' => function($q){
            $q->with('patient');
        }])->first();
        if($client) return response()->json(['status'=>'success','client'=>$client]);
        return response()->json(['status'=>'failed', 'message'=>'Failed to find client data.']);
    }

    public function update(Request $request, $id){

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

        $client = Client::where('id', $id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'barangay' => $request->barangay,
            'municipality' => $request->municipality,
            'province' => $request->province,
        ]);
        if($client) return response()->json(['status'=>'success', 'message'=>'Successfully updated a client data.']);
        return response()->json(['status'=>'failed', 'message'=>'Failed to updated client']);
    }

    public function destroy($id){
        $client = Client::find($id)->delete();
        if($client) return response()->json(['status'=>'success', 'message'=>'Successfully deleted a client.']);
        return response()->json(['status'=>'failed', 'message'=>'Failed to delete a client.']);
    }
}
