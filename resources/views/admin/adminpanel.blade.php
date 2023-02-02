<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/images/tools.ico" type="image/x-icon">

    <title>Панель администратора</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/admin/admin_panel.css" />

    <style>
        .preloader {
            position: fixed;
            top: 0px;
            left: 0px;
            bottom: 0px;
            right: 0px;
            background: #FFFFFFFF;
            opacity: 1.0;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 1.0s;
            z-index: 100000;
        }

        .preloader.off {
            opacity: 0.0;
        }

        .preloader svg {
            animation-name: rotation;
            animation-duration: 2s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes rotation {
            0% {
                transform:rotate(0deg);
            }
            100% {
                transform:rotate(360deg);
            }
        }
    </style>

</head>
<body>
    <div class="preloader">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-yin-yang" viewBox="0 0 16 16">
            <path d="M9.167 4.5a1.167 1.167 0 1 1-2.334 0 1.167 1.167 0 0 1 2.334 0Z"/>
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM1 8a7 7 0 0 1 7-7 3.5 3.5 0 1 1 0 7 3.5 3.5 0 1 0 0 7 7 7 0 0 1-7-7Zm7 4.667a1.167 1.167 0 1 1 0-2.334 1.167 1.167 0 0 1 0 2.334Z"/>
        </svg>
    </div>

    @include('admin.includes.offcanvas.catalog_window')
    @include('admin.includes.offcanvas.products')
    @include('admin.includes.offcanvas.product_edit')
    @include('admin.includes.offcanvas.property_edit')
    @include('admin.includes.offcanvas.property_values')
    @include('includes.messages-panel')

    <main class="min-vh-100 w-100">

        <div class="card text-center vh-100" style="box-shadow: 0px 5px 4px #0000FF7F;">
            <div class="card-header pb-0">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Главная</button>
                    <button class="nav-link" id="nav-services-pages-tab" data-bs-toggle="tab" data-bs-target="#nav-services-pages" type="button" role="tab" aria-controls="nav-services-pages" aria-selected="false">Сервисные страницы</button>
                    <button class="nav-link" id="nav-search-logs-tab" data-bs-toggle="tab" data-bs-target="#nav-search-logs" type="button" role="tab" aria-controls="nav-search-logs" aria-selected="false">Поисковые логи</button>
                    <button class="nav-link" id="nav-orders-logs-tab" data-bs-toggle="tab" data-bs-target="#nav-orders-logs" type="button" role="tab" aria-controls="nav-orders-logs" aria-selected="false">Заказы</button>
                    <button class="nav-link" id="nav-catalog-tab" data-bs-toggle="tab" data-bs-target="#nav-catalog" type="button" role="tab" aria-controls="nav-catalog" aria-selected="false">Каталог</button>
                    <button class="nav-link" id="nav-properties-tab" data-bs-toggle="tab" data-bs-target="#nav-properties" type="button" role="tab" aria-controls="nav-properties" aria-selected="false">Свойства</button>
                    <button class="nav-link" id="nav-tags-tab" data-bs-toggle="tab" data-bs-target="#nav-tags" type="button" role="tab" aria-controls="nav-tags" aria-selected="false">Тэги</button>
                    <a class="nav-link ms-auto fs-4 mb-1 py-0" href="/" target="_blank">Главная</a>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <input type="date">
                </div>
                
                {{--<!-- Панель сервисных страниц -->--}}
                @include('admin.includes.tabs.tab_services')

                {{--<!-- Панель поисковых логов -->--}}
                @include('admin.includes.tabs.tab_searches')

                {{--<!-- Панель заказов -->--}}
                @include('admin.includes.tabs.tab_orders')

                {{--<!-- Каталог товаров -->--}}
                @include('admin.includes.tabs.tab_catalog')

                {{--<!-- Свойства товаров -->--}}
                @include('admin.includes.tabs.tab_properties')
                
                {{--<!-- Тэги -->--}}
                @include('admin.includes.tabs.tab_tags')
            </div>
        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/js/nic-edit.js" type="text/javascript"></script>
    <script type="module" src="/js/init.js"></script>
    <script type="module" src="/js/admin.js"></script>

    <script>
        $(document).ready(function() { 
            $('.preloader').addClass('off');
            setTimeout(() => {
                $('.preloader').remove();
            }, 1000);
        });
    </script>

</body>
</html>