<?php
    $cookieUuid = Cookie::get('cookie-uuid');
            
    //$list = DB::table('wish_list')
    //->where('cookie_uuid', $cookieUuid)
    //->select('product_id')
    //->get();
    //
    //$wishList = [];
    //foreach ($list as $item) {
    //    array_push($wishList, $item->product_id);
    //}

    //dd($offers);

?>

@extends('layouts.base')

@section('page.title', 'Каталог предложений')

@section('content')

    {{-- @include('includes.offers.filter')
    @include('includes.offers.sort') --}}

    <div class="container d-flex justify-content-start flex-wrap" style="max-width: 1200px;">

        {{-- @include('includes.offers.categories')
        @include('includes.offers.tags') --}}
        @include('includes.offers.list', ['offers' => $offers])

    </div>

    {{--dd(Route::is('main'))--}}

@endsection

@push('js')
    <script type="text/javascript" src="/public/js/products.js"></script>
    <style>
        div.card {
            transition: 0.3s;
        }

        div.card img {
            transition: 0.3s;
            filter: grayscale(0.5);
        }

        div.card:hover {
            cursor: pointer;
            /*box-shadow: 0px 0px 16px var(--accent-color)!important;*/
            background: #FEE86340;
            /*color: #FFF;*/ 
            transform: scale(1.05);
        }
        
        div.card:hover img {
            filter: grayscale(0.0);
        }

        .wishButton {
            border: none;
        }

        .wishButton svg {
            transition: 0.3s;
            border: none;
        }

        .wishButton:hover svg {
            color: var(--accent-color);
        }

        .wishButton svg:first-child {
            display: block;
        }

        .wishButton svg:last-child {
            display: none;
        }

        .wishButton.wishset svg:first-child {
            display: none;
        }

        .wishButton.wishset svg:last-child {
            display: block;
        }        
        
    </style>
@endpush