@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 py-4">
        <div class="row align-items-center h-100">
            <div class="col-md12 mx-auto">
                <div class="card vh-100 bg-light py-3 px-3">
                    <h1 class='fs-3'>{{$training->title}}</h1>
                    <div class="card-body">
                        <iframe style="height: 100%; width: 100%" src="{{$training->url}}" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
