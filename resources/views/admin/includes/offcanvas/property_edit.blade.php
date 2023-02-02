<div 
    class="offcanvas offcanvas-end shadow"
    tabindex="-1"
    parent_id=""
    item-id=""
    id="propertyEdit"
    aria-labelledby="propertyEditLabel">
  
    <div class="offcanvas-header border-bottom bg-primary text-white">
        <h1 class="offcanvas-title fs-5 w-100 d-flex flex-row" id="propertyEditLabel">Свойство<div class="px-2">-</div><div id="propertyName" class="offcanvas-header-name"></div></h1>
        <span class="property-go-link me-2">
            <svg class="link" width="24" height="24" fill="currentColor" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="ReplyAllTwoToneIcon" tabindex="-1" title="ReplyAllTwoTone">
                <path d="M7 8V5l-7 7 7 7v-3l-4-4 4-4zm6 1V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"></path>
            </svg>
        </span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <div class="input-group mb-3">
            <span class="input-group-text">Свойство</span>
            <input type="text" class="base-data form-control" id="propertyNameInput">
        </div>

    </div>

    <div class="offcanvas-footer p-3 border-top d-flex justify-content-end">
        <button id="property-save-button" type="button" class="btn btn-primary me-3">Сохранить</button>
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

    #propertyEdit {
        min-width: 50%;
    }

    #propertyEdit .input-group span:first-child {
        min-width: 120px;
    }

</style>