@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="py-4 col d-flex flex-column h-sm-100">

        <div class="row row-cols-auto py-4">
            @if($currentWorker->count() == 0)
                <div class="col-md">
                    <div class="alert alert-primary" role="alert">
                        Es ist zurzeit keine Einheit im Dienst.
                    </div>
                </div>
            @else
                @foreach($currentWorker as $worker)
                    <div class="col-12 col-lg-6 col-md-12 col-xl-6 col-xxl-4 mb-4">
                        <div class="card bg-light">
                            <div class="card-header @if($worker->item->type->id == 1) bg-primary @elseif($worker->item->id ==4) bg-danger @else bg-orange @endif text-white">{{ $worker->item->name }}<form action={{route('formStartWorker')}} method="POST" id="currentWorkTileButton_{{$worker->id}}">@csrf<input type='hidden' value=1 name='state_id'><input type='hidden' value={{$worker->item_id}} name='item_id'><span onclick="getElementById('currentWorkTileButton_{{$worker->id}}').submit();" class="lh-sm badge rounded-pill bg-dark makeClickable assignToCurrentWorkerButton" style="font-size: 12px">Eintragen</span></form></div>
                            <div class="card-body-md">
                                <div class='table-responsive'>
                                    <table class="table text-white table-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">R</th>
                                                <th scope="col">E-ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Beginn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($worker->state->id == 5)
                                              <tr class="table-danger">
                                            @else
                                              <tr>
                                            @endif
                                                <th>{{ $worker->user->rank }}</th>
                                                <td>{{ $worker->user->player_id }}</td>
                                                <td>{{ $worker->user->name }}</td>
                                                <td>{{ $worker->state->name }}</td>
                                                <td>{{ $worker->readableStartedAtDiff() }}</td>
                                            </tr>
                                            @foreach ($worker->related() as $subWorker)
                                            @if ($subWorker->state->id == 5)
                                                <tr class="table-danger">
                                            @else
                                                <tr>
                                            @endif
                                                <th>{{ $subWorker->user->rank }}</th>
                                                <td>{{ $subWorker->user->player_id }}</td>
                                                <td>{{ $subWorker->user->name }}</td>
                                                <td>{{ $subWorker->state->name }}</td>
                                                <td>{{ $subWorker->readableStartedAtDiff() }}</td>
                                            </tr>
                                            @endforeach
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
