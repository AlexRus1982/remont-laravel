{{--<!-- Каталог товаров -->--}}
<div class="tab-pane fade bg-light" id="nav-catalog" role="tabpanel" aria-labelledby="nav-catalog-tab" tabindex="0">
    <div class="d-flex flex-row h-100">
        <!-- Левая панель -->
        <div id="panel-area"class="d-flex flex-column h-100 p-2 user-select-none" style="min-width: 300px;">
            <div id="items-info">
                <div class="fs-6 fw-bold d-flex justify-content-start align-items-center">Товары
                    <!-- <div title="Добавить товар" class="ms-auto"><img class="add-button add-item" src="/images/round-plus.svg"></div> -->
                </div>
                <div class="list ps-2" style="font-size: 12px;">
                    <div class="item-wrapper-info d-flex justify-content-between"><div class="item-label statistics statistic-1">Все товары</div><div class="item-counter me-4">--/--</div></div>
                    <div class="item-wrapper-info d-flex justify-content-between"><div class="item-label statistics statistic-2">Товары без категории</div><div class="item-counter me-4">--/--</div></div>
                </div>
            </div>

            <div id="items-catalog" class="mt-4">
                <div class="item-wrapper d-flex justify-content-start align-items-center">
                    <div category-id="0" id="catalog-label" class="fs-6 fw-bold item-label selected">Каталог</div><div class="item-counter ms-auto me-4" style="font-size: 12px;">--/--</div>
                </div>
                <div parent-id="0" class="main-childs list ps-2" style="font-size: 12px;">
                    <!-- список вложенных каталогов -->
                </div>
            </div>

        </div>

        <!-- Рабочая область -->
        <div id="main-area" class="d-flex flex-column flex-grow-1 h-100 p-2">
            
            <div id="category-panel" class="d-flex flex-column w-100 p-2 bg-white shadow">
                <div class="area-title fw-bold ms-2 me-auto py-2 d-flex w-100">
                    <div id="category-title">Каталог</div>
                    <div id="category-go-link" link="" class="ms-2" style="" title="Перейти на страницу">
                        <svg class="link text-primary" width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="ReplyAllTwoToneIcon" tabindex="-1" title="ReplyAllTwoTone">
                            <path d="M7 8V5l-7 7 7 7v-3l-4-4 4-4zm6 1V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"></path>
                        </svg>
                    </div>
                    <div title="Добавить категорию" class="ms-auto me-3"><img class="add-button add-catalog" src="/images/round-plus.svg"></div>
                </div>
                <div class="area-content d-flex flex-row flex-wrap">
                    <!-- катергории -->
                </div>
            </div>

            <div id="product-panel" class="d-flex flex-column w-100 p-2 mt-3 bg-white shadow">
                <div class="area-title fw-bold ms-2 me-auto py-2 d-flex w-100">
                    <div id="product-title">Товар(ы)</div>
                    <div title="Добавить товар" class="ms-auto me-3"><img class="add-button add-item" src="/images/round-plus.svg"></div>
                </div>
                <div class="area-contnet p-2">
                    <div class="table-items">
                        <div class="table-items-header w-100 border sticky-top" style="background: #FFFFFF; top: -10px;">
                            <div class="header1 w-100 d-flex flex-row align-items-center p-2" style="height: 40px;">
                                <div class="column-drag"></div>
                                <div class="column-check"><input class="form-check-input" type="checkbox" value="" id="panel-table-items-header-check"></div>
                                <div>
                                    <div id="header-menu-check" class="dropdown" style="display:none;">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0px 5px 3px 10px;">
                                            Действие
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button id="del-all-from-catalog" class="dropdown-item" type="button">Удалить все из каталога</button></li>
                                            <li><button class="dropdown-item" type="button">Действие2</button></li>
                                            <li><button class="dropdown-item" type="button">Действие3</button></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="header-main-content column-articul">Артикул</div>
                                <div class="header-main-content column-image">Изобр.</div>
                                <div class="header-main-content column-name flex-grow-1">Название</div>
                                <div class="header-main-content column-price">Цена</div>
                                <div class="header-main-content column-quantity">Кол-во</div>
                                <div class="header-main-content column-order">Порядок</div>
                                <div class="header-main-content column-activity">Актив.</div>
                                <div class="header-main-content column-delete"></div>
                            </div>
                        </div>
                        <div class="table-items-body w-100 border border-top-0">
                        <!-- список товара -->
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex w-100" style="min-height: 15px;"></div>
        </div>
    </div>
</div>
