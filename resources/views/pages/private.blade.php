@extends('layouts.app')
<style>
    .card-flip .card-body {
        height: 200px;
        max-height: 200px;
        overflow: hidden;
    }

    .sector-list {
        text-decoration: none;
    }

</style>
@section('content')
<div class="mt-5">
    <div class="row px-3 mb-4">
        <div class="card shadow-sm px-0">
            <div class="card-body d-flex justify-content-center">
                <a href="{{ route('list', ['sector' => 'all']) }}"
                    class="badge sector-list bg-secondary rounded-pill me-2">All</a>
                @foreach ($sector as $s)
                <a href="{{ route('list', ['sector' => $s]) }}"
                    class="badge sector-list bg-secondary rounded-pill me-2">{{ $s }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row justify-content-center card-flip">
        @if (count($flip) > 0)
            @foreach ($flip as $f)
            <div class="col-md-3 col-2 mb-4">
                <list-component :flip="{{ $f }}"></list-component>
            </div>
            @endforeach
        @else
            <h5>No data Found</h5>
        @endif
    </div>
</div>
@endsection
