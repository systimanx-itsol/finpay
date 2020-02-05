<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currencies;
use Response;

class CurrenciesController extends Controller
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
     *          path="/Currencies",
     *          tags={"CURRENCIES"},
     *          summary="Currencies Table",
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
        $Currencies = Currencies::select('id', 'name', 'code', 'symbol', 'decimal', 'placement', 'thousands')->get();
        $CurrenciesArray = array();
        foreach ($Currencies as $key => $value) {
            $CurrenciesArray[] = [
                'id' => $value->id,
                'name' => $value->name,
                'code' => $value->code,
                'symbol' => $value->symbol,
                'decimal' => $value->decimal,
                'thousands' => $value->thousands,
                'placement' => $value->placement


            ];
        }
        return response()->json(['status' => 1, 'message' => "success", "currenciesDetails" => $CurrenciesArray], 200);
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
     *     path="/currencies",
     *     description="Currencies Store",
     *     tags={"CURRENCIES"},
     *     summary="Currencies Store",
     *      @SWG\Parameter(
     *          name="name",
     *          description="Name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="placement",
     *          description="Symbol Placement",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="code",
     *          description="Code",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="decimal",
     *          description="Decimal Point",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="symbol",
     *          description="Symbol",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="thousands",
     *          description="Thousands Separator",
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
    public function store(Request $request)
    {
        $formData = $request->all();
        $currency = Currencies::where('deleted_at', '=', NULL);
        $CurrencyCount = Currencies::where('name', $formData["name"])->count();
        if ($CurrencyCount == 0) {
            Currencies::create([
                "code" => $formData['code'],
                "name" =>  $formData['name'],
                "symbol" => $formData['symbol'],
                "placement" => $formData['placement'],
                "decimal" => $formData['decimal'],
                "thousands" => $formData['thousands'],
            ]);
            return response()->json(['status' => 1, 'message' => "currency Submitted Successfully"], 200);
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
     *          path="/Currencies/{id}",
     *          tags={"CURRENCIES"},
     *          summary="Currencies edit",
     *          operationId="Ceid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Currencies Id",
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
        $CurrenciesMethodCount = Currencies::where('id', $id)->count();

        if ($CurrenciesMethodCount > 0) {
            $Currencies = Currencies::where('id', $id)->select('id', 'name', 'code', 'symbol', 'placement', 'decimal', 'thousands')->first();
            $CurrenciesMethodArray1 = array();
            $CurrenciesMethodArray1 = [
                'id' => $Currencies->id,
                'name' => $Currencies->name,
                'code' => $Currencies->code,
                'symbol' => $Currencies->symbol,
                'placement' => $Currencies->placement,
                'decimal' => $Currencies->decimal,
                'thousands' => $Currencies->thousands,

            ];
            return response()->json(['status' => 1, 'message' => "success", "currency_methodDetails" => $CurrenciesMethodArray1], 200);
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
     *     path="/Currencies/{id}",
     *     description="Currencies Update",
     *     tags={"CURRENCIES"},
     *     summary="Currencies Update",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Currencies Id",
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
     *          name="placement",
     *          description="Symbol Placement",
     *          required=false,
     *          type="boolean",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="code",
     *          description="Code",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="decimal",
     *          description="Decimal Point",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="symbol",
     *          description="Symbol",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="thousands",
     *          description="Thousands Separator",
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
    public function update(Request $request, $id)
    {
        $formData = $request->all();
        $currencyCount = Currencies::where([['id', '<>', $id]]);
        $currency = $currencyCount->where('name', $formData["name"])->count();

        if ($currency == 0) {
            $formdata = [
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'symbol' => $request->input('symbol'),
                'placement' => $request->input('placement'),
                'decimal' => $request->input('decimal'),
                'thousands' => $request->input('thousands'),

            ];
            $Currencies = Currencies::where('id', $id)->update($formdata);
            return response::json(['status' => 1, 'message' => "currency updated successfully"], 200);
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
     *          path="/Currencies/{id}",
     *          tags={"CURRENCIES"},
     *          summary="Currencies Delete",
     *          operationId="Cdid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Currencies Delete",
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
        $Currencies = Currencies::where('id', $id)->update(['deleted_at' => date('y-m-d')]);
        return response::json(['status' => 1, 'message' => "Currency deleted Successfully.."], 200);
    }
}
