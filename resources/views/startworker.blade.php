@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
            </div>
        @endif

        <form action={{route('formStartWorker')}} method="POST">
            {{-- <input type="text" class="bg-light form-control mb-4 mt-2" id="searchItems" aria-describedby="searchForItems" placeholder="Suche"> --}}
            @csrf
            <div class="row mb-2" id="groupedTypeSelector">
                @foreach ($itemTypes as $type)
                @if($type->items()->count() != 0)
                    <div class='col-md-2 mb-2' id="clickThroughTypes">
                        <div class="card bg-secondary text-white active typeTilesForStartWorker" onclick="clickThroughTypes(this, {{$type->id}})">
                            <div class="card-body">
                                {{$type->name}}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>
            <div class="form-group row" id="groupedItemSelector">
                @foreach ($itemTypes as $type)
                    @if($type->items()->count() != 0)
                        <div class="d-none itemsWithType" id="itemsWithType_{{$type->id}}">
                            <div class='col-md-12' id="clickThroughItems">
                                <div class ="row mb-3">
                                    <h1 class="fs-3">{{$type->name}}</h1>
                                    @foreach ($type->items() as $item)
                                    <div class="col-md-2 mb-2">
                                        <div class="card bg-secondary text-white active itemTilesForStartWorker" onclick="setItemId(this, {{$item->id}})">
                                            <div class="card-body">
                                                {{$item->name}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <input type='hidden' value='' id='startWorkerItemId' name='item_id'/>
            <div class="form-group mt-4">
                <label for="state_id">Status</label>
                <select name="state_id" class="form-select bg-light">
                    @foreach ($states as $state)
                        <option value={{$state->id}}>{{$state->name}}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="col-12 mt-3 mb-5">
                <button type="submit" class="btn btn-primary text-white">Eintragen</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function clickThroughTypes(card, typeId) {
        if (document.querySelectorAll('.itemsWithType:not(.d-none)').length > 0){
            document.querySelectorAll('.itemsWithType:not(.d-none)')[0].classList.add('d-none');
            document.querySelectorAll('.typeTilesForStartWorker.bg-success')[0].classList.remove('bg-success');
        }
        document.getElementById('itemsWithType_' + typeId).classList.toggle('d-none');
        card.classList.add('bg-success');
    }

    function setItemId(div, id) {
        var hiddenInput = document.getElementById('startWorkerItemId');
        var itemTiles = document.getElementsByClassName('itemTilesForStartWorker bg-success');

        [].forEach.call(itemTiles, function(el) {
            el.classList.remove("bg-success");
            el.classList.add("bg-secondary");
        });

        hiddenInput.value = id;
        div.classList.remove("bg-secondary");
        div.classList.add("bg-success");
    }
</script>
@endsection
