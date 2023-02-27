@extends('layouts.base')

@section('page.title', $product['Наименование'])

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

    <meta name="product-id" content="{{ $product['id'] }}">
    <div class="container d-flex justify-content-center flex-column align-self-center" style="align-items: center; max-width: 1200px;">
        
        <div class="h1 pb-3 me-auto fw-bold">{{$product['Наименование']}}</div>

        @include('includes.product.card-desc-images', ['product' => $product])
        @include('includes.product.card-desc-properties', ['product' => $product])
        @include('includes.product.questions')
        @include('includes.product.reviews')

        @include('includes.product.like')
        @include('includes.product.additions')
        @include('includes.product.see-before')

        <div class="bread-crumps me-auto my-3">
            <span><a href="/">Главная</a></span><span class="px-2">/</span>
            <span><a href="/products">Каталог</a></span><span class="px-2">/</span>
            <span>{{$product['Наименование']}}</span>
        </div>

    </div>

    {{--dd(Route::is('main'))--}}

@endsection

@push('js')
    <script type="text/javascript" src="/public/js/product.js"></script>
    <style>
        #carouselExampleControls.start {
            transition: 0.0s;
            transform: translateX(-2000px) rotateZ(360deg);
        }

        #carouselExampleControls {
            transition: 1.0s;
            transform: translateX(0px) rotateZ(0deg);
        }

        div.card {
            transition: 0.3s;
        }

        div.card img {
            transition: 0.3s;
            filter: grayscale(0.5);
        }

        div.card:hover {
            cursor: pointer;
            /* transform: scale(1.05) rotateZ(2deg); */
        }

        div.card:hover .wishButton,
        div.card:hover .basketButton {
            background-color: #0D6EFDAF;
        }

        .wishButton svg {
            transition: 0.3s;
        }

        .wishButton:hover svg {
            color: #FF0000;
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

        div.card:hover img {
            filter: grayscale(0.0);
        }
    </style>
@endpush