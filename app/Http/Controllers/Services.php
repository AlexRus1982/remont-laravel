<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Services extends Controller
{
    public function show($url){
        $item = DB::table('services')->where('url', $url)->get();
        if (count($item) == 1){
            return view('service', ['service' => (array)$item[0]]);
        }
        else {
            return view('errors.404');
        }
    }
}
