<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginUserRequest;
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
    protected $redirectTo = '/admin/products/index ';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authLogin(LoginUserRequest $request){
        $validate = $request->validated();
        if(Auth::attempt([
            'name' => $validate['name'],
            'password' => $validate['password'],
        ])){
            return $this->sendLoginResponse($request);
        }else{
            Session::flash('loginErr', '帳號或密碼錯誤');
            return redirect()->back()->withInput();

        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
