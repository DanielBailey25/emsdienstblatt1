@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 table-responsive py-4">
        <h1 class="display-8">Mitarbeiterliste</h1>
        <table class="table table-striped table-hover text-white">
            <thead>
                <tr>
                    <th scope="col">Mitarbeiter</th>
                    <th scope="col">Rank</th>
                    <th scope="col">Dienstnummer</th>
                    <th scope="col">Tel.</th>
                    @foreach ($courses as $course)
                        <th scope="col">{{$course->name}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                     <tr>
                        <th scope="row">{{$worker->name}}</th>
                        <td>{{$worker->rank}}</td>
                        <td>{{$worker->service_number}}</td>
                        <td>{{$worker->phone}}</td>
                        @foreach ($courses as $course)
                            @if ($worker->hasCourseById($course->id))
                                <td><i class="fs-5 bi-check2-circle" style='color: green'></i></td>
                            @else
                                <td><i class="fs-5 bi-x-circle" style='color: red'></i></td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
