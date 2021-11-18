<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiBaseController extends BaseController
{
    public function sendResponse($result, $code = 200 ,$error='')
    {
        return response()->json([ "status" => true,"errors" => $error,"data"=>$result], $code);
    }

    public function sendErrorMessage($errorMessage, $code = 400)
    {
        return response()->json(["status" => false,"errors" => $errorMessage,"data"=> ''], $code);
    }

    public function sendError($errors, $code = 400)
    {
     
        return response()->json(["status" => false, "errors" => $errors[0] ,"data"=> ''], $code);
    }

    public function sendSuccessMessage($message = "Success")
    {
        return response()->json(['message'=>$message]);
    }

}
