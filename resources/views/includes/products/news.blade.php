<div class="py-2 w-100">
    <div class="d-flex flex-row w-100 fs-4 mt-3 mb-1 fw-bold">Новинки</div>

    @php
        $hits = DB::table('catalog')->inRandomOrder()->take(4)->get();
    @endphp

    <div class="d-flex flex-row w-100 justify-content-start flex-wrap border-bottom pb-3">
        @foreach($hits as $key=>$value)
            @include('includes.products.card', ['value' => $value])
        @endforeach
    </div>
</div>