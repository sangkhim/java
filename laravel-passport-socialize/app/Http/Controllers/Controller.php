<?php

/**
 *
 * @SWG\Swagger(
 *   basePath="/",
 *   schemes={"http","https"},
 *   @SWG\Info(
 *     title="Open API",
 *     version="1.0.0"
 *   )
 * ),
 *
 * @SWG\SecurityScheme(
 *   securityDefinition="oauth2", type="oauth2", description="OAuth2 Password Grant", flow="password",
 *   authorizationUrl="http://localhost:8000/oauth/authorize",
 *   tokenUrl="http://localhost:8000/oauth/token",
 *   scopes={"*": ""}
 * ),
 *
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
