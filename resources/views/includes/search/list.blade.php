<div class="d-flex flex-row w-100 fs-4 mt-3 mb-1 fw-bold">Нашлось</div>

<div class="d-flex flex-row w-100 justify-content-between flex-wrap border-bottom pb-3">
    @foreach($products as $key=>$value)
        @include('includes.products.card', ['value' => $value])
    @endforeach
</div>