<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function introduction(){
        if (Auth::user() !== null) {
            return redirect(route('todo.index'));
        } else {
            return view('front.introduction');
        }
    }
}
