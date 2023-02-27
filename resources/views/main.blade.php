<?php
    $cookieUuid = Cookie::get('cookie-uuid');
?>

@extends('layouts.base')

@section('page.title', 'После ремона')

@section('content')
    
    <div class="container d-flex justify-content-start flex-wrap p-0 m-0" style="max-width: 1200px;">

        @include('includes.banner')

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
            /* transform: scale(1.05) rotateZ(2deg); */
        }
        
        div.card:hover img {
            filter: grayscale(0.0);
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
    </style>
@endpush