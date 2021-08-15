@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <h1 class="display-8">Praktikanten</h1>
        <table class="table table-striped table-hover text-white">
            <thead>
                <tr>
                <th scope="col">Praktikant</th>
                <th scope="col">Dienstnummer</th>
                <th scope="col">Tel.</th>
                <th scope="col">Zuletzt mitgenommen:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($interns as $intern)
                     <tr>
                        <th scope="row">{{$intern->name}}</th>
                        <td>{{$intern->service_number}}</td>
                        <td>{{$intern->phone}}</td>
                        <td>{{$intern->getLatestCurrentWorker()->readableStartedAt() ?? ''}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
