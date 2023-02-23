<?php
    $cookieUuid = Cookie::get('cookie-uuid');
    $list = DB::table('visited_list')
    ->leftJoin('catalog', 'catalog.id', '=', 'visited_list.product_id')
    ->where('visited_list.cookie_uuid', $cookieUuid)
    ->inRandomOrder()
    ->take(4)
    ->get();
?>
@if (count($list))
    <div class="py-2 w-100">
        <div class="d-flex flex-row w-100 fs-4 mt-0 mb-1 fw-bold">Смотрели ранее</div>
        <div class="d-flex flex-row w-100 justify-content-start flex-wrap border-bottom pb-3">
            @foreach($list as $key=>$value)
                @include('includes.products.card', ['value' => $value])
            @endforeach
        </div>
    </div>
@endif