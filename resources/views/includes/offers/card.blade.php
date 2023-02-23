<?php
    $item = (array)$value;
    $item_id = $item['id'];
    $photos = explode(';', $item['images']);
    $image = pathinfo($photos[0])['filename'];
    
    $imageURL = getImageUrl($image); // function from helpers
    
    $formatedPrice = '10000-20000';
    //try {
    //    $formatedPrice = number_format($item['Цена'], 0, '.', ' ');
    //}
    //catch (Exception $e) {
    //    // Log::debug($e);
    //}

    //$wished = (in_array($item_id, $wishList)) ? 'wishset' : '';

?>

<a class="card" target="_blank" rel="noopener noreferrer" href="/offers/{{$item['id']}}" style="text-decoration: none; color: #000000; border:none; background: none;">
    <div class="card m-2 ms-0 shadow p-0" style="min-width: 17rem; width: 17rem; height: 420px; margin-top: 10px!important; margin-bottom: 10px!important; margin-right: 10px!important; margin-left: 10px!important;">
        <div class="card-image d-flex justify-content-center flex-column" style="min-height: 270px; height: 270px;">
            <img src="{{$imageURL}}" class="card-img-top" alt="{{$item['title']}}" loading="lazy" style="height: 100%; width: 100%; object-fit: contain;">
        </div>
        <div class="card-body d-flex flex-column">
            <div class="w-100 d-flex" style="text-align: start; color: var(--accent-color); font-size: 12px;"><span class="me-auto">{{$item['category_name']}}</span><span class="ms-auto">{{$item['sub_category_name']}}</span></div>
            <h5 class="card-title" style="text-align: start; height: 50px; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;">{{$item['title']}}</h5>
            <div class="card-text d-flex flex-row align-items-center mt-auto" style="text-align: start;">{{$formatedPrice}} ₽
                <div class="btn-group ms-auto" role="group">
                    <button type="button" class="wishButton btn btn-white text-secondary" style="max-width: 50px; border-color: white; padding: 5px 0px;" item_id="{{ $item_id }}" title="В желания">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16" style="color: #FF0000;">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</a>