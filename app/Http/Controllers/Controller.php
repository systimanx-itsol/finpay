<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
	     * @SWG\Swagger(
	     *     basePath="api/v1",
	     *     host=L5_SWAGGER_CONST_HOST,
	     *     @SWG\Info(
	     *         version="1.0.0",
	     *         title="InvoiceTool Swagger API",
	     *         description="InvoiceTool Swagger API description",
	     *         @SWG\Contact(
	     *             email="admin@finpay.com"
	     *         ),
	     *     )
	     * )
	    */

}
