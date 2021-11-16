<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\CustomerStockRequest;
use App\Http\Requests\CustomerPharmacyRequest;
use Symfony\Component\VarDumper\Cloner\Data;
use File;
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
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Check your Password or Email'], 401);
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
            'phone' => 'required|min:11|numeric|unique:users,phone,',
            'email' => 'required|max:255|unique:users,email,',
            'sex' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendResponse($validator->errors());
        }
        
        $data['password'] = bcrypt($data['password']);
        $data['level'] = 'user'; 
        
        $user = User::create($data);
        if($user){
            $credentials = request(['phone', 'password']);
         
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
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
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
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
            'expires_in' =>  auth('api')->factory()->getTTL() * 60
        ]);
    }
    protected function payload()
    {
      return auth('api')->payload();
    }
    
    public function myprofile(){
        $user['name']=auth('api')->user()->name;
        $user['phone']=auth('api')->user()->phone;
        $user['email']=auth('api')->user()->email;
        $user['address']=auth('api')->user()->address;
        $user['level']=auth('api')->user()->level;
        // if($user['level'] == 'pharmacy'){

        //   $user['guild_file']=auth('api')->user()->getguildfile();
        // }
        // $user['tax_file']=auth('api')->user()->gettaxfile();
        return $this->sendResponse($user);
        // dd($user);
    }

    public function changepassword(Request $request){
          
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ]);
        if (!(Hash::check($request->old_password, auth('api')->user()->password))) {
            return response()->json(['errors' => ["Your current password can't be with new password"]], 400);
        }
        if ($validator->fails()) {
            return $this->sendResponse($validator->errors());
        }

        $changepassword=User::find(auth('api')->user()->id)->update(['password'=> Hash::make($request->password)]);
        if($changepassword){
            return $this->sendSuccessMessage('Password is changed Successfull');
        }else{
            return $this->sendErrorMessage('Some thing is error Please try agian');
        }


    }
    public function updateprofile(Request $request)
    {   $id=auth('api')->user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|min:11|numeric|unique:users,phone,'.$id,
            'email' => 'required|max:255|unique:users,email,'.$id,
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendResponse($validator->errors());
        }
      
          $update=User::find($id)->update([
              'name'=>$request->name ,'phone'=>$request->phone,
              'email'=>$request->email,'address'=>$request->address]);

            if($update){
               return $this->sendSuccessMessage('Your Profile Updated  Successfull');
            }else{
                return $this->sendErrorMessage('Some thing is error Please try agian');
            }


     }
  
}