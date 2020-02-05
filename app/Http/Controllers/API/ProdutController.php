<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TaxRate;
use App\Models\CategoryMethod;
use App\Models\productmap;
use App\Models\ProductUnit;

use Input;
use Response;
class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Get(
     *          path="/Product",
     *          tags={"PRODUCTS - PRODUCTS"},
     *          summary="Product Table",
     *          operationId="Pid",
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
    public function index() {
        // echo "<pre>";print_r($value);exit;
        $Product = Product::select('tax_rates.name as tax_name', 'productmaps.id as map_id', 'products.id', 'category_id', 'product_name', 'products.slug as slug', 'products.description as description', 'product_id', 'price', 'weight', 'unit', 'productmaps.image as image', 'productmaps.status', 'tax_rate_id', 'category_methods.name as name', 'parentcategory','display_name')
        ->leftJoin('productmaps', 'products.id', '=', 'productmaps.product_id')
        ->leftJoin('tax_rates', 'products.tax_rate_id', '=', 'tax_rates.id')
        ->leftJoin('category_methods', 'products.category_id', '=', 'category_methods.id')
        ->where('productmaps.deleted_at', '=', NULL)
        ->get();
        //echo "<pre>";print_r($Product->product_name);
        //	echo "<pre>";print_r($Client->client_name);
        //	echo "<pre>";print_r($Product);exit;
        $ProductArray = array();
        foreach ($Product as $value) {
            $priceExplode =  explode(',', $value->price);
            $weightExplode =  explode(',', $value->weight);
            $unitExplode =  explode(',', $value->unit);
            $ProductArray[] = [
              "id" => $value->id,
               "map_id" => $value->map_id,
                "category_id" => $value->category_id, 
                "product_name" => $value->product_name,
                 "display_name" => $value->display_name,
                   "description" => $value->description,
                    "product_id" => $value->product_id,
                     "price" => $priceExplode[0],
                      "weight" => $weightExplode[0],
                       "unit" => $unitExplode[0],
                        "image" => $value->image,
                         "status" => $value->status == 1 ? "Active" : "Inactive",
                          "tax_name" => $value->tax_name, 
                          "name" => $value->name,
            ];
     //  "parentcategory" => CategoryMethod::select('name')->where("id", "=", $value->parentcategory)->first() ['name'], ];
        }
        return response::json(['error' => false, 'message' => "success", "ProductDetails" => $ProductArray], 200);
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
     *     path="/Product",
     *     description="Product Store",
     *     tags={"PRODUCTS - PRODUCTS"},
     *     summary="Product Store",
     *      @SWG\Parameter(
     *          name="category_id",
     *          description="Category Id",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="product_name",
     *          description="Product Name",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *          @SWG\Parameter(
     *          name="tax_rate_id",
     *          description="Tax Rate",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="description",
     *          description="Description",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="status",
     *          description="Status",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="price",
     *          description="Price",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="weight",
     *          description="Weight",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="unit",
     *          description="Unit",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="image",
     *          description="Image",
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

    public function store(Request $request) {
        $formData = $request->all();
        //   echo "<pre>";print_r($formData);exit;
        foreach ($formData["weight"] as $key => $value) {
        $productdisplay = ($formData["product_name"].' ' .$formData["weight"][$key].$formData["unit"][$key].'');
        // echo "<pre>";print_r($productdisplay);exit;      

            $displaycount = Productmap::where ('display_name' , '=' , $productdisplay )->count();    
            //echo "<pre>";print_r($displaycount);exit;   
            if ($displaycount != 0)
                return response()->json(['status' => 0, 'message' => "$productdisplay product Already exists"]);
        }
        //echo "<pre>";print_r($productdisplay);exit;    
        
       $Product = Product::create([
          "category_id" => $formData["category_id"],
           "product_name" => $formData["product_name"],
             "tax_rate_id" => $formData["tax_rate_id"],
              "description" => $formData["description"],
              ]);

         $product_id = $Product->id;
         
        //echo "<pre>";print_r($formData);
        foreach ($formData["price"] as $value) {
            //echo "<pre>";print_r($value);exit;
            productmap::create([
              "product_id" => $product_id,
               "price" => $value,
                "weight" => 0,
                 "unit" => 0,
                  "image" => '',
                  
                  ]);

                  
        }
    
      
        $getProductMap = productmap::where('product_id', $product_id)->get();
        foreach ($getProductMap as $key => $value) {
            $data[] = $value->id;

            
            
        }
        
            
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $formData["price"])) {
                productmap::where('id', $value)->update(["price" => $formData["price"][$key]]);
            }
            if (array_key_exists($key, $formData["weight"])) {
                productmap::where('id', $value)->update(["weight" => $formData["weight"][$key]]);
            }
            if (array_key_exists($key, $formData["unit"])) {
                productmap::where('id', $value)->update(["unit" => $formData["unit"][$key]]);
            }
            if (array_key_exists($key, $formData["image"])) {
                $image = $formData["image"][$key];
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/images/product/', $name);
                productmap::where('id', $value)->update(["image" => url('/') . '/images/product/' . $name]);
            }

            $display_name = ($formData["product_name"].' ' .$formData["weight"][$key].$formData["unit"][$key].'');
            productmap::where('id', $value)->update(["display_name" => $display_name]);
        }
        return response::json(['status' => 1,'success' => false, 'message' => "Product stored successfully"], 200);
    
 
       
  
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Get(
     *          path="/Product/{id}",
     *          tags={"PRODUCTS - PRODUCTS"},
     *          summary="Product Edit",
     *          operationId="Psid",
     *          @SWG\Parameter(
     *              name="product_id",
     *              description="Product Id",
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
    public function show($id) {
        
        $Product = Product::select('category_id', 'product_name', 'display_name', 'slug', 'description', 'productmaps.status', 'tax_rate_id', 'price', 'weight', 'unit', 'image')
        ->leftJoin('productmaps', 'products.id', '=', 'productmaps.product_id')->leftJoin('tax_rates', 'products.tax_rate_id', '=', 'tax_rates.id')
        ->where('productmaps.id', $id)
        ->first();
        //echo "<pre>";print_r($Product);exit;
       
        $ProductArray = [
          "category_id" => $Product->category_id,
           "product_name" => $Product->product_name,
            'display_name' => $Product->display_name,
              "description" => $Product->description,
               "status" => $Product->status,
                "tax_rate_id" => $Product->tax_rate_id,
                 "price" => $Product->price,
                  "weight" => $Product->weight,
                   "unit" => $Product->unit,
                    "image" => $Product->image,
                   ];
        return response::json(['error' => false, 'message' => "success", "ProductDetails" => $ProductArray], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      /**
     * @SWG\Delete(
     *          path="/Product/{id}",
     *          tags={"PRODUCTS - PRODUCTS"},
     *          summary="Product Delete",
     *          operationId="Pdid",
     *          @SWG\Parameter(
     *              name="product_id",
     *              description="Product Id",
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
     
    public function destroy($id) {
        //echo $id;exit;
        $date = date('Y-m-d H:i:s');
        //$Product = Product::where('id', $id)->update(['deleted_at' => $date]);
        $productmap = productmap::where('id', $id)->delete();
        return response::json(['error' => false, 'message' => "Deleted successfully"], 200);
    }

    /**
     *
     * @SWG\Post(
     *     path="/Product/{id}",
     *     description="Product Update",
     *     tags={"PRODUCTS - PRODUCTS"},
     *     summary="Product Update",
     *          @SWG\Parameter(
     *              name="product_id",
     *              description="Product Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *      @SWG\Parameter(
     *          name="category_id",
     *          description="Category Id",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="product_name",
     *          description="Product Name",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *          @SWG\Parameter(
     *          name="tax_rate_id",
     *          description="Tax Rate",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="description",
     *          description="Description",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="status",
     *          description="Status",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="price",
     *          description="Price",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="weight",
     *          description="Weight",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="unit",
     *          description="Unit",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *    @SWG\Parameter(
     *          name="image",
     *          description="Image",
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

   
    public function productupdate(Request $request, $id) {
      
        $formdata = $request->all();
         // echo "<pre>";print_r($formdata);exit;
        $display= ($formdata['product_name']. ' '.$formdata['weight'].$formdata['unit'].'');
         //echo "<pre>";print_r($display);exit;
        $productCounts = productmap::where([['id' , '<>' , $id]]);
            //echo "<pre>";print_r(count($ProductunitCounts));
        $productcounts = $productCounts->where(
            [
                ['display_name', '=', $display],
            ]
           
            );//->get();
            //echo "<pre>";print_r($taxCounts);exit;
        $displayproduct = $productcounts->count();
        //echo "<pre>";print_r($taxRatesCounts);exit;
        if($displayproduct == 0){
        $Product = productmap::where('id', $id)->first();
        $product_id = $Product->product_id;
        if ($formdata["display_name"] != "null") {
            $display_name = $formdata["display_name"];
        } else {
            $display_name = "";
        }
        if ($formdata["slug"] != "null") {
            $slug = $formdata["slug"];
        } else {
            $slug = "";
        }
        $formdata = [
          'category_id' => $formdata['category_id'], 
          'product_name' => $formdata['product_name'],
           'description' => $formdata['description'],
             'tax_rate_id' => $formdata['tax_rate_id'],
             ];
        $Product = Product::where('id', $product_id)->update($formdata);
        $formdata = $request->all();
       
        $Product = productmap::where('id', $id)->first();
        $productimg = $Product->image;
        if ($formdata['image'] != "") {
            $image = $formdata['image'];
            $name = $image->getClientOriginalName();
            $size = $image-> getSize();
            $image->move(public_path() . '/images/product/', $name);
            $productimage = url('/') . '/images/product/' . $name;
        } else {
            $productimage = $productimg;
        }

          
         // echo "<pre>";print_r($size);exit;
        $formdata = [
           "price" => $formdata['price'],
            "weight" => $formdata['weight'],
             "unit" => $formdata['unit'],
              "image" => $productimage,
               'status' => $formdata['status'],
              "display_name" => $display,
             ];

        $productmap = productmap::where('id', $id)->update($formdata);

        
        return response::json(['status' => 1,'error' => false, 'message' => "Product updated successfully"], 200);
    }else{
        return response()->json(['status' => 0, 'message' => "This product Already exists"]);
    }
    }

    /**
     * @SWG\Get(
     *          path="/Autounit",
     *          tags={"PRODUCTS - PRODUCTS"},
     *          summary="Product Unit",
     *          operationId="Puid",
     *        
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

      public function autounit(Request $request)
    {

      // echo "<pre>";print_r($request);exit;
        
        $data = $request->unit;
         //echo "<pre>";print_r($data);exit;
        
        $unit = ProductUnit::where('unit','like','%'.$data.'%')->where('status','=',1)->get();
        $unitArray = array();
        foreach($unit as $key => $value){
            $unitArray[] =  $value->unit;
           // echo "<pre>";print_r($value->unit);exit;
            // $unitArray[] = $value->id;
        }
   
    return response::json (['error' => false, 'message' =>"success",  "units" => $unitArray], 200);
   
    }
    
   
}
