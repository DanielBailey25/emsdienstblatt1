@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="py-4 col d-flex flex-column h-sm-100">
        <div class="row row-cols-auto">
            @if($currentWorker->count() == 0)
                <div class="px-5 py-3 col-md">
                    <div class="alert alert-primary" role="alert">
                        Es ist zurzeit keine Einheit im Dienst.
                    </div>
                </div>
            @else
                @foreach($currentWorker as $worker)
                    <div class="col-md">
                        <div class="card">
                            <div class="card-header">{{ $worker->item->name }}</div>
                            <div class="card-body-md">
                                <div class='table-responsive'>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">R</th>
                                                <th scope="col">DN</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Beginn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>01</th>
                                                <td>38</td>
                                                <td>{{ $worker->name }}</td>
                                                <td></td>
                                                <td>{{ $worker->state->name }}</td>
                                                <td>{{ $worker->readableStartedAt() }}</td>
                                            </tr>
                                            {{-- @foreach ($worker->related as $subWorkers)
                                            <tr>
                                                <th>01</th>
                                                <td>38</td>
                                                <td>Michael_Geissler</td>
                                                <td></td>
                                                <td>Außendienst</td>
                                                <td>21:23</td>
                                            </tr>
                                            @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
