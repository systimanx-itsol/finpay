<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\System;
use App\Models\Currencies;
use Illuminate\Http\Request;
use Response;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $System = System::select('id', 'key', 'value')->get();
        $SystemArray1 = array();
        foreach ($System as $key => $system) {

            $SystemArray1[$system->key] = $system->value;
        }
       // echo "<pre>Val";print_r($SystemArray1);exit;
        return response()->json(['status' => 1, 'message' => "success", "system_unitDetails" => $SystemArray1], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $formData = $request->all();
         
        foreach ($formData as $key => $value) {
        System::where(['key' => $key])->update([

                    "key" => $key,
                    "value" => $value,
                ]);
            
               
            }
         return response()->json(['status' => 1, 'message' => " Settings updated Successfully.."], 200); 
         
        }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
} 