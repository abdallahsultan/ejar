<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Car;
use App\Models\Faq;
use App\Models\User;
use App\Models\Image;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //

    public function Acardetail($id)
    {
        $userid = Auth::id();
        $data = Car::find($id);
        $dataList = Image::where('car_id', $id)->get();
        return view('home.car_detail', ['data' => $data, 'dataList' => $dataList, 'userid' => $userid]);

    }

    public function faq()
    {
        $dataList = Faq::all()->sortBy('position');
        return view('home.faq', ['dataList' => $dataList]);
    }

    public static function categoryList()
    {
        return Category::where('parent_id', '=', 0)->with('children')->get();
    }
    public static function getSetting()
    {
        return Setting::first();
    }


    public function allcars()
    {
        $data = Car::where('status', 'True')->paginate(6);
        //print_r($data);
        //exit();
        return view('home.car_list', ['dataList' => $data]);
    }

    public function cars($id, $slug)
    {
        $data = Car::where('category_id', $id)->where('status', 'True')->paginate(6);
        //print_r($data);
        //exit();
        return view('home.car_list', ['dataList' => $data]);
    }

    public function carDetail($id, $slug)
    {
        $userid = Auth::id();
        $data = Car::find($id);
        $dataList = Image::where('car_id', $id)->get();
        if(Auth::check()){
            return view('home.car_detail', ['data' => $data, 'dataList' => $dataList, 'userid' => $userid]);
        }else{
            return redirect()->route('login');
        }
        
        // print_r($dataList);
        //exit();
        
    }

    public function getcar(Request $request)
    {
        $search = $request->input('search');
        if($search== null){
            $search=' ';
        }

        $count = Car::where('color', 'like', '%' . $search . '%')->Orwhere('title', 'like', '%' . $search . '%')->where('status', 'True')->get()->count();

        if ($count == 1) {
            $data = Car::where('color', 'like', '%' . $search . '%')->Orwhere('title', 'like', '%' . $search . '%')->where('status', 'True')->first();
            return redirect()->route('cardetail', ['id' => $data->id, 'slug' => $data->slug]);
        } else {
            return redirect()->route('carlist', ['search' => $search]);
        }
    }
    public function register(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|max:255|unique:users,email,',
            'level' => 'required',
            'password' => 'required|min:6',
            'phone' => 'required|min:10|numeric|unique:users,phone,',
           
            
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
         
           
        }
      
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'level' =>$data['level'],
            'phone' =>$data['phone'],
        ]);
        if($user){
            auth()->login($user);
            Session::flash('message', 'this is a message');
            return redirect()->route('home')->with('success', '???? ?????????? ????????????');
        }else{
            Session::flash('message', 'this is a message');
            return back()->with('error', '?????? ?????? ????????');
        }
    }

    public function carlist($search)
    {
        
         
        $dataList = Car::where('status', 'True')->Orwhere('title', 'like', '%' . $search . '%')->
                                                Orwhere('price', 'like', '%' . $search . '%')->
                                                Orwhere('color', 'like', '%' . $search . '%')->
                                                Orwhere('slug', 'like', '%' . $search . '%')->
                                                Orwhere('brand', 'like', '%' . $search . '%')->paginate(4);
        // dd($dataList);
        return view('home.search_cars', ['search' => $search, 'dataList' => $dataList]);
    }
    public function carsearch(Request $request )
    {
        $search=$request->car_search;
        if(!$search){
            $search='';
        }
        $orderby=$request->orderby;
        if($orderby){
            if($orderby == 'low_price'){
                $ord='asc';
            }elseif($orderby == 'higher_price'){
                $ord='desc';
            
            }
                
                $dataList = Car::where('status', 'True')->where('title', 'like', '%' . $search . '%')->
                                                        Orwhere('price', 'like', '%' . $search . '%')->
                                                        Orwhere('color', 'like', '%' . $search . '%')->
                                                        orderBy('price', $ord)->
                                                        Orwhere('slug', 'like', '%' . $search . '%')->
                                                        Orwhere('brand', 'like', '%' . $search . '%')->get();
                // dd($dataList);
                return view('home.search_cars', ['search' => $search, 'dataList' => $dataList]);
            
              
        }else{
            return redirect()->route('carlist', ['search' => $search]);
        }
     }


    public function aboutus()
    {
        return view('home.about');
    }

   
    public function contactus()
    {
        return view('home.contact');
    }
    public function references()
    {
        return view('home.references');
    }

    public function index()
    {
        //  dd('asfsaf');
        $setting = Setting::first();
        // dd($setting);

        $slider = Car::select('id', 'title', 'image', 'price', 'slug')->limit(6)->get();
        $daily = Car::select('id', 'title', 'image', 'price', 'slug', 'brand', 'model', 'gear_type', 'engine_power', 'fuel_type')->where('status','true')->limit(4)->inRandomOrder()->get();
        $last = Car::select('id', 'title', 'image', 'price', 'slug', 'brand', 'model', 'gear_type', 'engine_power', 'fuel_type','user_id')->where('status','true')->limit(4)->orderByDesc('id')->get();
        $picked = $daily = Car::select('id', 'title', 'image', 'price', 'slug', 'brand', 'model', 'gear_type', 'engine_power', 'fuel_type')->where('status','true')->limit(5)->inRandomOrder()->get();



        $data = [
            'slider' => $slider,
            'setting' => $setting,
            'daily' => $daily,
            'last' => $last,
            'picked' => $picked,
            'page' => 'home'
        ];
        // ???????? ?????????? ???????? view   ???????? ?????? ???????????? ?????? ?????????? 
        return view('home.index', $data);
    }


    public function login()
    {
        return view('admin.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function logincheck(Request $request)
    {


        if ($request->isMethod('post')) {

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {

                $request->session()->regenerate();
                return redirect()->intended('admin');
            }

            return back()->withErrors([
                'email' => 'the provided credentials do not match our records.'
            ]);
        } else {
            return view('admin.login');
        }
    }

    public function sendmessage(Request $request)
    {
        if (Auth::check()){
        $data =  new Message();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->subject = $request->input('subject');
        $data->message = $request->input('message');
        $data->user_id = Auth::user()->id;
        $data->save();
        Session::flash('message', 'this is a message');
        return redirect()->route('contactus');
        }else{
            return redirect()->route('login');
            Session::flash('message', '?????? ?????????? ???????????? ????????');
        }
    }

    public function makeReservation(Request $request, $car_id, $user_id)
    {


        $updateCar = Car::find($car_id);
        $updateCar->status = 'False';
        $slug = $updateCar->slug;
        
        

        $data = new Reservation();
        $data->phone = $request->input('phone');
        $data->payment_method = $request->input('payment_method');
        $data->comment = $request->input('comment');
        $data->car_id = $car_id;
        $data->user_id = $user_id;
        $data->r_start_date = $request->input('r_start_date');
        $data->r_end_date = $request->input('r_end_date');

            $sdate = $request->input('r_start_date');
            $edate = $request->input('r_end_date');
            $datetime1 = new DateTime($sdate);
            $datetime2 = new DateTime($edate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');

        $data->price = $updateCar->price * $days;

        $updateCar->save();
        $data->save();
        Session::flash('message', 'this is a message');
        return redirect()->route('cardetail', ['id' => $car_id, 'slug' => $slug])->with('success', 'Reservation successfully added.');
    }
}
