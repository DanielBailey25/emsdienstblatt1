@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class="row">
            <div class="col-md-10">
                <img style="width: 100%" src="{{ asset('img/nordmap.png')}}" alt="nordmap" title="Nordkarte">
            </div>
        </div>
    </div>
</div>
@endsection
