<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Input;
use Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Get(
     *          path="/Company",
     *          tags={"COMPANY"},
     *          summary="Company Table",
     *          operationId="cid",
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
      $CompanyArray=array();
 //  echo "<pre>";print_r($request->all());exit;  
  $Company=Company::select('id', 'company_name','address','city','state','country','zipcode','phone','fax','mobile','website','default_invoice_template','default_quote_template')->where('deleted_at', '=', NULL)->get(); 
        foreach($Company as $value){
          array_push($CompanyArray,
          [
            "id" => $value->id,
            "company_name" => $value->company_name,
            "address" => $value->address,
            "city" => $value->city,
            "state" => $value->state,
            "country" => $value->country,
            "postal_code" => $value->zipcode, 
            "phone_number" => $value->phone,
            "fax_number" => $value->fax,
            "mobile_number" => $value->mobile,
            "website_address" => $value->website,
             "status" => $value->status == 1 ? "Active" : "Inactive",
            "default_invoice_template" => $value->default_invoice_template,
            "default_quote_template" => $value->default_quote_template 
            
          ]);
          
          // $CompanyArray = [
          //   "id" => $value->id,
          //   "company_name" => $value->company_name,
          //   "address" => $value->address,
          //   "city" => $value->city,
          //   "state" => $value->state,
          //   "country" => $value->country,
          //   "postal_code" => $value->zipcode, 
          //   "phone_number" => $value->phone,
          //   "fax_number" => $value->fax,
          //   "mobile_number" => $value->mobile,
          //   "website_address" => $value->website,
          //   "default_invoice_template" => $value->default_invoice_template,
          //   "default_quote_template" => $value->default_quote_template
            
          // ];
               
               
        }  
        

return response::json(['error' => false, 'message' =>"success", "CompanyDetails" => $CompanyArray], 200);


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
     *     path="/company",
     *     description="Company Store",
     *     tags={"COMPANY"},
     *     summary="Company Store",
     *      @SWG\Parameter(
     *          name="company_name",
     *          description="Company name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="default_quote_template",
     *          description="Default Quote Template",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="city",
     *          description="City",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="state",
     *          description="State",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="zipcode",
     *          description="Postal Code",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="country",
     *          description="Country",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="phone",
     *          description="Phone Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="fax",
     *          description="Fax Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="mobile",
     *          description="Mobile Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="website",
     *          description="Website_address",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="default_invoice_template",
     *          description="Default Invoice Template",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="address",
     *          description="Address",
     *          required=false,
     *          type="string",in="formData",
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
  //echo "<pre>";print_r($request->all());exit;
        $formData = $request->all();     
 //echo "<pre>";print_r($formData["phone"]);exit;
            
//echo "<pre>";print_r($formData["phone"]);exit;
             if( $formData["phone"] != "undefined"){
              $phone = $formData["phone"];
            }else{
              $phone = "";
            }

           if( $formData["fax"] != "undefined"){
              $fax = $formData["fax"];
            }else{
              $fax = "";
            
            }
            if( $formData["mobile"] != "undefined"){
              $mobile = $formData["mobile"];
            }else{
              $mobile = "";
            }
            if( $formData["website"] != "undefined"){
              $website = $formData["website"];
            }else{
              $website = "";
            }

      //echo "<pre>";print_r($phone);exit;

        $company_id =  Company::create([
            
            "company_name" => $formData["company_name"],
            "address" => $formData["address"],
            "city" => $formData["city"],
            "state" => $formData["state"],
            "country" => $formData["country"],
            "zipcode" => $formData["zipcode"],
            "phone" => $phone,
            "fax" => $fax,
            "mobile" => $mobile,
            "website" => $website,
            "default_invoice_template" => $formData["default_invoice_template"],
            "default_quote_template" => $formData["default_quote_template"]
            
        ]);
     
            
        return response::json(['error' => false, 'message' =>"CompanyProfile Stored successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response/
     */

     /**
     * @SWG\Get(
     *          path="/Company/{id}",
     *          tags={"COMPANY"},
     *          summary="Company edit",
     *          operationId="Ceid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Company Id",
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
$Company=Company::select( 'id','company_name','address','city','state','country','zipcode','phone','fax','mobile','website','default_invoice_template','default_quote_template')->where('id', $id)->first(); 
      


//echo "<pre>";print_r($id);exit;
        $CompanyArray1 = [
            "id" => $Company->id,
            "company_name" => $Company->company_name,
            "address" => $Company->address,
            'city' => $Company->city,
            "state" => $Company->state,
            "country" => $Company->country,
            "zipcode" => $Company->zipcode,
            "phone" => $Company->phone,
            "fax" => $Company->fax,
            "mobile" => $Company->mobile,
            "website" => $Company->website,
            "default_invoice_template" => $Company->default_invoice_template,
            "default_quote_template" => $Company->default_quote_template

          ];
          return response::json(['error' => false, 'message' =>"success", "Companydetails" => $CompanyArray1], 200);
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
     *     path="/company/{id}",
     *     description="Company Update",
     *     tags={"COMPANY"},
     *     summary="Company Update",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Company Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *      @SWG\Parameter(
     *          name="company_name",
     *          description="Company name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="default_quote_template",
     *          description="Default Quote Template",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="city",
     *          description="City",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="state",
     *          description="State",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="zipcode",
     *          description="Postal Code",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="country",
     *          description="Country",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="phone",
     *          description="Phone Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="fax",
     *          description="Fax Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="mobile",
     *          description="Mobile Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="website",
     *          description="Website_address",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="default_invoice_template",
     *          description="Default Invoice Template",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="address",
     *          description="Address",
     *          required=false,
     *          type="string",in="formData",
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
       //echo "<pre>";print_r($request->all());exit;
             
    $formData = $request->all(); 
    $formdata = [
               
              'company_name' => $request->input('company_name'),
              'address' => $request->input('address'),
              'city' => $request->input('city'),
              'state' => $request->input('state'),
              'country' => $request->input('country'),
              'zipcode' => $request->input('zipcode'),
              'phone' => $request->input('phone'),
              'fax' => $request->input('fax'),
              'mobile' => $request->input('mobile'),
              'website' => $request->input('website'),
              'default_invoice_template' => $request->input('default_invoice_template'),
              'default_quote_template' => $request->input('default_quote_template')
              ];
            $Company = Company::where('id', $id)->update($formdata);
            return response::json(['error' => false, 'message' =>"CompanyProfile Updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Delete(
     *          path="/Company/{id}",
     *          tags={"COMPANY"},
     *          summary="Company Delete",
     *          operationId="Cdid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Company Delete",
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
	   $date = date('Y-m-d H:i:s');
   $Company = Company::where('id', $id)->update(['deleted_at' => $date]);
   return response::json(['error' => false, 'message' =>"CompanyProfile Deleted successfully"], 200); 
    }
}
