@extends('layouts.app')
@section('content')
<div class="container">
    <flip-component :flip="{{ $flip }}" route="{{ route('details', ['id'=>$flip->slug]) }}"></flip-component>
    {{-- <div class="social-btn-ap">
        {!! $share !!}
    </div> --}}
</div>
@endsection
