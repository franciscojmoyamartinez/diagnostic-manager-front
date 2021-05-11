<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $patientId)
    {
        $bearerToken =  $request->session()->get('api_token');
        $response = Http::withToken($bearerToken)->get(env('API_URL').'/diagnostic/'.$patientId);
        $diagnosticData = json_decode($response->getBody()->getContents());
        return view('diagnostic', ['diagnostics' => $diagnosticData, 'patientId' => $patientId]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $patientId)
    {   
        // Validate
        $validated = $request->validate([
            'diagnostic' => 'required|min:1|max:255',
            'comments' => 'required|min:1'
        ]);
        $bearerToken =  $request->session()->get('api_token');       
        $response = Http::withToken($bearerToken)->post(env('API_URL').'/diagnostic', [
            'diagnostic' => $request->diagnostic,
            'description' => $request->comments,
            'date_diagnostic' =>date("Y-m-d"),
            'patient_id' => $patientId
            ]);
        switch($response->getStatusCode()){
            case 201:
                $message = 'Diagnostic created!!!';
            break;
            case 404:
                $message = 'Error create!!!';
            break;
        }
        return redirect('/patient/diagnostic/'.$patientId)->with('status',$message)->with('statusCode',$response->getStatusCode());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
