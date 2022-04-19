<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     *
     * @param $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
//    protected $redirectTo = '/user';
////        "{{ route ('user.show', Auth::user())}}";

    public function authenticated($request , $user){

        $role_id = \DB::table('role_user')->select('role_id')->where('user_id', '=',$user->id )->first();
//dd($role_id);
        if($role_id->role_id == 1){
            return redirect()->route('user.show', $user) ;
        }elseif($role_id->role_id == 2){
            return redirect()->route('admindashbord') ;
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
