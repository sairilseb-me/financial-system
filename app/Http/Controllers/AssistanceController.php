<?php

namespace App\Http\Controllers;

use App\Models\Assistance;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;
use UnexpectedValueException;

class AssistanceController extends Controller
{
    public function index(){
        return Assistance::with('patient')->with('client')->get();
    }

    public function create(Request $request){

        $request->validate([
            'client_id' => 'required|uuid',
            'patient_id' => 'required|uuid',
            'assistance' => 'required|string',
            'category' => 'required|string',
            'relation_patient' => 'required|string',
            'amount' => 'required|numeric',
            'hospital' => 'required|string',
            'hospital_address' => 'required|string',
            'doctor_name' => 'required|string',
            'diagnosis' => 'required|string',
            'date_time_requested' => 'required|date'
        ]);

        $assistance = Assistance::create([
            'client_id' => $request->client_id,
            'patient_id' => $request->patient_id,
            'assistance' => $request->assistance,
            'category' => $request->category,
            'relation_patient' => $request->relation_patient,
            'amount' => $request->amount,
            'hospital' => $request->hospital,
            'hospital_address'=> $request->hospital_address,
            'doctor_name' => $request->doctor_name,
            'diagnosis' => $request->diagnosis,
            'date_time_requested' => $request->date_time_requested,
            'remarks' => $request->remarks,
        ]);

        if(!$assistance) return response()->json(['status'=> 'Failed', 'Failed to create an Assistance data.']);
        return response()->json(['status' => 'Success', 'Successfully create an Assistance Data']);
    }

    public function getDataBetweenDates($from, $to){

        $assistanceDates = Assistance::selectRaw('count(assistance) as number_of_assistance, MonthName(date_time_requested) as Month_Name')
        ->whereBetween('date_time_requested', [$from, $to])
        ->groupBy('Month_Name')
        ->get();
        
        if($assistanceDates) return response()->json(['status'=>'success', 'assistanceDates'=>$assistanceDates]);
        return response()->json(['status'=>'failed', 'message'=>'Cannot load data.' ]);
    }

    public function show($id){
        return Assistance::where('id', '=', $id)->with('patient')->with('client')->first();
    }

}
