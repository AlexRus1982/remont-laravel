<?php 
    $propertyName = isset($propertyName) ? $propertyName : "";

    $columnNames = DB::getSchemaBuilder()
    ->getColumnListing('catalog');

    $tags = DB::table('tags')
    ->get();

    $propertyIs = in_array($propertyName, $columnNames) ? true : false;

    $valuesCounter = 0;
    if ($propertyIs) {
        $used = DB::table('catalog')
        ->where([
            [$propertyName, '<>', 'NULL'],
            [$propertyName, '<>', ''],
        ])
        ->get()
        ->unique($propertyName);
    }

    if ($propertyIs) {
        $propertyArray = [];
        $properties = DB::table('catalog')
        ->select("{$propertyName}")
        ->where([
            [$propertyName, '<>', 'NULL'],
            [$propertyName, '<>', ''],
        ])
        ->get();

        foreach ($properties as $property) {
            $splitArray = explode(';', $property->{$propertyName});

            foreach ($splitArray as $splitProperty) {
                array_push($propertyArray, $splitProperty);
            }
        }

        $propertyCollection = collect($propertyArray);

        $uniqCollection = $propertyCollection->countBy();
        $valuesCounter = count($uniqCollection);
    }


?>

<div 
    class="offcanvas offcanvas-end shadow"
    tabindex="-1"
    parent_id=""
    item-id=""
    id="propertyValues"
    aria-labelledby="propertyValuesLabel">
  
    <div class="offcanvas-header border-bottom bg-primary text-white">
        <h1 class="offcanvas-title fs-5 w-100 d-flex flex-row" id="propertyValuesLabel">{{$propertyName}}</h1>
        <span class="property-go-link me-2">
            <svg class="link" width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="ReplyAllTwoToneIcon" tabindex="-1" title="ReplyAllTwoTone">
                <path d="M7 8V5l-7 7 7 7v-3l-4-4 4-4zm6 1V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"></path>
            </svg>
        </span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <div class="table-items w-100">
            <div class="table-items-header w-100 border sticky-top" style="background: #FFFFFF; top: 0px;">
                <div class="header1 w-100 d-flex flex-row align-items-center p-2" style="height: 40px;">
                    <div class="property-value-check"><input class="form-check-input" type="checkbox" value="" id="panel-table-items-header-check"></div>
                    
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

                    <div class="header-main-content property-value-name">Значение: всего ({{$valuesCounter}})</div>
                    <div class="header-main-content property-value-show-tag"><div class="tag-header">Тэг</div></div>
                    <div class="header-main-content property-value-counter">Используется</div>
                    <div class="header-main-content property-value-buttons"> </div>
                </div>
            </div>
            <div class="table-items-body w-100 border border-top-0" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                <?php 
                    if ($propertyIs){
                        foreach($uniqCollection as $key => $item) {
                            $valueName = $key;
                            $valueCounter = $item;
                            $tagChecked = ($tags->contains(function ($value, $key) use ($valueName) {
                                return $value->property_value == $valueName;
                            })) ? "checked" : "";
                            
                            ?>
                                <div class="table-property-value-item w-100 d-flex flex-row justify-content-between p-2" draggable="true">
                                    <div class="property-value-check"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></div>
                                    <div class="property-value-name"><input type="text" value="{{$valueName}}" disabled/></div>
                                    <div class="property-value-show-tag">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" {{$tagChecked}}>
                                        </div>
                                    </div>
                                    <div class="property-value-counter">{{$valueCounter}}</div>
                                    <div class="property-value-buttons">
                                        <img src="/images/edit-button.svg" class="property-value-button property-value-edit me-2">
                                        <img src="/images/close-button.svg" class="property-value-button property-value-delete">
                                    </div>
                                </div>
                            <?
                        }
                    }
                ?>
            </div>
            <style>
                .table-property-value-item:nth-child(odd) {
                    background-color: #EAEAFA;
                }

                .table-property-value-item:hover {
                    background-color: #00FF002F;
                }

                .property-value-button {
                    cursor: pointer;
                    transition: 0.3s;
                }

                .property-value-button:hover {
                    cursor: pointer;
                    transform: scale(1.2);
                    filter: drop-shadow(0px 0px 4px #0000007F);
                }

                .property-value-check {
                    min-width: 25px;
                    margin-right: 10px;
                }

                .property-value-name {
                    min-width: 200px;
                    /* text-align: start;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis; */
                    display: flex;
                    flex: auto;
                    flex-direction: column;
                }

                .property-value-name input {
                    background: none;
                    border: 1px solid #0000004F;
                    /* width: 100%; */
                }

                .property-value-name input:disabled {
                    background: none;
                    border: 1px solid #00000000;
                    /* width: 100%; */
                }

                .property-value-show-tag {
                    min-width: 60px;
                    max-width: 60px;
                    margin-left: auto;
                }

                .property-value-show-tag .form-check {
                    margin: 0px;
                    padding: 0px;
                }

                .property-value-show-tag .form-switch .form-check-input {
                    margin-left: 0px;
                    margin-right: -6px;
                }
                
                .tag-header {
                    margin-left: auto;
                    text-align: end;
                    max-width: 60px;
                }

                .property-value-counter {
                    text-align: center;
                    min-width: 120px;
                }

                .property-value-buttons {
                    text-align: center;
                    min-width: 120px;
                }

                .table-property-value-item .form-check {
                    display: flex;
                    justify-content: flex-end;
                }

            </style>
        </div>

    </div>

    <div class="offcanvas-footer p-3 border-top d-flex justify-content-end">
        <button id="property-values-save-button" type="button" class="btn btn-primary me-3">Сохранить</button>
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

    #propertyValues {
        min-width: 50%;
    }

    #propertyValues .input-group span:first-child {
        min-width: 120px;
    }

</style>