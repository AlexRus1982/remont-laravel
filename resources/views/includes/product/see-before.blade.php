<?php
    // generate data by accessing properties https://github.com/fzaninotto/Faker
    /*
    $faker = Faker\Factory::create();
    echo $faker->name;
    echo $faker->address;
    echo $faker->sentence($nbWords = 600, $variableNbWords = true);
    //*/

    $cookieUuid = Cookie::get('cookie-uuid');
    $list = DB::table('visited_list')
    ->leftJoin('catalog', 'catalog.id', '=', 'visited_list.product_id')
    ->where('visited_list.cookie_uuid', $cookieUuid)
    ->inRandomOrder()
    ->take(6)
    ->get();
?>
@if (count($list))
    <div class="py-2 w-100">
        <div class="d-flex flex-row w-100 fs-4 mt-3 fw-bold">Смотрели ранее</div>

        <div class="d-flex flex-row w-100 justify-content-start flex-wrap border-bottom pb-3">
            @foreach($list as $key=>$value)
                @include('includes.product.mini-card', ['value' => $value])
            @endforeach
        </div>
    </div>
@endif