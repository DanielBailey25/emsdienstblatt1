@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <h1 class="display-5">Mitarbeiterliste</h1>
        <table class="table table-striped table-hover text-white">
            <thead>
                <tr>
                <th scope="col">Mitarbeiter</th>
                <th scope="col">Rank</th>
                <th scope="col">Dienstnummer</th>
                <th scope="col">Tel.</th>
                <th scope="col">EST</th>
                <th scope="col">IDP</th>
                <th scope="col">Appro</th>
                <th scope="col">RTW</th>
                <th scope="col">RTH</th>
                <th scope="col">Granger</th>
                <th scope="col">Funk</th>
                <th scope="col">Außendienst</th>
                <th scope="col">Schmerztherapie</th>
                <th scope="col">ID-Schulung</th>
                <th scope="col">Großeinsatzschulung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                     <tr>
                        <th scope="row">{{$worker->name}}</th>
                        <td>{{$worker->rank}}</td>
                        <td>{{$worker->service_number}}</td>
                        <td>{{$worker->phone}}</td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                        <td><i class="fs-5 bi-x" style='color: red'></i></td>
                        <td><i class="fs-5 bi-x" style='color: red'></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
