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

    //dd($offer);

?>

@extends('layouts.base')

@section('page.title', 'Каталог предложений')

@section('content')


    <div class="container d-flex justify-content-start flex-wrap flex-grow-1" style="width: 100vw; max-width: 1200px;">
        <div class="w-100 d-flex flex-row align-self-center">
            <div id="offer-gallery" class="d-flex flex-column" style="overflow: hidden;">
                
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://jette.ru/wp-content/uploads/2014/10/gde-luchshe-vsego-priobretat-strojmaterialy-dlya-remonta.jpg" class="border shadow" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="https://avatars.mds.yandex.net/i?id=7b09b9c55ce411919498c0b579c89861_l-5220447-images-thumbs&ref=rim&n=13&w=1080&h=1080" class="border shadow" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.freeimages.com/images/premium/previews/1570/15709846-set-for-home-renovation.jpg" class="border shadow" alt="">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <style>
                #offer-gallery {
                    min-width: min(42vw, 500px);
                    height: min(42vw, 500px);
                    overflow: hidden;
                }

                .carousel-item {
                    height: 500px;
                    min-width: 500px;
                    padding: 30px;
                }

                .carousel-item img {
                    height: 100%;
                    width: 100%;
                    border-radius: 10px;
                    padding: 10px;
                    background-color: var(--footer-background-color);
                    object-fit: contain;
                }

                .carousel-control-next,
                .carousel-control-prev {
                    width: 25%;
                }

                .carousel-control-prev-icon,
                .carousel-control-next-icon {
                    filter: drop-shadow(0px 0px 4px black) drop-shadow(0px 0px 6px black);
                }
            </style>

            <div class="d-flex flex-column flex-grow-1" style="padding: 20px; padding-right: 30px;">
                <div class="d-flex flex-row justify-content-between pb-2">
                    <div style="color: var(--accent-color);">{{$offer->category_name}}</div><div style="color: var(--accent-color);">{{$offer->sub_category_name}}</div>
                </div>
                <div class="d-flex flex-row pb-2 align-items-center">
                    <div style="color: var(--accent-color); min-width: 100px; text-align: left;">Заголовок:</div><div class="fw-bolder fs-5">{{$offer->title}}</div>
                </div>
                <div class="d-flex flex-row">
                    <div style="color: var(--accent-color); min-width: 100px; text-align: left;">Описание:</div><div style="text-align: justify;">{{$offer->description}}</div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center pt-3 mt-auto">
                    <div class="fw-bolder fs-5" style="color: var(--accent-color); padding-left: 100px;">{{$offer->offer_price}} ₽</div><div>{{$offer->author_FIO}} от {{$offer->created_at}}</div>
                </div>
            </div>
        </div>
    </div>

    {{--dd(Route::is('main'))--}}

@endsection

@push('js')
    <script type="text/javascript" src="/js/offer.js"></script>
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