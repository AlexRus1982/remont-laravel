<div class="tags-list mb-4 w-100 d-flex flex-wrap">

    <?php
        $tags = DB::table('tags')
        ->orderBy('property_order')
        ->get();

        foreach ($tags as $tag) {
            $name = str_replace('Свойство: ', '', $tag->property_name);
            $value = $tag->property_value;
            ?>
                <a href="/tags/{{$tag->property_url}}" class="tags-list-item me-2 mb-2 px-4 py-2 rounded-5" style="white-space:nowrap;">
                    {{--$name--}}{{$value}}
                </a>
            <?
        }
    ?>

</div>

<style>
    .tags-list .tags-list-item {
        text-decoration: none;
        background: #AFAFAF;
        color: #FFFFFF;
        transition: 0.3s;
    }

    .tags-list .tags-list-item:hover {
        background: #0D6EFD;
    }

</style>