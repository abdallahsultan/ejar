<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.user_profile');
    }
    public function FunctionName()
    {
        return redirect('myprofile');
    }

    public function getRents()
    {
        if(Auth::user()->level == 'user'){

            $res = Reservation::where('user_id',Auth::id())->get();
            return view('home.user_rents', ['res' => $res]);
        }else{
            return redirect()->route('user_car_all');
        }
    }
    public function request_rents()
    {
        
        if(Auth::user()->level == 'office'|| Auth::user()->level == 'renter'){
             

            $res = Reservation::whereHas('car',function  ($query){
                $query->where('user_id',Auth::user()->id);
            })->get();
            return view('home.user_requestrents', ['res' => $res]);
        }else{
            return redirect()->route('user_car_all');
        }
    }
    public function addcarweb()
    {
        $dataList = Category::with('children')->where('parent_id', '!=' , 0)->get();

            return view('home.user_add_car', ['dataList' => $dataList]);
        
    }
    public function storecar(Request $request)
    {
        
        $data = new Car;
        $data->title = $request->input('title');
        $data->keywords = $request->input('keywords');
        $data->description = $request->input('description');
        $data->category_id = $request->input('category_id');
        $data->detail = $request->input('detail');
        $data->price = $request->input('price');
        $data->user_id = Auth::id();
        $data->brand = $request->input('brand');
        $data->brand_id = $request->input('brand_id');
        $data->model = $request->input('model');
        $data->year = $request->input('year');
        $data->licance_plate = $request->input('licance_plate');
        $data->engine_power = $request->input('engine_power');
        $data->fuel_type = $request->input('fuel_type');
        $data->color = $request->input('color');
        $data->gear_type = $request->input('gear_type');
        $data->slug = $request->input('slug');
        $data->status = $request->input('status');
        if ($request->file('image') != null) {
            $data->image = Storage::putFile('images', $request->file('image'));
        }
        
        $data->save();
        return redirect()->route('user_car_all')->with('success', 'Car Added successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allcaruser()
    {  
        $dataList = Car::where('user_id',auth()->user()->id)->get();
        return view('home.user_ِALl_car', ['dataList' => $dataList]);
    }
    public function user_edit_car(Car $car, $id)
    {
        $data = Car::find($id);
        $dataList = Category::with('children')->where('parent_id', '!=' , 0)->get();
        return view('home.user_edit_car', ['data' => $data, 'dataList' => $dataList]);
    }
    public function updatecar(Request $request, Car $car, $id)
    {
        $data = Car::find($id);
        $data->title = $request->input('title');
        $data->keywords = $request->input('keywords');
        $data->description = $request->input('description');
        $data->category_id = $request->input('category_id');
        $data->detail = $request->input('detail');
        $data->price = $request->input('price');
        $data->user_id = Auth::id();
        $data->brand = $request->input('brand');
        $data->brand_id = $request->input('brand_id');
        $data->model = $request->input('model');
        $data->year = $request->input('year');
        $data->licance_plate = $request->input('licance_plate');
        $data->engine_power = $request->input('engine_power');
        $data->fuel_type = $request->input('fuel_type');
        $data->color = $request->input('color');
        $data->gear_type = $request->input('gear_type');
        $data->slug = $request->input('slug');
        $data->status = $request->input('status');
        if ($request->file('image') != null) {
            $data->image = Storage::putFile('images', $request->file('image'));
        }
        $data->save();
        return redirect()->route('user_car_all')->with('success', 'Car Updated successfully.');
    }
    public function user_destroy_car(Car $car, $id)
    {
        $data = Car::find($id);
        $data->delete();
        return redirect()->route('user_car_all');
    }






     //images car

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_image_car($car_id)
    {
        
        $data = Car::find($car_id);
        $images = DB::table('images')->where('car_id',$car_id)->get();
        return view('home.image_car_add',['data'=>$data,'images'=>$images]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_image_car(Request $request,$car_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
           
        ]);
        if ($validator->fails()) {
            
            return Redirect::back()->withErrors($validator);
          
        }

        $data = new Image;
        $data->title = $request->input('title');
        $data->car_id = $car_id;
        if ($request->file('image') != null) {
            $data->image = Storage::putFile('images', $request->file('image'));
        }
        $data->save();
        return redirect()->route('User_image_addcar',['car_id'=>$car_id]);

    }


   
    public function destroy_image_car(Image $image,$id,$car_id)
    {
        $data = Image::find($id);
        $data->delete();
        return redirect()->route('User_image_addcar',['car_id'=>$car_id]);
    }
    

    public function user_car_detail($id){
        $data = Car::find($id);
        $dataList = Image::where('car_id', $id)->get();
        return view('home.Usercar_detail', ['data' => $data,'dataList'=>$dataList]);
    }

   

}
