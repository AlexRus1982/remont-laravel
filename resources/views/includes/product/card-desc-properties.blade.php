<?php
    $formatedPrice = number_format($product['Цена'], 0, '.', ' ');

    $tags = DB::table('tags')
    ->get();
?>

<div class="d-flex flex-row w-100 fs-4 fw-bold mb-3">
    <div class="me-2">Цена</div>
    {{--<div class="flex-grow-1"></div>--}}
    <div>{{$formatedPrice}}
        <svg style="margin: 0px 0px 5px -10px;" width="28px" height="28px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 21h2v-3h6v-2h-6v-2h4.5c2.757 0 5-2.243 5-5s-2.243-5-5-5H9a1 1 0 0 0-1 1v7H5v2h3v2H5v2h3v3zm2-15h4.5c1.654 0 3 1.346 3 3s-1.346 3-3 3H10V6z"/>
        </svg>
    </div>
</div>

<div class="basketButton btn btn-primary mb-5 fs-4 me-auto px-5" style="width: 400px;" item_id="{{$product['id']}}">В корзину</div>

<div class="d-flex flex-row w-100 fs-4 mb-3">
    <div class="fw-bold me-2">Артикул</div>
    {{--<div class="flex-grow-1"></div>--}}
    <div>{{$product['Артикул']}}</div>
</div>

<div class="card-properties d-flex flex-column align-items-start w-100 fs-4 mb-3 py-2 me-auto" style="max-width: 800px;">
    <div class="fw-bold py-1">Характеристики</div>
    @foreach($product as $key=>$value)
        @if ((mb_strpos($key, 'Свойство: ') !== false) && ($value != ""))
            <div class="d-flex flex-row w-100 fs-6">
                <div>{{str_replace('Свойство: ', '', $key)}}</div>
                <div class="flex-grow-1" style="border-bottom: 2px dotted #000000; margin: 0px 10px 6px 10px;"></div>
                <?php
                    $valuesArray = [];
                    $splitValues = explode(';', $value);

                    foreach ($splitValues as $splitValue) {
                        $pushValue = $splitValue;

                        foreach ($tags as $tag) {
                            if ($tag->property_value == $splitValue) {
                                $pushValue = "<a href='/tags/{$tag->property_url}'>{$tag->property_value}</a>";
                                break;
                            }
                        }

                        array_push($valuesArray, $pushValue);
                    }
                ?>
                <div>{!!implode(', ', $valuesArray)!!}</div>

            </div>
        @endif
    @endforeach

    <style>
        .card-properties a {
            text-decoration: none;
        }
    </style>
</div>

@if ($product['Описание'] != "")
    <div class="d-flex flex-row w-100 fs-4 m-3">
        <div class="fw-bold">Описание</div>
    </div>

    <div class="product-card-desc d-flex flex-row w-100 fs-6 mb-3 me-auto" style="max-width: 800px;">
        {!! $product['Описание'] !!}
    </div>

    <style>
        .product-card-desc,
        .product-card-desc div {
            text-align: justify;
        }
    </style>
@endif