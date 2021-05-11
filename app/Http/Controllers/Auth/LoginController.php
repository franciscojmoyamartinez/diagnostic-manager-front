<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        
        $this->validateLogin($request);

        $response = Http::post(env('API_URL').'/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/login');
        }
        $dataResponse = json_decode($response->getBody()->getContents());
        $clinic = $dataResponse->user->clinic[0];
        Session::put([ 'clinicId' => $clinic->id, 'clinicName' => $clinic->name, 'api_token' => $dataResponse->user->api_token ]);
        return redirect('/home');


    }
}
