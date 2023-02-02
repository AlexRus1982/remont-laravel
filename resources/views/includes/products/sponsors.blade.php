<div class="py-2 w-100">
    <div class="d-flex flex-row w-100 fs-4 mt-3 mb-1 fw-bold">Бренды</div>
    <div class="d-flex flex-row w-100 justify-content-start flex-wrap border-bottom pb-3">
        @for($i=0; $i < 6; $i++)
            @include('includes.products.sponsor-card', ['value' => $i])
        @endfor
    </div>
</div>