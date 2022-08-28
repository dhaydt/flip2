@extends('layouts.app')
<style>
    .card-body{
        height: 200px;
        max-height: 200px;
        overflow: hidden;
    }

</style>
@section('content')
{{-- {{ dd($flip) }} --}}
<div class="mt-5">
    <div class="row justify-content-center">
        @foreach ($flip as $f)
        <div class="col-md-3 col-2 mb-4">
            <list-component :flip="{{ $f }}"></list-component>
        </div>
        @endforeach
    </div>
</div>
@endsection
