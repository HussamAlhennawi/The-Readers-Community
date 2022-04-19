<?php

namespace App\Http\Controllers\Auth;

use App\Lista;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => "required | string | max:25",
            'last_name' => "required | string | max:25",
            'email' => "required | string | email | unique:users",
            'password' => "required | string | min:8 | confirmed",
            'gender' => "required | string",
            'date_of_birth' => "required | date",
            'nationality' => "required | string",
            'bio' => "required | string",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'nationality' => $data['nationality'],
            'bio' => $data['bio'],
        ]);

        $user->attachRole('Reader');

        $list = Lista::create([
            'user_id' => $user->id,
            'name' => 'other',
            'type' => 'post',
            'privacy' => 'public',
        ]);
        $list = Lista::create([
            'user_id' => $user->id,
            'name' => 'best quotations',
            'type' => 'post',
            'privacy' => 'public',
        ]);
        $list = Lista::create([
            'user_id' => $user->id,
            'name' => 'favourite books',
            'type' => 'book',
            'privacy' => 'public',
        ]);
        $list = Lista::create([
            'user_id' => $user->id,
            'name' => 'books i read',
            'type' => 'book',
            'privacy' => 'public',
        ]);
        $list = Lista::create([
            'user_id' => $user->id,
            'name' => 'books want to read',
            'type' => 'book',
            'privacy' => 'public',
        ]);
        $list = Lista::create([
            'user_id' => $user->id,
            'name' => 'favourite authors',
            'type' => 'author',
            'privacy' => 'public',
        ]);

        return $user ;
    }
}
