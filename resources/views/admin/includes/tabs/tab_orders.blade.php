{{--<!-- Панель заказов -->--}}
<div class="tab-pane fade" id="nav-orders-logs" role="tabpanel" aria-labelledby="nav-orders-logs-tab" tabindex="0">
    <div class="sticky-row"> 
        <div class="header-row">
            <div>Номер</div>
            <div>Дата</div>
            <div>Город</div>
            <div>Телефон</div>
            <div>Имя</div>
            <div>Адрес</div>
            <div>Сумма</div>
            <div class="expand-button"></div>
        </div>
    </div>

    @php
        $items = DB::table('orders')->get();
        
        $startNumber = 1138;
        $html = "";
        foreach($items as $item){
            $number = $startNumber + $item->id;
            $html .= "
                <div class='item-row' id='{$item->id}'>
                    <div class='item-row__wrapper'>
                        <div>{$number}</div>
                        <div>{$item->timestamp}</div>
                        <div>{$item->city}</div>
                        <div>{$item->phone_number}</div>
                        <div>{$item->name}</div>
                        <div>{$item->adress}</div>
                        <div>{$item->order_summ}</div>
                        <div class='expand-button'>
                            <img src='/images/caret-down.svg'>
                        </div>
                    </div>
                    <div class='item-row-expand item-row-expand-{$item->id}' id='{$item->id}'></div>
                </div>
            ";
        }
        echo $html;
    @endphp
</div>