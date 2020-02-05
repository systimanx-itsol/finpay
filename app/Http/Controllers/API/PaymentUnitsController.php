<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Response;

class ProductUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *          path="/ProductUnit",
     *          tags={"PRODUCT UNITS"},
     *          summary="Productunit Table",
     *          operationId="puid",
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
        $ProductUnit = ProductUnit::select('id', 'name', 'unit', 'status')->get();
        $ProductUnitArray = array();
        foreach ($ProductUnit as $key => $value) {
            $ProductUnitArray[] = [
                'id' => $value->id,
                'name' => $value->name,
                'unit' => $value->unit,
                'status' => $value->status == 1 ? "Active" : "Inactive",
            ];
        }
        return response()->json(['status' => 1, 'message' => "success", "product_unitDetails" => $ProductUnitArray], 200);
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
     *     path="/productunit",
     *     description="Productunit Store",
     *     tags={"PRODUCT UNITS"},
     *     summary="Productunit Store",
     *      @SWG\Parameter(
     *          name="name",
     *          description="Name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="unit",
     *          description="Unit",
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

        $formData = $request->all();
        $unit = $formData['unit'];

        $Productunit = ProductUnit::where('deleted_at', '=', NULL);
        $ProductunitCount = ProductUnit::where('unit', $formData["unit"])->count();

        if ($ProductunitCount == 0) {
            ProductUnit::create([
                "name" => $formData["name"],
                "unit" => $formData["unit"],
                "status" => $formData["status"]
            ]);
            return response()->json(['status' => 1, 'message' => "Product Unit stored successfully"], 200);
        } else {
            return response()->json(['status' => 0, 'message' => "Already exists"]);
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
     *          path="/ProductUnit/{id}",
     *          tags={"PRODUCT UNITS"},
     *          summary="Productunits edit",
     *          operationId="Pid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Productunits Id",
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
        $ProductUnitCount = ProductUnit::where('id', $id)->count();

        if ($ProductUnitCount > 0) {
            $ProductUnit = ProductUnit::where('id', $id)->select('id', 'name', 'unit', 'status')->first();
            $ProductUnitArray1 = array();
            $ProductUnitArray1 = [
                'id' => $ProductUnit->id,
                'name' => $ProductUnit->name,
                'unit' => $ProductUnit->unit,
                'status' => $ProductUnit->status,

            ];
            return response()->json(['status' => 1, 'message' => "success", "product_unitDetails" => $ProductUnitArray1], 200);
        } else {
            return response()->json(['status' => 0, 'message' => "No Record Found."], 401);
        }
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
     *     path="/ProductUnit/{id}",
     *     description="Productunit Update",
     *     tags={"PRODUCT UNITS"},
     *     summary="Productunits Update",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Productunits Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *      @SWG\Parameter(
     *          name="name",
     *          description="Name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="unit",
     *          description="Unit",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="status",
     *          description="Status",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
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
    public function update(Request $request, $id)
    {
        $formData = $request->all();
        $ProductunitCounts = ProductUnit::where([['id', '<>', $id]]);
        $ProductunitCount = $ProductunitCounts->where('unit', $formData["unit"])->count();

        if ($ProductunitCount == 0) {
            $formdata = [
                'name' => $request->input('name'),
                'unit' => $request->input('unit'),
                'status' => $request->input('status')
            ];

            $ProductUnit = ProductUnit::where('id', $id)->update($formdata);
            return response::json(['status' => 1, 'message' => "Product Unit Updated Successfully.."], 200);
        } else {
            return response()->json(['status' => 0, 'message' => "Already exists"]);
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
     *          path="/ProductUnit/{id}",
     *          tags={"PRODUCT UNITS"},
     *          summary="Productunit Delete",
     *          operationId="Pid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Productunits Delete",
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
        $ProductUnit = ProductUnit::where('id', $id)->update(['deleted_at' => date('y-m-d')]);

        return response::json(['status' => 1, 'message' => "Product Unit deleted Successfully.."], 200);
    }
}
