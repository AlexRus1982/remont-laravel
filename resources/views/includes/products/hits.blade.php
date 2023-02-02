<div class="py-2 w-100">
    <div class="d-flex flex-row w-100 fs-4 mt-3 mb-1 fw-bold">Хиты продаж</div>
    @guest
        @php
            //echo "Гость";
            //Log::log('notice', 'Гость');
        @endphp
    @endguest

    {{-- 
    @auth
        @php
            echo Auth::user()->id;
            echo Auth::user()->name;
            echo Auth::user()->email;
        @endphp
    @endauth
    --}}

    @php
        // generate data by accessing properties https://github.com/fzaninotto/Faker
        /*
        $faker = Faker\Factory::create();
        echo $faker->name;
        echo $faker->address;
        echo $faker->sentence($nbWords = 600, $variableNbWords = true);
        //*/

        $hits = DB::table('catalog')->inRandomOrder()->take(4)->get();
    @endphp

    <div class="d-flex flex-row w-100 justify-content-start flex-wrap border-bottom pb-3">
        @foreach($hits as $key=>$value)
            @include('includes.products.card', ['value' => $value])
        @endforeach
    </div>
</div>