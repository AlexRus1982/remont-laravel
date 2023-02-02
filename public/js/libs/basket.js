export class Basket {

    orderSumm  = 0;
    orderCount = 0;

    order_hash = null;

    constructor() {
        $('.info-panel').append($('.basket-icon'));
        this.MakeKeys();
        
        if ($('.basket-icon').length == 0) return;
        this.UpdateBasket();
    }

    UpdateBasket() {
        try {
            window.query.Post(
                "/api/order/hash",
                { token: window.api_token, session_id : window.session_id },
                (data) => {
                    if(data.indexOf('Ошибка') < 0) {
                        this.order_hash = data;
                    }
                    this.GetCount();
                },
                false
            );
        } catch (e) {
            console.warn(e);
        }

        // setInterval(()=>{
        //     this.UpdateBasket();
        // }, 10000);
    }

    RenderList(list){

        let that = this;

        if (list.length == 0) {
            $('#basketModal').modal('hide');
            return;
        }

        let orderSumm = 0;
        let orderCount = 0;
        let itemsHTML = '';

        for(const key in list){
            const item = list[key];
            orderSumm += parseInt(item['quantity']) * parseInt(item['Цена']);
            orderCount += parseInt(item['quantity']);

            const photoList = item['Фото товара'];
            let photoURL = "https://fakeimg.pl/128x128/EEEEEE/7F7F7F/?text=NO IMAGE&font=kelson";
            if (photoList != ""){
                let photo = photoList.split(';')[0];
                let idx = photo.lastIndexOf(".");
                if (idx > -1)
                    photo = photo.substr(0, idx) + "_small" + photo.substr(idx);

                photoURL = `https://leger.market/pictures/product/small/${photo}`;
            }
            
            // console.info(item);

            const props = {
                'item-title'    : item['Наименование'],
                'item_id'       : item['product_id'],
                'item-img'      : photoURL,
                'item-desc'     : item['Описание'],
                'item-quantity' : item['quantity'],
                'item-price'    : item['Цена'],
            };
            
            itemsHTML += componentsManager.GetHtmlComponent('orderItem', props);
        }
        
        this.orderSumm = orderSumm;
        this.orderCount = orderCount;

        $('#orders-list').empty().append(itemsHTML);
        $('#basketModal .orderSumm').empty().append(orderSumm);
        $('#basketModal .orderCount').empty().append(orderCount);

        $('.bi-plus-square-fill').off('click');
        $('.bi-plus-square-fill').on('click', function(){
            const item_id = $(this).attr('item_id');

            try {
                window.query.Post(
                    "/api/basket/inc",
                    { 
                        order_hash : that.order_hash,
                        itemId : item_id,
                    },
                    (data) => {
                        console.info(data);
                        $(`#quantity-${item_id}`).empty().append(data);
                        that.GetCount();
                        that.UpdateResultOrder();
                    },
                    false
                );
            } catch (e) {
                console.warn('Ошибка увеличения товара в корзине', e);
            }
        })

        $('.bi-dash-square-fill').off('click');
        $('.bi-dash-square-fill').on('click', function(){
            const item_id = $(this).attr('item_id');
            try {
                window.query.Post(
                    "/api/basket/dec",
                    { 
                        order_hash : that.order_hash,
                        itemId : item_id,
                    },
                    (data) => {
                        $(`#quantity-${item_id}`).empty().append(data);
                        if (data == '0') {
                            try {
                                window.query.Post(
                                    "/api/basket/remove",
                                    { 
                                        order_hash : that.order_hash,
                                        itemId : item_id,
                                    },
                                    (data) => {
                                        that.UpdateList(); 
                                        that.GetCount();
                                    },
                                    false
                                );
                            } catch (e) {
                                console.warn(e);
                            }
                        }
                        that.GetCount();
                        that.UpdateResultOrder();
                    },
                    false
                );
            } catch (e) {
                console.warn('Ошибка увеличения товара в корзине', e);
            }
        })
    }

    UpdateList(){
        try {
            window.query.Post(
                "/api/basket/list",
                { token: window.api_token, order_hash : `${this.order_hash}`, },
                (data) => {
                    this.RenderList(JSON.parse(data));
                },
                false
            );
        } catch (e) {
            console.warn(e);
        }
    }

    MakeList(){
        try {
            window.query.Post(
                "/api/basket/list",
                { token: window.api_token, order_hash : `${this.order_hash}`, },
                (data) => {
                    this.RenderList(JSON.parse(data));
                    $('#basketModal').modal('show');
                },
                false
            );
        } catch (e) {
            console.warn(e);
        }
    }

    MakeKeys(){
        let that = this;
        $('.basketButton').off('click');
        $('.basketButton').on('click', function(event){
            const item_id = $(this).attr('item_id');
            // basket.AddItem(item_id);
            // this.MakeList();

            $.ajax({
                url     : "/api/basket/add",
                type    : "POST",
                data    : { 
                    order_hash : `${that.order_hash}`,
                    itemId     : item_id,
                },
                success : response => {
                    that.GetCount();
                    that.MakeList();
                },
                error   : (e)=>console.warn('error', e),
            });

            event.stopPropagation();
            event.preventDefault();
        });

        $('.basket-icon').off('click');
        $('.basket-icon').on('click', ()=>{
            this.MakeList();
        });

        $('#basketModal .modal-body').off('click');
        $('#basketModal .modal-body').on('click', (event)=>{
            const target = $(event.target);
            if (target.hasClass('card-close-button')){
                const item_id = target.attr('item_id');
                if (item_id != ""){
                    try {
                        window.query.Post(
                            "/api/basket/remove",
                            { 
                                order_hash : `${this.order_hash}`,
                                itemId : item_id,
                            },
                            (data) => {
                                this.UpdateList(); 
                                this.GetCount();
                            },
                            false
                        );
                    } catch (e) {
                        console.warn(e);
                    }
                }
            }
        });

        $('#input-order-phone1').off('keyup');
        $('#input-order-phone1').on('keyup', ()=>{
            const phoneVal = $('#input-order-phone1').val();
            $('#input-order-phone2').val(phoneVal);
        });

        $('#input-order-phone2').off('keyup');
        $('#input-order-phone2').on('keyup', ()=>{
            const phoneVal = $('#input-order-phone2').val();
            $('#input-order-phone1').val(phoneVal);
        });

        $('.modal-body button[data-bs-toggle="tab"]').off('shown.bs.tab');
        $('.modal-body button[data-bs-toggle="tab"]').on('shown.bs.tab', function(){
            $('.modal-body')[0].scrollTop = $('.modal-body')[0].scrollHeight;
        });

        $('#order-button').off('click');
        $('#order-button').on('click', ()=>{
            $('#basketModal').modal('hide');
            setTimeout(()=>{
                try {
                    window.query.Post(
                        "/api/order/close",
                        { 
                            'token'        : `${window.api_token}`, 
                            'session_id'   : `${window.session_id}`,
                            'order_hash'   : `${this.order_hash}`, 
                            'city'         : 'Москва',
                            'phone_number' : $('#input-order-phone2').val(),
                            'name'         : $('#input-order-name').val(),
                            'adress'       : $('#input-order-adress').val(),
                            'order_summ'   : this.orderSumm,
                        },
                        (data) => {
                            window.gestId = data;
                            this.GetCount();
                            alert(`Заказ принят`);
                        },
                        false
                    );
                } catch (e) {
                    console.warn(e);
                }
            }, 300);
        });
    }

    GetCount() {
        if (this.order_hash == null) return;
        try {
            window.query.Post(
                "/api/basket/getcount",
                { token: window.api_token, order_hash : `${this.order_hash}`, },
                (data) => {
                    $('.basket-count')[0].innerHTML = data;
                    if (parseInt(data) > 0) {
                        $('.basket-icon').removeClass('hidden');
                    }
                    else {
                        $('.basket-icon').addClass('hidden');
                    }
                },
                false
            );
        } catch (e) {
            //console.warn(e);
        }
    }

    UpdateResultOrder() {
        try {
            window.query.Post(
                "/api/basket/list",
                { token: window.api_token, order_hash : `${this.order_hash}`, },
                (data) => {
                    const list = JSON.parse(data);
                    let orderSumm = 0;
                    let orderCount = 0;
            
                    for(const key in list){
                        const item = list[key];
                        orderSumm += parseInt(item['quantity']) * parseInt(item['Цена']);
                        orderCount += parseInt(item['quantity']);
                    }
                    
                    $('#basketModal .orderSumm').empty().append(orderSumm);
                    $('#basketModal .orderCount').empty().append(orderCount);
                },
                false
            );
        } catch (e) {
            console.warn(e);
        }
    }

    AddItem(itemId) {
        if (this.order_hash == null) return;
        try {
            window.query.Post(
                "/api/basket/add",
                { 
                    order_hash : `${this.order_hash}`,
                    itemId : itemId,
                },
                (data) => {
                    this.GetCount();
                },
                false
            );
        } catch (e) {
            console.warn(e);
        }
    }
}