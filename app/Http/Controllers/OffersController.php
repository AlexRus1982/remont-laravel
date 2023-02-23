<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class OffersController extends Controller
{
    const cookieUuidLifeTime = 60 /* $minutes = 60 * 24 * 365 * 10; // 10 years */;

    function checkCookieUuid() {
        $cookieUuid = Cookie::get('cookie-uuid');
        $uuid = ($cookieUuid != '') ? $cookieUuid : (string) Str::uuid();
        Config::set('cookie-uuid', $uuid);
    }

    public function showAll(Request $request){
        $this->checkCookieUuid();

        $offers = DB::table('offers')
        ->join('categories', 'categories.categories_id', '=', 'offers.category_id')
        ->join('sub_categories', 'sub_categories.sub_categories_id', '=', 'offers.subcategory_id')
        ->join('authors', 'authors.authors_id', '=', 'offers.author_id')
        ->orderBy('created_at')

        ->paginate(16);

        return response()
        ->view('offers', ['offers' => $offers])
        ->cookie('cookie-uuid', Config::get('cookie-uuid'), Products::cookieUuidLifeTime);
    }

    public function showOffer($id){
        $this->checkCookieUuid();

        $offer = DB::table('offers')
        ->join('categories', 'categories.categories_id', '=', 'offers.category_id')
        ->join('sub_categories', 'sub_categories.sub_categories_id', '=', 'offers.subcategory_id')
        ->join('authors', 'authors.authors_id', '=', 'offers.author_id')
        ->where('id', $id)
        ->first();

        if ($offer){
            return response()
            ->view('offer', ['offer' => $offer])
            ->cookie('cookie-uuid', Config::get('cookie-uuid'), Products::cookieUuidLifeTime);
        }
        else {
            return response()
            ->view('errors.404');
        }
    }
}
