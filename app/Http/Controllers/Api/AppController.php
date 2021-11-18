<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Car;
use App\Models\Cart;
use App\Models\User;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Favorite;
use App\Models\Medicine;
use App\Models\ContactUs;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\CarsApiResource;


class AppController extends ApiBaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function home()
    {    
      
         $cars= CarsApiResource::collection(Car::where('status','True')->get());
        
        return $this->sendResponse($cars);
        
    }
    
    

    
}
