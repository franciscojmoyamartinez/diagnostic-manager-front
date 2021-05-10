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

    public function editView($patientId)
    {
        $bearerToken =  Auth::user()->api_token;
        $response = Http::withToken($bearerToken)->get(env('API_URL').'/patients/'.$patientId);
        $patientData = json_decode($response->getBody()->getContents());
        return view('edit', ['patient' => $patientData]);
    }

    public function edit(Request $request, $patientId)
    {   
        $bearerToken =  Auth::user()->api_token;
        $response = Http::withToken($bearerToken)->put(env('API_URL').'/patients/'.$patientId, [
            'fullname' => $request->fullname,
            'governmentId' => $request->governmentId,
            ]);
        switch($response->getStatusCode()){
            case 200:
                $message = 'Patients updated!!!';
            break;
            case 404:
                $message = 'Error update!!!';
            break;
        }
        return redirect('/home')->with('status',$message)->with('statusCode',$response->getStatusCode());
    }
    /**
     * @param  int  $id
     * @return 
     */
    public function delete($id)
    {
        $bearerToken =  Auth::user()->api_token;
        $response = Http::withToken($bearerToken)->delete(env('API_URL').'/patients/'.$id);
        switch($response->getStatusCode()){
            case 204:
                $message = 'Patients deleted!!!';
            break;
            case 404:
                $message = 'Error deleted!!!';
            break;
        }
        return redirect('/home')->with('status',$message)->with('statusCode',$response->getStatusCode());
    }
}
