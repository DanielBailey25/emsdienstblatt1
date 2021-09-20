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
                <th scope="col">E-ID</th>
                <th scope="col">Tel.</th>
                <th scope="col">Zuletzt mitgenommen:</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($interns as $intern)
                     <tr>
                        <th scope="row">{{$intern->name}}</th>
                        <td>{{$intern->player_id}}</td>
                        <td>{{$intern->phone}}</td>
                        @if($intern->getLatestCurrentWorker())
                            <td>{{$intern->getLatestCurrentWorker()->readableStartedAt() ?? ''}}</td>
                        @else
                            <td></td>
                        @endif
                        <td><form action="{{route('interns')}}" method="POST">@csrf<input type="hidden" value="{{$intern->id}}" name="intern_id"><button type="submit" class="btn btn-primary text-white">mitnehmen</button></form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
