@if (count($products) > 0)
    {{-- 
        <!-- <div class="d-flex flex-row w-100 fs-4 mt-0 mb-1 fw-bold">Каталог</div>  -->
    --}}
    <div class="d-flex flex-row w-100 justify-content-between">
        <div class="filter-list-wrapper d-flex flex-row"> 
            <div class="filter-list-icon-button me-2 text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders2-vertical" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 10.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H3V1.5a.5.5 0 0 0-1 0V10H.5a.5.5 0 0 0-.5.5ZM2.5 12a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5Zm3-6.5A.5.5 0 0 0 6 6h1.5v8.5a.5.5 0 0 0 1 0V6H10a.5.5 0 0 0 0-1H6a.5.5 0 0 0-.5.5ZM8 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2A.5.5 0 0 0 8 1Zm3 9.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H14V1.5a.5.5 0 0 0-1 0V10h-1.5a.5.5 0 0 0-.5.5Zm2.5 1.5a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5Z"/>
                </svg>
            </div>
            <div class="filter-list-icon-label fw-bold d-flex align-items-center">
                Фильтры
            </div>
        </div>

        <div class="sort-list-wrapper d-flex flex-row"> 
            <div class="sort-list-icon-button me-2 text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </div>
            <div class="sort-list-icon-label fw-bold d-flex align-items-center me-4">
                Популярное
            </div>
        </div>

        <style scoped>
            .filter-list-icon-label,
            .sort-list-icon-label {
                font-size: 12px;
            }

            .filter-list-icon-button:hover,
            .sort-list-icon-button:hover {
                cursor: pointer;
            }
        </style>
    </div> 

    <div class="d-flex flex-row w-100 justify-content-start flex-wrap pb-3">
        @foreach($products as $key=>$value)
            @include('includes.products.card', ['value' => $value])
        @endforeach
    </div>

    <div class="py-4">
        {{ $products->appends(['products' => request()->products])->links() }}
    </div>

@endif