{{--<!-- Панель сервисных страниц -->--}}
<div class="tab-pane fade" id="nav-services-pages" role="tabpanel" aria-labelledby="nav-services-pages-tab" tabindex="0">
    <select id="services-pages-select" class="w-100 p-1">
        <option value="-1"></option>
        @php
            $items = DB::table('services')->get();

            $html = "";
            foreach($items as $item){
                $html .= "
                    <option value='{$item->url}'>{$item->page_name}</option>
                ";
            }

            echo $html;
        @endphp
    </select>
    <div class="categories pt-3">
        <div class="textEditor"><textarea id="textEditArea-categories"></textarea></div>
        <div class="textEditor__buttons-wrapper w-100 d-flex flex-row pt-3">
            <div class="textEditorImage py-1 px-3 btn btn-primary shadow">Картинка</div>
            <div class="textEditorShow ms-auto py-1 px-3 btn btn-primary shadow">Перейти</div>
            <div class="textEditorSave py-1 px-3 btn btn-primary ms-3 shadow">Сохранить</div>
        </div>
    </div>

</div>