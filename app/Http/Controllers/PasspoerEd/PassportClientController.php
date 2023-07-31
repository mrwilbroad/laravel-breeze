<?php

namespace App\Http\Controllers\PasspoerEd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassportClientController extends Controller
{
    
    public function index(Request $request)
    {
        // dd("here");
        // dd($request->user()->clients);
        return view("profile.Clients", [
            "Clients" => $request->user()->clients
        ]);
    }
}
