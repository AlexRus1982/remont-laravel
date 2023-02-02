<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasketController extends Controller
{
    
    public function index() {
        return view('basket.index');
    }

    public function checkout() {
        return view('basket.checkout');
    }

}
