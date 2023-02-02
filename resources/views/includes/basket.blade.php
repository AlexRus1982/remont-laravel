<div class="basket-icon hidden">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
    </svg>
    <div class="basket-count"></div>
</div>

<!-- Модальное окно корзины -->
<div class="modal fade shadow" id="basketModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-1 shadow">
            <div class="modal-header bg-primary bg-gradient text-white">
                <h5 class="modal-title" id="basketModalLabel">Корзина</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body d-flex flex-nowrap flex-column">
                
                <!-- список товаров -->
                <div id="orders-list"></div>

                <!-- форма заказа -->
                <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="simple-tab" data-bs-toggle="tab" data-bs-target="#simple-tab-pane" type="button" role="tab" aria-controls="simple-tab-pane" aria-selected="true">Быстрый заказ</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="extend-tab" data-bs-toggle="tab" data-bs-target="#extend-tab-pane" type="button" role="tab" aria-controls="extend-tab-pane" aria-selected="false">С доп. данными</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="simple-tab-pane" role="tabpanel" aria-labelledby="simple-tab" tabindex="0">
                        <div class="input-group my-3">
                            <span class="input-group-text" id="order-phone1" style="width: 140px;">Телефон</span>
                            <input id="input-order-phone1" type="text" class="form-control" aria-label="Username" aria-describedby="order-phone1">
                        </div>
                    </div>

                    <div class="tab-pane fade" id="extend-tab-pane" role="tabpanel" aria-labelledby="extend-tab" tabindex="0">
                        <div class="input-group my-3">
                            <span class="input-group-text" id="order-phone2" style="width: 140px;">Телефон</span>
                            <input id="input-order-phone2" type="text" class="form-control" aria-label="Username" aria-describedby="order-phone2">
                        </div>
                        <div class="input-group my-3">
                            <span class="input-group-text" id="order-name" style="width: 140px;">Имя</span>
                            <input id="input-order-name" type="text" class="form-control" aria-label="Username" aria-describedby="order-name">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text" style="width: 140px;">Адрес доставки</span>
                            <textarea id="input-order-adress" class="form-control" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                    
                    <button id="order-button" type="button" class="w-100 btn btn-primary my-3">Заказать</button>

                </div>
            </div>
            <div class="modal-footer d-flex flex-row flex-nowrap">
                <div class="w-50 d-flex flex-nowrap">
                    <div>Всего товаров:</div>
                    <div class="orderCount px-1">0</div>
                    <div class="px-0">шт.</div>
                </div>
                <div class="w-50 d-flex flex-nowrap justify-content-end">
                    <div>Сумма заказа:</div>
                    <div class="orderSumm px-1">3380</div>
                    <svg style="margin: 5px 0px 0px 0px;" width="16px" height="16px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 21h2v-3h6v-2h-6v-2h4.5c2.757 0 5-2.243 5-5s-2.243-5-5-5H9a1 1 0 0 0-1 1v7H5v2h3v2H5v2h3v3zm2-15h4.5c1.654 0 3 1.346 3 3s-1.346 3-3 3H10V6z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>