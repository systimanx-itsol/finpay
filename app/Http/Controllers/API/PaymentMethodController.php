<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Response;

class PaymentMethodController extends Controller
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
     *          path="/PaymentMethod",
     *          tags={"PAYMENT METHODFORM"},
     *          summary="Paymentmethodform Table",
     *          operationId="pid",
     *          @SWG\Parameter(
     *             name="id",
     *             in="header",
     *             description="Id",
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
        $PaymentMethod = PaymentMethod::select('id', 'name')->get();
        $PaymentMethodArray = array();
        foreach ($PaymentMethod as $key => $value) {
            $PaymentMethodArray[] = [
                'id' => $value->id,
                'name' => $value->name,
            ];
        }
        return response()->json(['status' => 1, 'message' => "success", "payment_methodDetails" => $PaymentMethodArray], 200);
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
     *     path="/paymentmethod",
     *     description="Paymentmethodform Store",
     *     tags={"PAYMENT METHODFORM"},
     *     summary="Paymentmethod Store",
     *      @SWG\Parameter(
     *          name="name",
     *          description="Paymentmethod Name",
     *          required=true,
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
    public function store(Request $request)
    {
        $formData = $request->all();

        $Paymentmethod = PaymentMethod::where('deleted_at', '=', NULL);
        $PaymentCount = PaymentMethod::where('name', $formData["name"])->count();
        if ($PaymentCount == 0) {
            PaymentMethod::create([
                "name" => $formData["name"],
            ]);

            return response()->json(['status' => 1, 'message' => "Payment method stored successfully"], 200);
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
     *          path="/PaymentMethod/{id}",
     *          tags={"PAYMENT METHODFORM"},
     *          summary="Paymentmethodform edit",
     *          operationId="Peid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Paymentmethod Id",
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
        $PaymentMethodCount = PaymentMethod::where('id', $id)->count();

        if ($PaymentMethodCount > 0) {
            $PaymentMethod = PaymentMethod::where('id', $id)->select('id', 'name')->first();
            $PaymentMethodArray1 = array();
            $PaymentMethodArray1 = [
                'id' => $PaymentMethod->id,
                'name' => $PaymentMethod->name,

            ];
            return response()->json(['status' => 1, 'message' => "success", "payment_methodDetails" => $PaymentMethodArray1], 200);
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
     *     path="/PaymentMethod/{id}",
     *     
     *     tags={"PAYMENT METHODFORM"},
     *     summary="Paymentmethodform Update",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Paymentmethodform Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *      @SWG\Parameter(
     *          name="name",
     *          description="Paymentmethod Name",
     *          required=true,
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

    public function update(Request $request, $id)
    {
        $formData = $request->all();
        $paymentmethodCount = PaymentMethod::where([['id', '<>', $id]]);

        $paymentmethodCounts = $paymentmethodCount->where(
            [
                ['name', '=', $formData['name']],
            ]
        );
        $paymentCount = $paymentmethodCounts->count();

        if ($paymentCount == 0) {
            $formdata = [
                'name' => $request->input('name'),
            ];
            $PaymentMethod = PaymentMethod::where('id', $id)->update($formdata);
            return response::json(['status' => 1, 'message' => "Payment method updated successfully"], 200);
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
     *          path="/PaymentMethod/{id}",
     *          tags={"PAYMENT METHODFORM"},
     *          summary="Paymentmethodform Delete",
     *          operationId="Cdid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Paymentmethodform Delete",
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
        $PaymentMethod = PaymentMethod::where('id', $id)->update(['deleted_at' => date('y-m-d')]);
        return response::json(['status' => 1, 'message' => "Payment method deleted Successfully.."], 200);
    }
}
