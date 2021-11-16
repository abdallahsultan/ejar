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
        //  dd($cars);
        $data=array(['Cars'=>$cars]);
        return $this->sendResponse($data);
        
    }
    
    public function products(){
        
        // auth()->user()->name
        $products= ProductApiResource::collection(Product::all());
        
        
        $data['products']=$products;
        return $this->sendResponse($data);
    }
    public function singleproduct($id){
       
        // auth()->user()->name
        $product= new ProductApiResource(Product::where('id',$id)->first());
        $data['product']=$product;
        return $this->sendResponse($data);
    }
    public function createoffer(OfferRequest $request){
       if(auth()->user()->level == 'stock' || auth()->user()->level == 'pharmacy'){
        $data = $request->except('avatar');
        $data['user_id']=auth()->user()->id;
        $image = $request->avatar;
        if($request-> hasFile('avatar')){ 
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request['name']).time();
            $imageName = $imageName . '.' . $ext;
            $image->move('assets/images/offer', $imageName);
            $data['avatar'] = $imageName;
           }
           
        $Offer=Offer::create($data);
        if($Offer){

            return $this->sendSuccessMessage();
        }else{
            return $this->sendErrorMessage('try agian');

        }
    }else{
          return $this->sendErrorMessage('You cant Create Offer because You not Stock or Pharmacy');
          

      }
    }

    public function my_favorite(){
        
        $userId=auth()->user()->id;

        // dd($userId);
        $products= FavoriteApiResource::collection(Favorite::where('user_id',$userId)->get());
        $data['products']=$products;
      
        return $this->sendResponse($data);
    }

    public function addFavorite(Request $request){
        
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
      
      
        if ($validator->fails()) {
            // return $this->withErrors($validator);
            return $this->sendErrorMessage($validator->errors());
            // return $this->sendErrorMessage('Check Your sent data User / Product ');
            
        }
        $data=$request->all();
        
        $id=auth('api')->user()->id;
        $favorit=Favorite::where('user_id',$id)->where('product_id',$data['product_id'])->latest()->first();
        if(!$favorit){
            $data['user_id']=$id;
            $addfaviorte=Favorite::create($data);
            if($addfaviorte){
                return $this->sendSuccessMessage('Added this product in favorite Sucessfull');
            }else{
                return $this->sendErrorMessage('Some thing is error Please try agian');
            }
        }else{
            $favorit->delete();
            return $this->sendSuccessMessage('deleted this Product from favorite Sucessfull');
        }   


    }
    
    public function contactus(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
      
      
        if ($validator->fails()) {
            return $this->sendErrorMessage($validator->errors());
        }
        
       $ContactUs= ContactUs::create($request->all());
        if($ContactUs){
         return $this->sendSuccessMessage('we will be contacting you soon');
        }else{
            return $this->sendErrorMessage('Some thing is error Please try agian');
        }
    }
    public function privacy()
    {
       $Setting=Setting::latest()->first();
       if($Setting){
           $data['privacy']=$Setting->privacy;
           $data['WhoAreWe']=$Setting->who_we;
        return $this->sendResponse($data);
       }else{
           return $this->sendErrorMessage('Some thing is error ');
       }

    }
    public function searchproduct(Request $request)
    {
        $search=$request->serachKey;
        $search_pay=$request->serachPay;
        $search_pay_id=$request->serachPay_id;
        // dd($search);
        $products= ProductApiResource::collection(Product::WhereHas('payemntsystem', function ($query) use ($search_pay) {
            $query->where('name', $search_pay);
  
        })->OrWhereHas('medicine', function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
            ->OrWhere('description', 'like', "%{$search}%");
  
        })->OrWhereHas('payemntsystem', function ($query) use ($search_pay_id) {
            $query->where('id', $search_pay_id);
        })->get());
       
      

       if($products){
           $data['products']=$products;
         
        return $this->sendResponse($data);
       }else{
           return $this->sendErrorMessage('Some thing is error ');
       }

    }
    
    public function Add_to_cart(Request $request){
        
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
      
      
        if ($validator->fails()) {
            // return $this->withErrors($validator);
            return $this->sendErrorMessage($validator->errors());
            // return $this->sendErrorMessage('Check Your sent data User / Product ');
            
        }
        $data=$request->all();
        
        $id=auth('api')->user()->id;
        $CArt=Cart::where('user_id',$id)->where('product_id',$data['product_id'])->latest()->first();
        if(!$CArt){
            $data['user_id']=$id;
            $data['amount']=1;
            $addfaviorte=Cart::create($data);
            if($addfaviorte){
                return $this->sendSuccessMessage('This product Added to Cart ');
            }else{
                return $this->sendErrorMessage('Some thing is error Please try agian');
            }
        }else{
            if($CArt->amount < 8){
                
            $amount=$CArt->amount +1;
          
            $CArt->update(['amount'=>$amount]);
            return $this->sendSuccessMessage("This product Added to Cart $amount time");
            }else{
                return $this->sendSuccessMessage("You can't added product more than $CArt->amount time");
            }
        }   


    }
    public function my_cart(){
        
        $userId=auth()->user()->id;

        // dd($userId);
        $products= CartApiResource::collection(Cart::where('user_id',$userId)->get());
        $data['products']=$products;
      
        return $this->sendResponse($data);
    }
    

    
}
