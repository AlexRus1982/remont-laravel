<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class services extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        DB::table('services')->insert([
            'url'          => 'dostavka' ,
            'page-name'    => 'Доставка' ,
            'service-text' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        ]);

        DB::table('services')->insert([
            'url'          => 'oplata',
            'page-name'    => 'Оплата',
            'service-text' => $faker->sentence($nbWords = 30, $variableNbWords = true),
        ]);

        DB::table('services')->insert([
            'url'          => 'laboratoriya',
            'page-name'    => 'Лаборатория',
            'service-text' => $faker->sentence($nbWords = 80, $variableNbWords = true),
        ]);

        DB::table('services')->insert([
            'url'          => 'o-kompanii',
            'page-name'    => 'О компании',
            'service-text' => $faker->sentence($nbWords = 16, $variableNbWords = true),
        ]);

        DB::table('services')->insert([
            'url'          => 'kontakti',
            'page-name'    => 'Контакты',
            'service-text' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        ]);
    }
}
