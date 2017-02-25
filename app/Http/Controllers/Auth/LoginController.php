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
	 * @var string
	 */
	public $redirectTo = '/attendance/dashboard';

	/**
     * todo :: fix issue with login on production
     */

    public function login()
    {
        $email = $_POST['email_nm'];
        $password = $_POST['password'];
        if(Auth::attempt(['email_nm'=> $email , 'password' => $password ]))
        {
            return redirect()->to('/attendance/dashboard');
        }
    }

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'logout']);
	}
}
