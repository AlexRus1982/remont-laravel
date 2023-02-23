<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="cookie-uuid" content="{{ Config::get('cookie-uuid') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <title>Test page</title>
    </head>
    <body>
        Test page<br>

        <?php
            $categories = DB::table('categories')
            ->get();

            $sub_categories = DB::table('sub_categories')
            ->get();

            $authors = DB::table('authors')
            ->get();


            $categories->dump();
            $sub_categories->dump();
            $authors->dump();

            $faker = Faker\Factory::create();

            //for($i = 0; $i < 10; $i++)
            //    DB::table('authors')
            //    ->insert(['author_FIO' => $faker->name() ]);
            //echo $faker->name();
            //echo $faker->sentence($nbWords = 600, $variableNbWords = true);

            //for($i = 0; $i < 10; $i++)
            //    DB::table('offers')
            //    ->insert([
            //        'category_id' => $categories->random()->id,
            //        'subcategory_id' => $sub_categories->random()->id,
            //        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            //        'description' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
            //        'author_id' => $authors->random()->id, 
            //    ]);

        ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    {{-- 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/test.js"></script>
    --}}
</html>
