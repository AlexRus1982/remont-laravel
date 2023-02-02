<?php
    
    use Illuminate\Http\Request;

    if (!function_exists('active_link')) {

        function active_link(string $name) {
            return $name;
        }

    }

    if (!function_exists('getImageUrl')) {

        function getImageUrl($image) {
            if ($image != ""){
                $imageURL = "https://leger.market/pictures/product/middle/{$image}_middle.jpg";
                //$imageURL = "https://fakeimg.pl/300x300/7F7FFF/FFFFFF/?text={$image}&font=kelson";
            }
            else {
                $imageURL = "https://fakeimg.pl/300x300/EEEEEE/7F7F7F/?text=NO IMAGE&font=kelson";
            }
            return $imageURL;
        }

    }

    if (!function_exists('makeGestId')) {

        function makeGestId() {
            $sessionId = session()->get('_token');

            $gest = DB::table('gests')
                    ->where([['session_id', '=', "{$sessionId}"], ])
                    ->select('order_hash')
                    ->get();
            
            if (count($gest) == 0){
                $order_hash = str_random(30);
                DB::table('gests')->insert(['session_id' => $sessionId, 'order_hash' => $order_hash]);
            }
            else {
                $order_hash = $gest[0]->order_hash;
                if ($order_hash == "") {
                    $order_hash = str_random(30);
                }
                
                DB::table('gests')
                ->where([['session_id', '=', "{$sessionId}"], ])
                ->update(['order_hash' => $order_hash]);
            }
        

            echo "<script type='text/javascript'>window.session_id = '{$sessionId}';</script>";
        }

    }

?>