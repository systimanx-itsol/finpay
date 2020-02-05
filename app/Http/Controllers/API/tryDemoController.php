<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\tryDemo;
use App\Models\trydemo_company;
use Illuminate\Http\Request;
use Auth;
use Input;
use Response;
use File;

class tryDemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trydemo(Request $request)
    {
   $formData = $request->all();     
         //echo "<pre>";print_r( $formData);exit;
 
      //echo "<pre>";print_r($phone);exit;

        $tryDemoCompany =  trydemo_company::create([
            
            "company_name" => $formData["company"],
            "name" => $formData["name"],
            "email" => $formData["email"],
            
        ]);
     
            
        return response::json(['error' => false, 'message' =>"Try Your invoice"], 200);    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
        $formData = $request->all();     
         //echo "<pre>";print_r( $formData);exit;
 
      //echo "<pre>";print_r($phone);exit;

        $tryDemoprivate =  tryDemo::create([
            
            "name" => $formData["name"],
            "email" => $formData["email"],
            
        ]);
     
            
        return response::json(['error' => false, 'message' =>"Try Your invoice"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tryDemo  $tryDemo
     * @return \Illuminate\Http\Response
     */
    public function show(tryDemo $tryDemo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tryDemo  $tryDemo
     * @return \Illuminate\Http\Response
     */
    public function edit(tryDemo $tryDemo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tryDemo  $tryDemo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tryDemo $tryDemo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tryDemo  $tryDemo
     * @return \Illuminate\Http\Response
     */
    public function destroy(tryDemo $tryDemo)
    {
        //
    }
}
