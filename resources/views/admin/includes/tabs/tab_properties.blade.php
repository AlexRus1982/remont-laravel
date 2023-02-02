{{--<!-- Свойства товаров -->--}}
<?php
    // проверка наличия полей свойств в базе если какого-то поля нет - добавляем
    $properties = DB::table('properties')
    ->get();

    $tableHeaders = DB::getSchemaBuilder()->getColumnListing('catalog');

    $propertiesCounter = 0;
    foreach($tableHeaders as $key => $header) {
        if (mb_strpos($header, 'Свойство: ') !== false){
            $found = $properties->where('column_name', $header);
            if (count($found) == 0){
                DB::table('properties')
                ->insert([
                    'column_name' => $header,
                ]);
            }
            $propertiesCounter++;
        }
    }

?>

<div class="tab-pane fade bg-light" id="nav-properties" role="tabpanel" aria-labelledby="nav-properties-tab" tabindex="0">
    <div id="properties-panel" class="d-flex flex-column w-100 p-2 bg-white shadow">
        <div class="area-title fw-bold ms-2 me-auto py-2 d-flex w-100">
            <div id="properties-title">Свойства</div>
            <div title="Добавить свойство" class="ms-auto me-3"><img class="add-button add-property" src="/images/round-plus.svg"></div>
        </div>
        <div class="properties-content d-flex flex-row flex-wrap">
            <div class="table-items w-100">
                <div class="table-items-header w-100 border sticky-top" style="background: #FFFFFF; top: 0px;">
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

                        <div class="header-main-content property-name flex-grow-1">Свойство: всего ({{$propertiesCounter}})</div>
                        <div class="header-main-content property-show-filter">В фильтре</div>
                        <div class="header-main-content property-show-card">В карточке</div>
                        <div class="header-main-content property-counter">Используется</div>
                        <div class="header-main-content property-buttons"></div>
                    </div>
                </div>
                <div class="table-items-body w-100 border border-top-0" style="max-height: calc(100vh - 170px); overflow-y: auto;">
                    <?php 
                        $properties = DB::table('properties')
                        ->orderBy('order_place')
                        ->get();

                        foreach($properties as $property) {
                            $used = DB::table('catalog')
                            ->where([
                                [$property->column_name, '<>', 'NULL'],
                                [$property->column_name, '<>', ''],
                            ])->get();

                            $property->counter = count($used);
                        }

                        foreach($properties as $property) {
                            $propertyName  = str_replace('Свойство: ' ,'' , $property->column_name);
                            $filterChecked = ($property->in_filtr != 0) ? 'checked' : '';
                            $cardChecked   = ($property->in_card  != 0) ? 'checked' : '';
                            ?>
                                <div item-id="{{$property->id}}" class="table-property-item w-100 d-flex flex-row justify-content-between p-2" draggable="true">
                                    <div class="property-drag"><img src="/images/drag-button.svg" class="item-drag" draggable="false"></div>
                                    <div class="property-check"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></div>
                                    <div class="property-name">{{$propertyName}}</div>
                                    <div class="property-show-filter">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" {{$filterChecked}}>
                                        </div>
                                    </div>
                                    <div class="property-show-card">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" {{$cardChecked}}>
                                        </div>
                                    </div>
                                    <div class="property-counter">{{$property->counter}}</div>
                                    <div class="property-buttons">
                                        <img src="/images/edit-button.svg" class="property-button property-edit me-2">
                                        <img src="/images/list-button.svg" class="property-button property-list me-2">
                                        <img src="/images/close-button.svg" class="property-button property-delete">
                                    </div>
                                </div>
                            <?
                        }
                    ?>
                </div>
                <style>
                    .table-property-item:nth-child(odd) {
                        background-color: #EAEAFA;
                    }

                    .table-property-item:hover {
                        background-color: #00FF002F;
                    }

                    .property-button {
                        cursor: pointer;
                        transition: 0.3s;
                    }

                    .property-button:hover {
                        cursor: pointer;
                        transform: scale(1.2);
                        filter: drop-shadow(0px 0px 4px #0000007F);
                    }

                    .property-drag {
                        cursor: move;
                        min-width: 20px;
                    }

                    .property-check {
                        min-width: 25px;
                        margin-right: 10px;
                    }

                    .property-name {
                        min-width: 200px;
                        text-align: start;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                    .property-show-filter {
                        text-align: center;
                        min-width: 120px;
                        margin-left: auto;
                    }

                    .property-show-card {
                        text-align: center;
                        min-width: 120px;
                    }

                    .property-counter {
                        text-align: center;
                        min-width: 120px;
                    }

                    .property-buttons {
                        text-align: center;
                        min-width: 120px;
                    }

                    .table-property-item .form-check {
                        display: flex;
                        justify-content: center;
                    }

                </style>
            </div>
        </div>
    </div>
</div>
