<div class="list-group">
    <?php
        $categories = DB::table('categories')
        ->get();

        ?><a category_id="0" href="#" class="list-group-item list-group-item-action fw-bold">Каталог</a><?
        foreach($categories as $category){
            ?>
                <a category_id="{{ $category->id }}" href="#" class="list-group-item list-group-item-action">{{ $category->category_name }}</a>
            <?
        }
    ?>

    {{-- 
        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
            The current link item
        </a>
    --}}
</div>
