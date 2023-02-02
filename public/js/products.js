class ProductsScript {

    constructor(){
        console.log(this.constructor.name);
        this.MakeKeys();
    }

    MakeKeys(){
        $('tbody').off('click');
        $('tbody').click(event => {
            const tableLine = $(event.target).parent();
            const url = tableLine.attr('link');
            window.open(url, '_blank').focus();
        });

        $('.filter-list-icon-button').off('click');
        $('.filter-list-icon-button').on('click', ()=>{
            $('#filterEdit').offcanvas('show');
        });

        $('#filter-show-button').off('click');
        $('#filter-show-button').on('click', ()=>{
            $('#filterEdit').offcanvas('hide');
        });

        $('.sort-list-icon-button').off('click');
        $('.sort-list-icon-button').on('click', ()=>{
            let x = $('.sort-list-icon-label').offset().left - 225 - $(document).scrollLeft();
            let y = $('.sort-list-icon-label').offset().top + 30 - $(document).scrollTop();
            $('#sortDialog.modal .modal-dialog').css('margin-left', x);
            $('#sortDialog.modal .modal-dialog').css('margin-top', y);

            $('#sortDialog').modal('show');
        });
    }

}

new ProductsScript();