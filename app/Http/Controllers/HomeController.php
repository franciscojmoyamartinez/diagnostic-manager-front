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

        $bearerToken =  $request->session()->get('api_token');
        $clinicId = $request->session()->get('clinicId');
        $response = Http::withToken($bearerToken)->get(env('API_URL').'/patients/clinic/'.$clinicId);
        $patientsData = json_decode($response->getBody()->getContents());
        return view('home', ['patients' => $patientsData]);
    }

    public function formView(Request $request)
    {
        $bearerToken =  $request->session()->get('api_token');
        $response = Http::withToken($bearerToken)->get(env('API_URL').'/clinics');
        $clinicsData = json_decode($response->getBody()->getContents());
        return view('edit', ['clinics' => $clinicsData]);
    }
    
    public function store(Request $request)
    {   
        // Validate
        $validated = $request->validate([
            'fullname' => 'required|min:1|max:255',
            'governmentId' => 'required|min:9',
            'clinicId' => 'required|integer'
        ]);

        $bearerToken =  $request->session()->get('api_token');
        $response = Http::withToken($bearerToken)->post(env('API_URL').'/patients', [
            'fullname' => $request->fullname,
            'governmentId' => $request->governmentId,
            'clinicId' => $request->clinicId
            ]);
        switch($response->getStatusCode()){
            case 201:
                $message = 'Patients created!!!';
            break;
            case 404:
                $message = 'Error create!!!';
            break;
            case 422:
                $message = 'Error duplicate entry!!!';
            break;
        }
        return redirect('/home')->with('status',$message)->with('statusCode',$response->getStatusCode());
    }

    public function editView(Request $request, $patientId)
    {
        $bearerToken =  $request->session()->get('api_token');
        $response = Http::withToken($bearerToken)->get(env('API_URL').'/patients/'.$patientId);
        if($response->getStatusCode() === 401){
            abort(403, 'Unauthorized action.');
        }

        $patientData = json_decode($response->getBody()->getContents());
        return view('edit', ['patient' => $patientData]);
    }
    /**
     * Edit patients information
     *  * @param  Request  $request
     *  * @param  int      $patientId
     *    @return Redirect
     */
    public function edit(Request $request, $patientId)
    {   
        // Validate
        $validated = $request->validate([
            'fullname' => 'required|min:1|max:255',
            'governmentId' => 'required|min:9'
        ]);
        $bearerToken =  $request->session()->get('api_token');
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
            case 422:
                $message = 'Error duplicate entry!!!';
            break;
        }
        return redirect('/home')->with('status',$message)->with('statusCode',$response->getStatusCode());
    }
    /**
     * @param  int  $id
     * @return 
     */
    public function delete(Request $request, $id)
    {
        $bearerToken =  $request->session()->get('api_token');
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
