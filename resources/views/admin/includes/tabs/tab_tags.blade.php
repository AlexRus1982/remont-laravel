{{--<!-- Панель тэгов -->--}}
<?php
    $tags = DB::table('tags')
    ->orderBy('property_order')
    ->get();

    $tagsCounter = count($tags);
?>

<div class="tab-pane fade" id="nav-tags" role="tabpanel" aria-labelledby="nav-tags-tab" tabindex="0">
    <div id="tags-panel" class="d-flex flex-column w-100 p-2 bg-white shadow">
        <div class="area-title fw-bold ms-2 me-auto py-2 d-flex w-100">
            <div id="tags-title">Тэги</div>
        </div>
        <div class="tags-content d-flex flex-row flex-wrap">
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

                        <div class="header-main-content tag-name">Тэги: всего ({{$tagsCounter}})</div>
                        <div class="header-main-content tag-value flex-grow-1"></div>
                        <div class="header-main-content tag-show-filter">{{--В фильтре--}}</div>
                        <div class="header-main-content tag-show-card">{{--В карточке--}}</div>
                        <div class="header-main-content tag-counter">{{--Используется--}}</div>
                        <div class="header-main-content tag-buttons"></div>
                    </div>
                </div>
                <div class="table-items-body w-100 border border-top-0" style="max-height: calc(100vh - 170px); overflow-y: auto;">
                    <?php 
                        foreach($tags as $tag) {
                            $name = str_replace('Свойство: ', '', $tag->property_name);
                            $value = $tag->property_value;
                            // $fullName = "{$name} {$value}";
                            ?>
                                <div item-url="{{$tag->property_url}}" class="table-tag-item w-100 d-flex flex-row justify-content-between p-2" draggable="true">
                                    <div class="tag-drag"><img src="/images/drag-button.svg" class="item-drag" draggable="false"></div>
                                    <div class="tag-check"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></div>
                                    <div class="tag-name">{{$name}}</div>
                                    <div class="tag-value">{{$value}}</div>
                                    <div class="tag-show-filter">
                                        <div class="form-check form-switch">
                                            {{--<input class="form-check-input" type="checkbox" role="switch">--}}
                                        </div>
                                    </div>
                                    <div class="tag-show-card">
                                        <div class="form-check form-switch">
                                            {{--<input class="form-check-input" type="checkbox" role="switch">--}}
                                        </div>
                                    </div>
                                    <div class="tag-counter"></div>
                                    <div class="tag-buttons">
                                        <img src="/images/edit-button.svg" class="tag-button tag-edit me-2">
                                        <img src="/images/list-button.svg" class="tag-button tag-list me-2">
                                        <img src="/images/close-button.svg" class="tag-button tag-delete">
                                    </div>
                                </div>
                            <?
                        }
                    ?>
                </div>
                <style>
                    .table-tag-item:nth-child(odd) {
                        background-color: #EAEAFA;
                    }

                    .table-tag-item:hover {
                        background-color: #00FF002F;
                    }

                    .tag-button {
                        cursor: pointer;
                        transition: 0.3s;
                    }

                    .tag-button:hover {
                        cursor: pointer;
                        transform: scale(1.2);
                        filter: drop-shadow(0px 0px 4px #0000007F);
                    }

                    .tag-drag {
                        cursor: move;
                        min-width: 20px;
                    }

                    .tag-check {
                        min-width: 25px;
                        margin-right: 10px;
                    }

                    .tag-name {
                        min-width: 200px;
                        text-align: start;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                    .tag-value {
                        min-width: 200px;
                        text-align: start;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                    .tag-show-filter {
                        text-align: center;
                        min-width: 120px;
                        margin-left: auto;
                    }

                    .tag-show-card {
                        text-align: center;
                        min-width: 120px;
                    }

                    .tag-counter {
                        text-align: center;
                        min-width: 120px;
                    }

                    .tag-buttons {
                        text-align: center;
                        min-width: 120px;
                    }

                    .table-tag-item .form-check {
                        display: flex;
                        justify-content: center;
                    }

                </style>
            </div>
        </div>
    </div>
</div>