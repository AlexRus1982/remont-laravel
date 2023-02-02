<div class="py-2 w-100 d-flex flex-column justify-content-start">
    <div class="d-flex flex-row w-100 fs-4 mt-3 fw-bold">Вопросы и ответы</div>
    <button type="button" class="btn btn-primary btn-sm mt-3 fw-bold" style="width: fit-content;">Задать вопрос</button>
    {{--
    @php
        // generate data by accessing properties https://github.com/fzaninotto/Faker

        $faker = Faker\Factory::create();

        $qcount = $faker->numberBetween($min = 1, $max = 9);
        for ($i = 0; $i < $qcount; $i++) {
            echo "
                <div class='fw-bold mt-3' style='width: fit-content;'>Вопрос:</div>
                <div style='width: fit-content;'>{$faker->sentence($nbWords = 10, $variableNbWords = true)}</div>
                <div class='fw-bold mt-1' style='width: fit-content;'>Ответ:</div>
                <div style='width: fit-content;'>{$faker->sentence($nbWords = 10, $variableNbWords = true)}</div>
                <div class='d-flex flex-row'>
                    <div class='mx-1 text-primary'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-up-fill' viewBox='0 0 16 16'>
                            <path d='m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z'/>
                        </svg>
                    </div>
                    <div class='mx-1'>{$faker->numberBetween($min = 1, $max = 9)}</div>
                    <div class='mx-1 text-primary'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'>
                            <path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/>
                        </svg>
                    </div>
                    <div class='mx-1'>{$faker->numberBetween($min = 1, $max = 9)}</div>
                </div>
            ";
        }
    @endphp
    --}}

    <?php
        $faker = Faker\Factory::create();
        ?>
        <div class='fw-bold mt-3' style='width: fit-content;'>Вопрос:</div>
        <div style='width: fit-content;'>Можно сделать покупку как юрлицо?</div>
        <div class='fw-bold mt-1' style='width: fit-content;'>Ответ:</div>
        <div style='width: fit-content;'>Да, конечно. Укажите реквизиты при оформлении или сообщите менеджеру.</div>
        <div class='d-flex flex-row'>
            <div class='mx-1 text-primary'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-up-fill' viewBox='0 0 16 16'>
                    <path d='m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z'/>
                </svg>
            </div>
            <div class='mx-1'>{{$faker->numberBetween($min = 1, $max = 9)}}</div>
            <div class='mx-1 text-primary'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'>
                    <path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/>
                </svg>
            </div>
            <div class='mx-1'>{{$faker->numberBetween($min = 1, $max = 9)}}</div>
        </div>

        <div class='fw-bold mt-3' style='width: fit-content;'>Вопрос:</div>
        <div style='width: fit-content;'>Нужна ли предоплата заказа?</div>
        <div class='fw-bold mt-1' style='width: fit-content;'>Ответ:</div>
        <div style='width: fit-content;'>Да. Из-за повышенного спроса на товары и нестабильного курса валют с 24.02.22 все товары отгружаются только по предоплате.</div>
        <div class='d-flex flex-row'>
            <div class='mx-1 text-primary'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-up-fill' viewBox='0 0 16 16'>
                    <path d='m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z'/>
                </svg>
            </div>
            <div class='mx-1'>{{$faker->numberBetween($min = 1, $max = 9)}}</div>
            <div class='mx-1 text-primary'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'>
                    <path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/>
                </svg>
            </div>
            <div class='mx-1'>{{$faker->numberBetween($min = 1, $max = 9)}}</div>
        </div>
        <?
    ?>
</div>