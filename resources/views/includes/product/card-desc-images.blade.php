@php 
    $photos = $product['Фото товара'];
    $photos =  ($photos != "") ? explode(';', $photos) : [];
@endphp

@if (count($photos) > 0)
    <div id="carouselExampleControls" class="carousel carousel-dark slide w-100 {{--start--}} me-auto" data-bs-touch="true" data-bs-ride="carousel" style="max-width: 600px; height: 600px;">
        <div class="carousel-inner border rounded-2 {{--shadow--}} mb-4 d-flex" style="height: 600px; align-items: center;">

            @php
                $index = 1;
                foreach($photos as $photo){
                    $image = pathinfo($photo)['filename'];
                    if ($image != ""){
                        $imageURL = "https://leger.market/pictures/product/middle/{$image}_middle.jpg";
                        //$imageURL = "https://fakeimg.pl/300x300/7F7FFF/FFFFFF/?text={$image}&font=kelson";
                        $active = ($index == 1) ? " active" : "";
                        $imageHTML = "
                            <div class='carousel-item{$active} p-2'>
                                <img src='{$imageURL}' class='d-block w-100' alt=''>
                            </div>
                        ";
                        echo $imageHTML;
                    }
                    $index++;
                }
            @endphp

        </div>
        @if (count($photos) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
@else
    <img src='https://fakeimg.pl/600x600/EEEEEE/7F7F7F/?text=NO IMAGE&font=kelson' class='class="carousel-inner border rounded-2 shadow mb-4"' alt=''>
@endif