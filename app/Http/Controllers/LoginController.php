<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MyNotifications;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Patients;
use App\Transfer_Requests;
use App\Graduate_Requests;
use Notifications;
use Carbon\Carbon;
use App\Charts\PatientChart;
use Hash;
use Session;

class LoginController extends Controller
{

    public function home(request $request) 
    {

      $roles = User_roles::all();
      $deps = Departments::all();
  

      if(Auth::check()){
        return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps)->with('users',$users);
      }
      else{
        return redirect('/login')->with('roles',$roles)->with('deps',$deps);
      }
    }

    public function loginnow(request $request)
    {
        $this->validate($request,[
        'username' =>'required',
        'password'=>'required'
      ]);

       $roles = User_roles::all();
       $deps = Departments::all(); 
      

      if(Auth::attempt(['username'=>$request->input('username'), 'password'=>$request->input('password')]))
        {
          return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps);
        }
        else{
          $errors = new MessageBag(['password' => ['Username and/or password invalid.']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
        }
    }

    public function login()
    {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);


      if(Auth::check()){
        return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps)->with('users',$users);
      }
      else{
        return redirect('/login')->with('roles',$roles)->with('deps',$deps);
      }
    }

    public function logout()
    {

      $roles = User_roles::all();
      Auth::logout(); 
      return redirect()->route('login')->with('roles',$roles);
    }

    public function getProfile()
    {
      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $userss = Patients::where('department_id', Auth::user()->department)->get();

      date_default_timezone_set('Asia/Singapore');

      $patients1 = Patients::where('status','Graduated')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $pat = count($patients1);

      $patients2 = Patients::where('status','Dismissed')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $patz = count($patients2);

      $patients3 = Patients::where('status','Enrolled')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $patx = count($patients3);

      $today_users = Patients::whereDate('created_at', today())->count();
      $first_users = Patients::whereDate('created_at', today()->subDays(1))->count();
      $second_users = Patients::whereDate('created_at', today()->subDays(2))->count();
      $third_users = Patients::whereDate('created_at', today()->subDays(3))->count();
      $fourth_users = Patients::whereDate('created_at', today()->subDays(4))->count();
      $fifth_users = Patients::whereDate('created_at', today()->subDays(5))->count();

      $users_a_month = Patients::whereMonth('created_at', date('m'))->count();
      $users_a_year = Patients::whereYear('created_at', date('Y'))->count();

      $chart = new PatientChart;
      $chart->labels([Carbon::now()->subDays(5)->format('M-j'),Carbon::now()->subDays(4)->format('M-j'),Carbon::now()->subDays(3)->format('M-j'),Carbon::now()->subDays(2)->format('M-j'),Carbon::now()->subDays(1)->format('M-j'),'Today']);
      $chart->dataset('Patient(s) Added', 'bar', [$fifth_users,$fourth_users,$third_users,$second_users,$first_users,$today_users])->color('rgba(2,117,216,1)')->backgroundColor('rgba(2,117,216,1)')->lineTension(0.1);
      $chart->height(250);
      
      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
        return view('superadmin.index', compact('chart'))->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('pat',$pat)->with('patx',$patx)->with('patz',$patz);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
        return view('superadmin.index', compact('chart'))->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('pat',$pat)->with('patx',$patx)->with('patz',$patz);
      }
      else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
         return view('socialworker.index')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
      }
      else if(Auth::user()->user_role()->first()->name == 'Nurse'){
         return view('socialworker.index')->with('roles',$roles)->with('deps',$deps)->with('users',$users);
      }
      else if(Auth::user()->user_role()->first()->name == 'Doctor'){
         return view('doctor.index')->with('roles',$roles)->with('deps',$deps)->with('users',$users);
      }
      
    }
}
