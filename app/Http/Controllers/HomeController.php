<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $bearerToken =  Auth::user()->api_token;
        $clinicId = $request->session()->get('clinicId');
        $response = Http::withToken($bearerToken)->get(env('API_URL').'/patients/clinic/'.$clinicId);
        $patientsData = json_decode($response->getBody()->getContents());
        return view('home', ['patients' => $patientsData]);
    }
}
