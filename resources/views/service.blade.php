@extends('layouts.base')
@section('page.title', $service['page_name'])

@section('content')

    <div class="container d-flex justify-content-center flex-wrap flex-column" style="max-width: 1200px;">
        {!! $service['service_text'] !!}
    </div>

@endsection