<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function Gets(Request $request){
        $contact = request->session()->get()
    }

}
