<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TaxRate;
use Input;
use Response;

class TaxrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Get(
     *          path="/Taxrate",
     *          tags={"SETTINGS - TAX RATES"},
     *          summary="Taxrate",
     *          operationId="bid",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
    public function index()
    {
        //echo "<pre>";print_r($request->all());exit;
        $TaxRate = TaxRate::select('id','name','percentage','calculate_as_vat_gst','compound')->where('deleted_at', '=', NULL)->get(); 
        
        $TaxRateArray = array();
        foreach($TaxRate as $value){
          $TaxRateArray[] = [
            "id" => $value->id,
            "name" => $value->name,
            'percentage' => $value->percentage,
            "calculate_as_vat_gst" => $value->calculate_as_vat_gst,
            "compound" => $value->compound
          ];
        }
        return response::json(['error' => false, 'message' =>"success", "TaxRateDetails" => $TaxRateArray], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     *
     * @SWG\Post(
     *     path="/Taxrate",
     *     description="Tax Store",
     *     tags={"SETTINGS - TAX RATES"},
     *     summary="Tax Store",
     *      @SWG\Parameter(
     *          name="name",
     *          description="TaxRate Name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="compound",
     *          description="Compound",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="percentage",
     *          description="Tax Percentage",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     *    @SWG\Parameter(
     *          name="calculate_as_vat_gst",
     *          description="Calculate as VAT/GST",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     * 
     *      @SWG\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="auth number",
     *          required=true,
     *          type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     * )
     */
    public function store(Request $request)
    {
              
  	// echo "<pre>";print_r($request->all());exit;
       $formData = $request->all();     

       $taxname = $formData ['name'];
          // echo "<pre>";print_R($taxname);exit;                          
           $taxcount = TaxRate::where ('name' , '=' , $taxname )->count();    
           //echo "<pre>";print_R($taxname);exit;   
           if ($taxcount == 0){ 

       TaxRate::create([
         "name" => $formData["name"],
         "percentage" => $formData["percentage"],
         "calculate_as_vat_gst" => $formData["calculate_as_vat_gst"],
         "compound" => $formData["compound"],
         
     ]);
     return response::json(['status' => 1, 'message' =>"TaxRate Stored successfully"], 200);
       }
     else{
        return response()->json(['status' => 0, 'message' => "Tax Rates Name Already exists"]);
    }  
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Get(
     *          path="/Taxrate/{id}",
     *          tags={"SETTINGS - TAX RATES"},
     *          summary="Tax Edit",
     *          operationId="Teid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Tax Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
    
    public function show($id)
    {
         //echo "<pre>";print_r($request->all());exit;
        $TaxRate = TaxRate::select('id','name','percentage','calculate_as_vat_gst','compound')->where('id', $id)->first(); 
        $TaxRateArray = [
          "id" => $TaxRate->id,
          "name" => $TaxRate->name,
          'percentage' => $TaxRate->percentage,
          "calculate_as_vat_gst" => $TaxRate->calculate_as_vat_gst,
          "compound" => $TaxRate->compound
        ];
        
    return response::json(['error' => false, 'message' =>"success", "TaxRateDetails" => $TaxRateArray], 200);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     *
     * @SWG\Post(
     *     path="/Taxrate/{id}",
     *     description="Tax Update",
     *     tags={"SETTINGS - TAX RATES"},
     *     summary="Tax Update",
      *  @SWG\Parameter(
     *              name="id",
     *              description="Tax Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *      @SWG\Parameter(
     *          name="name",
     *          description="TaxRate Name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="compound",
     *          description="Compound",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="percentage",
     *          description="Tax Percentage",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     *    @SWG\Parameter(
     *          name="calculate_as_vat_gst",
     *          description="Calculate as VAT/GST",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="auth number",
     *          required=true,
     *          type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     * )
     */
    public function update(Request $request, $id)
    {

      $formData = $request->all();

       $taxCounts = TaxRate::where([['id' , '<>' , $id]]);
            //echo "<pre>";print_r(count($ProductunitCounts));
        $taxratesCounts = $taxCounts->where(
            [
                ['name', '=', $formData["name"]],
            ]
           
            );//->get();
            //echo "<pre>";print_r($taxCounts);exit;
        $taxRatesCounts = $taxratesCounts->count();
        //echo "<pre>";print_r($taxRatesCounts);exit;
        if($taxRatesCounts == 0){
         // $id = $request->input('id');
        // echo "<pre>";print_r($request->all());exit;
        //$formData = $request->all(); 
        $formdata = [
          'name' => $request->input('name'),
          'percentage' => $request->input('percentage'),
          'calculate_as_vat_gst' => $request->input('calculate_as_vat_gst'),
          'compound' => $request->input('compound')
];  
          $TaxRate = TaxRate::where('id', $id)->update($formdata);
          
        
          //echo "<pre>";print_R($request->input('name'));exit;                          
         

return response::json(['status' => 1, 'message' =>"TaxRate Updated successfully"], 200);
    }else{
        return response()->json(['status' => 0, 'message' => "Tax Rates Name Already exists"]);
    }  
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      /**
     * @SWG\Delete(
     *          path="/Taxrate/{id}",
     *          tags={"SETTINGS - TAX RATES"},
     *          summary="Tax Delete",
     *          operationId="Tdid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Tax Delete",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
    public function destroy($id)
    {
        //echo $id;exit;
   $TaxRate = TaxRate::where('id', $id)->update(['deleted_at' => date('y-m-d')]);
   return response::json(['error' => false, 'message' =>"TaxRate Deleted successfully"], 200);  
    }
}
