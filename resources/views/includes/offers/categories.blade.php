@if ($id >= 0)
    <?php
        // $id = 0;
        $categories = DB::table('categories')
        ->join('hierarchy_category', 'categories.id', '=', 'hierarchy_category.category_id')
        ->where('parent_id', $id)
        ->orderBy('order_place')
        ->get();
    ?>

    @if (count($categories) > 0)
        {{--
        <!-- <div class="d-flex flex-row w-100 fs-4 mt-4 mb-1 fw-bold">Категории</div> -->
        --}}

        <div class="d-flex flex-row w-100 justify-content-start flex-wrap pb-3 mb-4">
            <?php
                foreach ($categories as $category) {
                    $image = getImageUrl($category->category_image);
                    ?>
                        <a class="category-card" rel="noopener noreferrer" href="/products/{{$category->url}}" style="text-decoration: none; color: #000000; border:none; background: none;">
                            <div class="card m-2 ms-0 shadow p-0" style="min-width: 17rem; width: 17rem; margin-right: 22px!important;">
                                <div class="card-image d-flex justify-content-center flex-column" style="min-height: 270px; height: 270px;">
                                    <img src="{{$image}}" class="card-img-top" alt="{{$category->category_name}}" loading="lazy" style="height: 100%; width: 100%; object-fit: contain;">
                                </div>
                                <div class="card-body d-flex flex-column p-2">
                                    <h5 class="card-title d-flex m-0 my-2 w-100 align-items-center justify-content-center" style="line-height: 20px; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;">{{$category->category_name}}</h5>
                                </div>
                            </div>
                        </a>
                    <?
                }
            ?>
        </div>
    @endif

@endif