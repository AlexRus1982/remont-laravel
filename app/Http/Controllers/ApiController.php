<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    //---------------------------------------------------------------------------------------
    #region services functions --------------------------------------------------------------

    public function GetServicePageContent($url) {
        $pageContent = DB::table('services')->select('service_text')->where('url', $url)->get();
        return $pageContent[0]->service_text;
    }

    public function SaveServicePageContent($url, Request $request) {
        $content = $request->content;
        DB::table('services')->where('url', $url)->update(['service_text' => $content]);
        return "success";
    }
    #endregion services functions -----------------------------------------------------------
    //---------------------------------------------------------------------------------------
    
    //---------------------------------------------------------------------------------------
    #region basket functions ----------------------------------------------------------------
    
    public function BasketGetCount(Request $request) {
        $order_hash = $request->order_hash;
        $products = DB::table('basket_products')->where([['order_hash', '=', "{$order_hash}"], ])->get();
        $count = 0;
        foreach ($products as $product) {
            $count += $product->quantity;
        }
        return $count;
    }

    public function BasketAdd(Request $request) {
        $order_hash = $request->order_hash;
        Log::info(['order_hash', $request->order_hash]);
        $itemId = $request->itemId;
        $products = DB::table('basket_products')->where([['order_hash', '=', "{$order_hash}"], ['product_id', '=', "{$itemId}"],])->get();
        if (count($products) > 0){
            $count = $products[0]->quantity;
            $count++;
            DB::table('basket_products')->where('product_id', "{$itemId}")->update([
                'quantity' => "{$count}",
            ]);
            return "уже есть такой продукт {$count}";
        }
        else {
            DB::table('basket_products')->insert([
                'order_hash' => "{$order_hash}",
                'product_id' => "{$itemId}",
            ]);
            return "нет такого продукта";
        }
        return "{$itemId} ====> {$order_hash}";
    }

    public function BasketInc(Request $request) {
        $order_hash = $request->order_hash;
        $itemId = $request->itemId;
        $products = DB::table('basket_products')->where([['order_hash', '=', "{$order_hash}"], ['product_id', '=', "{$itemId}"],])->get();
        if (count($products) > 0){
            $count = $products[0]->quantity;
            $count++;
            DB::table('basket_products')->where('product_id', "{$itemId}")->update([
                'quantity' => "{$count}",
            ]);
            return $count;
        }
        return "0";
    }

    public function BasketDec(Request $request) {
        $order_hash = $request->order_hash;
        $itemId = $request->itemId;
        $products = DB::table('basket_products')->where([['order_hash', '=', "{$order_hash}"], ['product_id', '=', "{$itemId}"],])->get();
        if (count($products) > 0){
            $count = $products[0]->quantity;
            $count--;
            if ($count < 0) {
                $count = 0;
            }

            DB::table('basket_products')->where('product_id', "{$itemId}")->update([
                'quantity' => "{$count}",
            ]);
            return $count;
        }
        return "0";
    }    

    public function BasketRemove(Request $request) {
        $order_hash = $request->order_hash;
        $itemId = $request->itemId;
        DB::table('basket_products')->where([['order_hash', '=', "{$order_hash}"], ['product_id', '=', "{$itemId}"],])->delete();
        return "Removed";
    }    

    public function BasketList(Request $request) {
        $order_hash = $request->order_hash;
        $products = DB::table('basket_products')
                    ->where([['order_hash', '=', "{$request->order_hash}"], ])
                    ->join('catalog', 'catalog.id', '=', 'basket_products.product_id')
                    ->select('basket_products.product_id', 'catalog.Наименование', 'catalog.Описание', 'catalog.Фото товара', 'catalog.Цена', 'basket_products.quantity')
                    ->get();
        return $products;
    }

    #endregion basket functions -------------------------------------------------------------
    //---------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------
    #region orders functions ----------------------------------------------------------------
    
    public function CloseOrder(Request $request) {
        DB::table('orders')->insert([
            'order_hash'   => $request->order_hash,
            'city'         => $request->city,
            'phone_number' => $request->phone_number,
            'name'         => $request->name,
            'adress'       => $request->adress,
            'order_summ'   => $request->order_summ,
        ]);
        
        $order_hash = str_random(30);
        
        DB::table('gests')
        ->where([['session_id', '=', "{$request->session_id}"], ])
        ->update(['order_hash' => $order_hash]);
    }

    #endregion orders functions -------------------------------------------------------------
    //---------------------------------------------------------------------------------------


    //---------------------------------------------------------------------------------------
    #region orders functions ----------------------------------------------------------------
    
    public function GetOrderHash(Request $request) {
        
        $gest = DB::table('gests')
        ->where([['session_id', '=', "{$request->session_id}"], ])
        ->select('order_hash')
        ->get();
        
        if (count($gest) == 0){
            return "";
        }
        else {
            return $gest[0]->order_hash;
        }
    }

    public function GetOrdersList(Request $request) {
        
        $orders = DB::table('orders')
        ->get();
        
        return $orders;
    }

    public function GetOrderProducts(Request $request) {
        
        $products = DB::table('basket_products')
        ->join('catalog', 'basket_products.product_id', '=', 'catalog.id')
        ->where([['basket_products.order_hash', '=', "{$request->order_hash}"], ])
        ->get();
        
        return $products;
    }

    #endregion orders functions -------------------------------------------------------------
    //---------------------------------------------------------------------------------------

}
