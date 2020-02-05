<?php

namespace App\Http\Controllers\API;



use App\Http\Controllers\Controller;
use App\Models\Freeinvoice;
use App\Models\freeinvoice_company;
use Illuminate\Http\Request;
use Auth;
use Input;
use Response;
use File;



class FreeinvoiceController extends Controller
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
    public function freeinvoice(Request $request)
    {
        $formData = $request->all();     
         //echo "<pre>";print_r( $formData);exit;
 
      //echo "<pre>";print_r($phone);exit;

        $tryDemoCompany =  freeinvoice_company::create([
            
            "company_name" => $formData["company"],
            "name" => $formData["name"],
            "email" => $formData["email"],
            
        ]);
     
            
        return response::json(['error' => false, 'message' =>"Try Your invoice"], 200);    

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
         //echo "<pre>";print_r( $formData);exit;
 
      //echo "<pre>";print_r($phone);exit;

        $tryDemoprivate =  Freeinvoice::create([
            
            "name" => $formData["name"],
            "email" => $formData["email"],
            
        ]);
     
            
        return response::json(['error' => false, 'message' =>"Try Your invoice"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Freeinvoice  $freeinvoice
     * @return \Illuminate\Http\Response
     */
    public function show(Freeinvoice $freeinvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Freeinvoice  $freeinvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Freeinvoice $freeinvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Freeinvoice  $freeinvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Freeinvoice $freeinvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Freeinvoice  $freeinvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Freeinvoice $freeinvoice)
    {
        //
    }
}
