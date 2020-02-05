<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Currencies;
use App\Models\invoice;
use App\Http\Controllers\Controller;
use Response;

class ClientController extends Controller
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
     *          path="/Client",
     *          tags={"CLIENTS"},
     *          summary="Clients Table",
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

        $client = client::select('id', 'default_currency', 'client_name', 'email', 'address', 'city', 'state', 'postal_code', 'country', 'phone_number', 'fax_number', 'mobile_number', 'web_site', 'default_currency', 'tax_code', 'status')
            // ->leftJoin('invoices', 'clients.id', '=', 'invoices.client_id')
            // ->where('clients.deleted_at', '=', NULL)->where('invoices.deleted_at', '=', NULL)->distinct()->get();
            ->get();
        //  echo"<pre>client";print_r( $client );exit;
        $clientArray = array();
        foreach ($client as $key => $value) {
            $client_id = $value->id;
            $balance = invoice::join('clients', 'invoices.client_id', '=', 'clients.id')
                ->where('invoices.client_id', '=', $client_id)
                ->whereNull('invoices.deleted_at')->where('clients.deleted_at', '=', NULL)
                ->sum('balance');
            $CurrenciesData = Currencies::select('symbol', 'placement', 'thousands', 'decimal')->where('id', '=', $value->default_currency)->first();
            $clientArray[] = [
                'id' => $value->id,
                'client_name' => $value->client_name,
                'balance' => $balance,
                "currencies_id" => $CurrenciesData['symbol'],
                "currencies_placement" => $CurrenciesData['placement'],
                "currencies_thousands" => $CurrenciesData['thousands'],
                "currencies_decimal" => $CurrenciesData['decimal'],
                // 'currency_id' => Currencies::select('symbol')->where('id', '=', $value->currency_id)->first()['symbol'],
                'email' => $value->email,
                'address' => $value->address,
                'city' =>  $value->city,
                'state' => $value->state,
                'postal_code' => $value->postal_code,
                'country' => $value->country,
                'phone_number' => $value->phone_number,
                'fax_number' => $value->fax_number,
                'mobile_number' => $value->mobile_number,
                'web_site' => $value->web_site,
                'default_currency' => $value->default_currency,
                'tax_code' => $value->tax_code,
                'status' => $value->status == 1 ? "Active" : "Inactive",
            ];
        }
        return response()->json(['status' => 1, 'message' => "success", "clientDetails" => $clientArray], 200);
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
     *     path="/client",
     *     description="Client Store",
     *     tags={"CLIENTS"},
     *     summary="Client Store",
     *      @SWG\Parameter(
     *          name="client_name",
     *          description="Client name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="email",
     *          description="Email",
     *          required=false,
     *          type="string",in="formData",
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
     *          name="postal_code",
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
     *          name="phone_number",
     *          description="Phone Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="fax_number",
     *          description="Fax Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
    
     *  @SWG\Parameter(
     *          name="web_site",
     *          description="Website",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *   @SWG\Parameter(
     *          name="default_currency",
     *          description="Default Currency",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="tax_code",
     *          description="Tax Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="address",
     *          description="Address",
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
        $clientcount = client::where('deleted_at', '=', NULL);
        $clientcount = client::where('email', $formData["email"])->count();
        if ($clientcount == 0) {
            Client::create([
                "client_name" => $formData["client_name"],
                "email" => $formData["email"],
                "address" => $formData["address"],
                "city" =>  $formData["city"],
                "state" => $formData["state"],
                "postal_code" => $formData["postal_code"],
                'country' => $formData["country"],
                "phone_number" => $formData["phone_number"],
                "fax_number" => $formData["fax_number"],
                "mobile_number" => $formData["mobile_number"],
                "web_site" => $formData["web_site"],
                "default_currency" => $formData['default_currency'],
                "tax_code" => $formData["tax_code"],
                "status" => $formData["status"]

            ]);
            return response()->json(['status' => 1, 'message' => "client stored successfully"], 200);
        } else {
            return response()->json(['status' => 0, 'message' => "Email Already exists"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *          path="/Client/{id}",
     *          tags={"CLIENTS"},
     *          summary="Clients edit",
     *          operationId="Ceid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Client Id",
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
        $clientCount = client::where('id', $id)->count();

        if ($clientCount > 0) {
            $client = client::where('id', $id)->select('id', 'client_name', 'email', 'address', 'city', 'state', 'postal_code', 'country', 'phone_number', 'fax_number', 'mobile_number', 'web_site', 'default_currency', 'tax_code', 'status')->first();
            $clientArray1 = array();
            $clientArray1 = [
                'id' => $client->id,
                'client_name' => $client->client_name,
                'email' => $client->email,
                'address' => $client->address,
                'city' => $client->city,
                'state' => $client->state,
                'postal_code' => $client->postal_code,
                'country' => $client->country,
                'phone_number' => $client->phone_number,
                'fax_number' => $client->fax_number,
                'mobile_number' => $client->mobile_number,
                'web_site' => $client->web_site,
                "default_currency" => $client->default_currency,
                'tax_code' => $client->tax_code,
                'status' => $client->status
            ];
            return response()->json(['status' => 1, 'message' => "success", "clientDetails" => $clientArray1], 200);
        } else {
            return response()->json(['status' => 0, 'message' => "no record found."], 401);
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
     *     path="/Client/{id}",
     *     description="Clients Update",
     *     tags={"CLIENTS"},
     *     summary="Clients Update",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Clients Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *      @SWG\Parameter(
     *          name="client_name",
     *          description="Client name",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="email",
     *          description="Email",
     *          required=false,
     *          type="string",in="formData",
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
     *          name="postal_code",
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
     *          name="phone_number",
     *          description="Phone Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="fax_number",
     *          description="Fax Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="mobile_number",
     *          description="Mobile Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="web_site",
     *          description="Website",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="default_currency",
     *          description="Default Currency",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="tax_code",
     *          description="Tax Number",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="address",
     *          description="Address",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
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
    public function update(Request $request, $id)
    {
        $formData = $request->all();
        $clientCount = client::where([['id', '<>', $id]]);

        $clientmethodCounts = $clientCount->where('email', $formData["email"])->count();

        if ($clientmethodCounts == 0) {

            $formdata = [
                'client_name' => $request->input('client_name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'postal_code' => $request->input('postal_code'),
                'phone_number' => $request->input('phone_number'),
                'mobile_number' => $request->input('mobile_number'),
                'fax_number' => $request->input('fax_number'),
                'web_site' => $request->input('web_site'),
                'default_currency' => $request->input('default_currency'),
                'tax_code' => $request->input('tax_code'),
                'status' => $request->input('status')
            ];

            $client = client::where('id', $id)->update($formdata);
            return response::json(['status' => 1, 'message' => "client updated successfully"], 200);
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
     *          path="/Client/{id}",
     *          tags={"CLIENTS"},
     *          summary="Client Delete",
     *          operationId="Cid",
     *          @SWG\Parameter(
     *              name="id",
     *              description="Client Delete",
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
        $date = date('Y-m-d H:i:s');
        $client = client::where('id', $id)->update(['deleted_at' => $date]);

        return response::json(['status' => 1, 'message' => "client deleted Successfully.."], 200);
    }
}
