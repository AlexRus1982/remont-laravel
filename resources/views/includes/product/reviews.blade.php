<div class="py-2 w-100 d-flex flex-column justify-content-start">
    <div class="d-flex flex-row w-100 fs-4 mt-3 fw-bold">Отзывы</div>
    <button type="button" class="btn btn-primary btn-sm mt-3 fw-bold" style="width: fit-content;">Написать отзыв</button>
    {{--
    @php
        // generate data by accessing properties https://github.com/fzaninotto/Faker

        $faker = Faker\Factory::create();

        $qcount = $faker->numberBetween($min = 1, $max = 9);
        for ($i = 0; $i < $qcount; $i++) {
            echo "
                <div class='fw-bold mt-3' style='width: fit-content;'>{$faker->name}:</div>
                <div style='width: fit-content;'>{$faker->sentence($nbWords = 10, $variableNbWords = true)}</div>
            ";
        }
    @endphp
    --}}
</div>