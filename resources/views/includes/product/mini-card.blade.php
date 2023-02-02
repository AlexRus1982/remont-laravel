<?php
    $item = (array)$value;
    $item_id = $item['id'];
    $photos = $item['Фото товара'];
    $photos = explode(';', $photos);
    $image = pathinfo($photos[0])['filename'];
    
    $imageURL = getImageUrl($image); // function from helpers
    
    $formatedPrice = $item['Цена'];
    try {
        $formatedPrice = number_format($item['Цена'], 0, '.', ' ');
    }
    catch (Exception $e) {
        // Log::debug($e);
    }

    $wished = (in_array($item_id, $wishList)) ? 'wishset' : '';
?>

<a class="card" target="_blank" rel="noopener noreferrer" href="/product/{{$item['URL адрес']}}" style="text-decoration: none; color: #000000; border:none; background: none; margin-right: 35px!important;">
    <div class="card m-2 ms-0 shadow p-0" style="min-width: 152px; width: 152px; height: 275px;">
        <div class="card-image d-flex justify-content-center flex-column" style="min-height: 150px; height: 150px;">
            <img src="{{$imageURL}}" class="card-img-top" alt="{{$item['Наименование']}}" loading="lazy" style="height: 100%; width: 100%; object-fit: contain;">
        </div>
        <div class="card-body d-flex flex-column p-2">
            <h5 class="card-title fs-6" style="height: 40px; line-height: 20px; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;">{{$item['Наименование']}}</h5>
            <p class="card-text mt-auto mb-0">{{$formatedPrice}}<svg style="margin: 0px 0px 3px 0px;" width="16px" height="16px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 21h2v-3h6v-2h-6v-2h4.5c2.757 0 5-2.243 5-5s-2.243-5-5-5H9a1 1 0 0 0-1 1v7H5v2h3v2H5v2h3v3zm2-15h4.5c1.654 0 3 1.346 3 3s-1.346 3-3 3H10V6z"/>
                </svg>
            </p>
            {{--
            <!-- <div class="basketButton btn btn-primary mt-auto" item_id="{{ $item_id }}">В корзину</div> -->
            --}}
            <div class="btn-group" role="group">
                <button type="button" class="basketButton btn btn-primary" item_id="{{ $item_id }}" style="font-size: 14px; border-color: white; white-space: nowrap;">В корзину</button>
                <button type="button" class="wishButton btn btn-primary {{$wished}}" style="max-width: 50px; border-color: white;" item_id="{{ $item_id }}" title="В желания">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16" style="color: #FF0000;">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</a>