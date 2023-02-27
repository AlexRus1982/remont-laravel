@extends('layouts.base')

@section('page.title', 'Результат поиска')

@section('content')
    <?php
        $cookieUuid = Cookie::get('cookie-uuid');
                
        $list = DB::table('wish_list')
        ->where('cookie_uuid', $cookieUuid)
        ->select('product_id')
        ->get();
        
        $wishList = [];
        foreach ($list as $item) {
            array_push($wishList, $item->product_id);
        }
    ?>

    <div class="container d-flex justify-content-start flex-wrap" style="max-width: 1200px;">

        @include('includes.search.list', ['products' => $searchResult])
        
        <div class="py-4">
            {{ $searchResult->appends(['searchProducts' => request()->searchProducts])->links() }}
        </div>
        
    </div>

    {{--dd(Route::is('main'))--}}

@endsection

@push('js')
    <script type="text/javascript" src="/public/js/products.js"></script>
    <style>
        div.card {
            transition: 0.3s;
        }

        div.card:hover {
            cursor: pointer;
            transform: scale(1.05) rotateZ(2deg);
        }
    </style>
@endpush