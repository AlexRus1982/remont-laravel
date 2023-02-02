<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;


class Products extends Controller
{
    const cookieUuidLifeTime = 60 /* $minutes = 60 * 24 * 365 * 10; // 10 years */;

    function checkCookieUuid() {
        $cookieUuid = Cookie::get('cookie-uuid');
        $uuid = ($cookieUuid != '') ? $cookieUuid : (string) Str::uuid();
        Config::set('cookie-uuid', $uuid);
    }

    public function showMain(){
        $this->checkCookieUuid();

        return response()
        ->view('main')
        ->cookie('cookie-uuid', Config::get('cookie-uuid'), Products::cookieUuidLifeTime);
    }

    public function showAll(Request $request){
        $this->checkCookieUuid();

        Log::debug(json_encode($request->cookie()));

        $id = 0;
        $items = DB::table('catalog')
        ->join('hierarchy_products', 'catalog.id', '=', 'hierarchy_products.product_id')
        ->where('hierarchy_products.parent_id', $id)
        ->orderBy('order_place')
        ->paginate(32);

        // $table = DB::table('catalog')->paginate(32);
        // $table = DB::table('catalog')->take(20)->get();
        return response()
        ->view('products', ['products' => $items, 'id' => $id])
        ->cookie('cookie-uuid', Config::get('cookie-uuid'), Products::cookieUuidLifeTime);
    }

    public function show($url){
        $this->checkCookieUuid();

        $item = DB::table('catalog')->where('URL адрес', $url)->get();
        if (count($item)){
            return response()
            ->view('product', ['product' => (array)$item[0]])
            ->cookie('cookie-uuid', Config::get('cookie-uuid'), Products::cookieUuidLifeTime);
        }
        else {
            return view('errors.404');
        }
    }

    public function visited(Request $request){
        $item = DB::table('visited_list')
        ->where('product_id', $request->product_id)
        ->where('cookie_uuid', $request->cookie_uuid)
        ->get();

        if (count($item)){
            return response()->json([ 'server-answer' => "visit already exists." ]);
        }
        else {
            DB::table('visited_list')
            ->insert([
                'product_id' => $request->product_id,
                'cookie_uuid' => $request->cookie_uuid,
            ]);
            return response()->json([ 'server-answer' => "visit added." ]);
        }
    }

    public function wished(Request $request){
        $item = DB::table('wish_list')
        ->where('product_id', $request->product_id)
        ->where('cookie_uuid', $request->cookie_uuid)
        ->get();

        if (count($item)){
            return response()->json([ 'server-answer' => "wished product already exists." ]);
        }
        else {
            DB::table('wish_list')
            ->insert([
                'product_id' => $request->product_id,
                'cookie_uuid' => $request->cookie_uuid,
            ]);
            return response()->json([ 'server-answer' => "wished product added." ]);
        }
    }

    public function wishedDelete(Request $request){
        DB::table('wish_list')
        ->where('product_id', $request->product_id)
        ->where('cookie_uuid', $request->cookie_uuid)
        ->delete();
        return response()->json([ 'server-answer' => "wished deleted." ]);
    }

    public function wishedList() {
        $cookieUuid = Cookie::get('cookie-uuid');
        $list = DB::table('wish_list')
        ->join('catalog', 'catalog.id', '=', 'wish_list.product_id')
        ->where('wish_list.cookie_uuid', $cookieUuid)
        ->get();

        return response()->json([ 'wishedList' => $list ]);
    }

    public function showCategory($url){
        $this->checkCookieUuid();

        $categories = DB::table('categories')
        ->where('url', $url)
        ->get();

        if (count($categories) > 0){
            $id = $categories[0]->id;
        }
        else {
            $id = -1;
        }

        $items = DB::table('catalog')
        ->join('hierarchy_products', 'catalog.id', '=', 'hierarchy_products.product_id')
        ->where('hierarchy_products.parent_id', $id)
        ->orderBy('order_place')
        ->paginate(32);

        Log::debug($id);

        // $table = DB::table('catalog')->paginate(32);
        // $table = DB::table('catalog')->take(20)->get();
        return response()
        ->view('products', ['products' => $items, 'id' => $id])
        ->cookie('cookie-uuid', Config::get('cookie-uuid'), Products::cookieUuidLifeTime);
    }

    public function showTags($url){
        $this->checkCookieUuid();

        $tags = DB::table('tags')
        ->where('property_url', $url)
        ->get();

        if (count($tags) > 0){
        }
        else {
            return response()->json([ "server_answer" => "error", ]);
        }

        // $items = DB::table('catalog')
        // ->join('hierarchy_products', 'catalog.id', '=', 'hierarchy_products.product_id')
        // ->where('hierarchy_products.parent_id', $id)
        // ->orderBy('order_place')
        // ->paginate(32);

        // Log::debug($id);

        // return response()
        // ->view('products', ['products' => $items, 'id' => $id])
        // ->cookie('cookie-uuid', Config::get('cookie-uuid'), Products::cookieUuidLifeTime);
    }
}
