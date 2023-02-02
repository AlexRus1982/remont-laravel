<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class Search extends Controller
{
    const cookieUuidLifeTime = 60 /* $minutes = 60 * 24 * 365 * 10; // 10 years */;

    function checkCookieUuid() {
        $cookieUuid = Cookie::get('cookie-uuid');
        $uuid = ($cookieUuid != '') ? $cookieUuid : (string) Str::uuid();
        Config::set('cookie-uuid', $uuid);
    }

    public function showSearchResult(Request $request){
        $this->checkCookieUuid();

        $searchProducts = $request->searchProducts;

        // write searching log to base
        $now = new \DateTime();
        DB::table('searching_logs')->insert([
            'search_text' => $searchProducts, 
            'timestamp'   => $now,
        ]);

        // find searching value
        $items = DB::table('catalog')->where('Наименование', 'LIKE', "%{$searchProducts}%")
                                     ->orWhere('Свойство: Материал', 'LIKE', "%{$searchProducts}%")
                                     ->orWhere('Описание', 'LIKE', "%{$searchProducts}%")
                                     ->paginate(8);

        if (count($items)){
            return response()
            ->view('search', ['searchResult' => $items])
            ->cookie('cookie-uuid', Config::get('cookie-uuid'), Search::cookieUuidLifeTime);
        }
        else {
            return view('errors.404');
        }
    }
}
