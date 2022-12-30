<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class TodoController extends Controller
{
    public function todo(){
        return view('front.todo');
    }
}
