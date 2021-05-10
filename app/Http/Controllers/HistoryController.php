<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patientId)
    {
        $bearerToken =  Auth::user()->api_token;
        $response = Http::withToken($bearerToken)->get(env('API_URL').'/history/'.$patientId);
        $histories = json_decode($response->getBody()->getContents());
        return view('history', ['histories' => $histories, 'patientId' => $patientId]);
    }

}
