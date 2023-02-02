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

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <?php
                $columnNames = DB::getSchemaBuilder()
                ->getColumnListing('catalog');

                $counter = 0;
                foreach ($columnNames as $columnName) {
                    if (mb_strpos($columnName, 'Свойство: ') !== false) {
                    
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-heading{{$counter}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$counter}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$counter}}">
                                        {{$columnName}}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse{{$counter}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$counter}}">
                                    <div class="accordion-body">
                            <!-- <u><b>{{$columnName}}</b></u><br> -->
                        <?

                        $propertyArray = [];
                        $properties = DB::table('catalog')
                        ->select("{$columnName}")
                        ->where([
                            [$columnName, '<>', 'NULL'],
                            [$columnName, '<>', ''],
                        ])
                        ->get();
                
                        foreach ($properties as $property) {
                            $splitArray = explode(';', $property->{$columnName});
                
                            foreach ($splitArray as $splitProperty) {
                                array_push($propertyArray, $splitProperty);
                            }
                        }
                
                        $propertyCollection = collect($propertyArray);
                
                        $uniqCollection = $propertyCollection->countBy();

                        $valuesCounter = count($uniqCollection);

                        foreach ($uniqCollection as $key=>$value) {
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{$key}}
                                    </label>
                                </div>
                            <?
                        }

                        ?></div></div></div><?

                        $counter++;
                    }
                }

            ?>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    {{-- 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/test.js"></script>
    --}}
</html>
