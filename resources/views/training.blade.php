@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 py-4">
        <div class="row align-items-center h-100">
            <div class="col-md12 mx-auto">
                <div class="card vh-100 bg-light py-3 px-3" style="height: auto !important">
                    <h1 class='fs-3'>{{$training->title}}</h1>
                    <div class="card-body">
                        @if (str_ends_with($training->file, '.pdf'))
                            <embed src="{{asset('uploads/' . $training->file)}}" width="100%" height="1450" type="application/pdf">
                        @else
                            <img style="height: 100%; width: 100%" src="{{asset('uploads/' . $training->file)}}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
