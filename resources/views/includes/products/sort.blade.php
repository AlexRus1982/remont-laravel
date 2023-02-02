<div id="sortDialog" class="modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-0">
                <ul class="list-group">
                    <li class="list-group-item">
                        <input class="form-check-input me-2" type="radio" name="listGroupRadio" value="" id="popular" checked>
                        <label class="form-check-label" for="popular">Популярное</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-2" type="radio" name="listGroupRadio" value="" id="priceUp" {{--disabled--}}>
                        <label class="form-check-label" for="priceUp">Цена по возрастанию</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-2" type="radio" name="listGroupRadio" value="" id="pariceDown">
                        <label class="form-check-label" for="pariceDown">Цена по убыванию</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
        #sortDialog .list-group-item {
            display: flex;
        }

        #sortDialog label:hover,
        #sortDialog input:hover {
            cursor: pointer;
        }

        #sortDialog.modal .modal-dialog {
            padding:0px;
            margin: 500px 0px 0px 0px;
            opacity: 0.0;
            transition: 0.5s;
            transform:translate(0px, 50px)
        }

        #sortDialog.modal.show .modal-dialog {
            opacity: 1.0;
            transform:translate(0px, 0px);
        }

        #sortDialog.modal.show {
            opacity: 1.0;
            background: #FFFFFF00;
            backdrop-filter: blur(4px) grayscale(1.0);
        }

</style>