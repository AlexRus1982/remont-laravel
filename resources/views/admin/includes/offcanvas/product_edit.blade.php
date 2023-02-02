<div 
    class="offcanvas offcanvas-end shadow"
    tabindex="-1"
    parent_id=""
    item-id=""
    id="productEdit"
    aria-labelledby="productEditLabel">
  
    <div class="offcanvas-header border-bottom bg-primary text-white">
        <h1 class="offcanvas-title fs-5 w-100 d-flex flex-row" id="productEditLabel">Товар<div class="px-2">-</div><div id="productName" class="offcanvas-header-name"></div></h1>
        <span class="product-go-link me-2">
            <svg class="link" width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="ReplyAllTwoToneIcon" tabindex="-1" title="ReplyAllTwoTone">
                <path d="M7 8V5l-7 7 7 7v-3l-4-4 4-4zm6 1V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"></path>
            </svg>
        </span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <div class="input-group mb-3">
            <span class="input-group-text">Артикул</span>
            <input type="text" class="base-data form-control" bd-column="Артикул" id="product_articul">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Название</span>
            <input type="text" class="base-data form-control" bd-column="Наименование" id="product_name">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Чпу</span>
            <span class="input-group-text">
                <svg class="translate" width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="TranslateTwoToneIcon" tabindex="-1" title="TranslateTwoTone">
                    <path d="m12.87 15.07-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7 1.62-4.33L19.12 17h-3.24z"></path>
                </svg>
            </span>
            <input type="text" class="base-data form-control" bd-column="URL адрес" id="product_url">
        </div>

        <div class="form-check form-switch form-check-reverse mb-3" style="text-align: left;">
            <input class="base-data form-check-input" type="checkbox" bd-column="Включен" id="productActivity">
            <label class="form-check-label" for="productActivity">Активен</label>
        </div>

        <div class="accordion mb-3" id="accordionImages">
            <div class="accordion-item">
                <div class="accordion-header border-bottom p-2 text-primary d-flex flex-row" id="headingOne" style="background: #86b7fe2f;">
                    <div>Описание</div>
                </div>

                <textarea type="text" id="product_description" class="base-data form-control border-0" bd-column="Описание" aria-label="With textarea"></textarea>
            </div>
        </div>

        <div class="accordion mb-3" id="accordionImages">
            <div class="accordion-item">
                <div class="accordion-header border-bottom p-2 text-primary d-flex flex-row" id="headingOne" style="background: #86b7fe2f;">
                    <div>Изображения</div>
                    <div class="w-100 d-flex">
                        <svg class="addProductImage text-primary ms-auto" width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddToPhotosTwoToneIcon" tabindex="-1" title="AddToPhotosTwoTone">
                            <path d="M20 4H8v12h12V4zm-1 7h-4v4h-2v-4H9V9h4V5h2v4h4v2z" opacity=".3"></path>
                            <path d="M4 22h14v-2H4V6H2v14c0 1.1.9 2 2 2zm4-4h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM8 4h12v12H8V4zm7 1h-2v4H9v2h4v4h2v-4h4V9h-4z"></path>
                        </svg>
                    </div>
                </div>

                <div class="gallery w-100 d-flex flex-wrap align-self-center">
                </div>

            </div>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Цена</span>
            <input type="text" class="base-data form-control" bd-column="Цена" id="product_price">
            <span class="input-group-text">
                <svg width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="CurrencyRubleTwoToneIcon" tabindex="-1">
                    <path d="M13.5 3H7v9H5v2h2v2H5v2h2v3h2v-3h4v-2H9v-2h4.5c3.04 0 5.5-2.46 5.5-5.5S16.54 3 13.5 3zm0 9H9V5h4.5C15.43 5 17 6.57 17 8.5S15.43 12 13.5 12z"></path>
                </svg>
            </span>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Старая цена</span>
            <input type="text" class="base-data form-control" bd-column="Цена старая" id="product_price_old">
            <span class="input-group-text">
                <svg width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="CurrencyRubleTwoToneIcon" tabindex="-1">
                    <path d="M13.5 3H7v9H5v2h2v2H5v2h2v3h2v-3h4v-2H9v-2h4.5c3.04 0 5.5-2.46 5.5-5.5S16.54 3 13.5 3zm0 9H9V5h4.5C15.43 5 17 6.57 17 8.5S15.43 12 13.5 12z"></path>
                </svg>
            </span>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Бренд</span>
            <input type="text" class="base-data form-control" bd-column="Бренд" id="product_price_old">
        </div>

        <div class="accordion mb-3" id="accordionCategories">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories" style="height: 38px;">
                        В категориях
                    </button>
                </h2>

                <div id="collapseCategories" class="accordion-collapse collapse p-3" aria-labelledby="headingOne" data-bs-parent="#accordionCategories">
                    <div class="w-100 mb-3 d-flex">
                        <svg class="add-product-to-category text-primary ms-auto" width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddToPhotosTwoToneIcon" tabindex="-1" title="AddToPhotosTwoTone">
                            <path d="M20 4H8v12h12V4zm-1 7h-4v4h-2v-4H9V9h4V5h2v4h4v2z" opacity=".3"></path>
                            <path d="M4 22h14v-2H4V6H2v14c0 1.1.9 2 2 2zm4-4h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM8 4h12v12H8V4zm7 1h-2v4H9v2h4v4h2v-4h4V9h-4z"></path>
                        </svg>
                    </div>

                    <div class="categories-list w-100 d-flex flex-column align-self-center">
                    </div>
                </div>

            </div>
        </div>

        <div class="accordion" id="accordionProperties">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProperties" aria-expanded="true" aria-controls="collapseProperties" style="height: 38px;">
                        Свойства
                    </button>
                </h2>
                <div id="collapseProperties" class="accordion-collapse collapse show p-3" aria-labelledby="headingOne" data-bs-parent="#accordionProperties">

                    <?php
                        $columns = array();

                        $properties = DB::table('properties')
                        ->orderBy('order_place')
                        ->get();

                        foreach($properties as $property){
                            $propertyName  = str_replace('Свойство: ', '', $property->column_name);
                            array_push($columns, $propertyName);
                        }
                    ?>

                    @foreach($columns as $column)
                        @if($loop->last)
                            <div class="input-group">
                        @else
                            <div class="input-group mb-3">
                        @endif
                                <span class="input-group-text">{{$column}}</span>
                                <input type="text" class="base-data form-control" bd-column="Свойство: {{$column}}" id="product_brend">
                            </div>
                    @endforeach

                </div>
            </div>
        </div>


    </div>

    <div class="offcanvas-footer p-3 border-top d-flex justify-content-end">
        <button id="product-save-button" type="button" class="btn btn-primary me-3">Сохранить</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Отмена</button>
    </div>

</div>

<style>
    .offcanvas-backdrop.show {
        opacity: 1.0;
        background: #FFFFFF00;
        backdrop-filter: blur(8px) grayscale(1.0);
    }

    .offcanvas-backdrop {
        opacity: 0.0;
        background: #FFFFFF00;
        backdrop-filter: blur(8px) grayscale(1.0);
    }

    #productEdit {
        min-width: 50%;
    }

    #productEdit .input-group span:first-child {
        min-width: 120px;
    }

    .addProductImage {
        transition: 0.3s;
    }

    .addProductImage:hover {
        cursor: pointer;
        transform: scale(1.3);
        filter: drop-shadow(0px 0px 2px #0000007F);
        
    }


</style>