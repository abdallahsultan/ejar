<?php

namespace App\Http\Controllers\Api;

use File;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CarsApiResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\CustomerStockRequest;
use Symfony\Component\VarDumper\Cloner\Data;
use App\Http\Requests\CustomerPharmacyRequest;

class AuthController extends ApiBaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

 

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
         return $this->sendErrorMessage($validator->errors());
        }
        if (! $token = auth('api')->attempt($validator->validated())) {
            
         return   $this->sendErrorMessage('Check your Password or Email');
           
        }
        
        $authorize=$this->respondWithToken($token);
        $authorize->original['user']=auth('api')->user();
        return $this->sendResponse($authorize->original);

  
    }

    public function register(Request $request)
    {
        $data=$request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:6',
            'phone' => 'required|min:10|numeric|unique:users,phone,',
            'email' => 'required|max:255|unique:users,email,',
            'sex' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendErrorMessage($validator->errors());
        }
        
        $data['password'] = bcrypt($data['password']);
        $data['level'] = 'user'; 
        
        $user = User::create($data);
        if($user){
            $credentials = request(['phone', 'password']);
         
            if (! $token = auth('api')->attempt($credentials)) {
                return  $this->sendErrorMessage('Check your Password or Email');
               
            }
           
            $authorize=$this->respondWithToken($token);
            $authorize->original['user']=auth('api')->user();
            return $this->sendResponse($authorize->original);
        }else{
            return $this->sendErrorMessage('try again');     
            
        }

      
      
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->sendResponse(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return $this->sendResponse(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return  $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>  auth('api')->factory()->getTTL() * 7300
        ]);
    }
    protected function payload()
    {
      return auth('api')->payload();
    }
    
    public function myprofile(){
        $user['name']     =auth('api')->user()->name;
        $user['phone']    =auth('api')->user()->phone;
        $user['email']    =auth('api')->user()->email;
        $user['address']  =auth('api')->user()->address;
        $user['level']    =auth('api')->user()->level;
        
        return $this->sendResponse($user);
        // dd($user);
    }
    public function home()
    {    
      
         $cars= CarsApiResource::collection(Car::where('status','True')->get());
        
        return $this->sendResponse($cars);
        
    }

    public function changepassword(Request $request){
          
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ]);
        if (!(Hash::check($request->old_password, auth('api')->user()->password))) {
            return $this->sendErrorMessage("Your current password can't be with new password");
        }
        if ($validator->fails()) {
            return $this->sendResponse($validator->errors());
        }

        $changepassword=User::find(auth('api')->user()->id)->update(['password'=> Hash::make($request->password)]);
        if($changepassword){
            return $this->sendResponse('Password is changed Successfull');
        }else{
            return $this->sendErrorMessage('Some thing is error Please try agian');
        }


    }
    public function updateprofile(Request $request)
    {   $id=auth('api')->user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|max:255|unique:users,email,'.$id,
            'sex' => 'required',
            // 'address' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendErrorMessage($validator->errors());
        }
      
          $update=User::find($id)->update([
              'name'=>$request->name ,'sex'=>$request->sex,
              'email'=>$request->email]);

            if($update){
               return $this->sendResponse('Your Profile Updated  Successfull');
            }else{
                return $this->sendErrorMessage('Some thing is error Please try agian');
            }


     }
     public function searchCar(Request $request)
     {
         $search=$request->serachKey;
        
         $cars= CarsApiResource::collection(Car::where('status','True')->where('title', 'like', "%{$search}%")
         ->OrWhere('description', 'like', "%{$search}%")
         ->OrWhere('brand', 'like', "%{$search}%")
         ->OrWhere('model', 'like', "%{$search}%")
         ->OrWhere('keywords', 'like', "%{$search}%")->get());
        
       
 
        if($cars){
         
          
         return $this->sendResponse($cars);
        }else{
            return $this->sendErrorMessage('Some thing is error ');
        }
 
     }
    
  
}
