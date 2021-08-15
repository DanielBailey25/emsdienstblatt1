@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 py-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
            </div>
        @endif

        <form action={{route('formStartWorker')}} method="POST">
            <input type="text" class="bg-light form-control mb-4 mt-2" id="searchItems" aria-describedby="searchForItems" placeholder="Suche">
            @csrf
            <div class="form-group row" id="groupedItemSelector">
                @foreach ($itemTypes as $type)
                    @if($type->items()->count() != 0)
                        <div class='col-md-6'>
                            <h1 class="fs-3">{{$type->name}}</h1>
                            <div class ="row mb-3">
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

            <div class="form-group mt-2">
                <label for="addDescription">Beschreibung</label>
                <input class="form-control bg-light" name="description" id="description" rows="1">
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary text-white">Eintragen</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
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

    const searchField = document.getElementById('searchItems');
    document.addEventListener('keyup', logKey);

    function logKey(e) {
        value = searchField.value.toLowerCase();
        card = document.getElementById("groupedItemSelector");
        cardBody = card.getElementsByClassName("card-body");
        for (i = 0; i < cardBody.length; i++) {
            if (cardBody[i].innerHTML.toLowerCase().indexOf(value) > -1) {
                cardBody[i].parentElement.parentElement.style.display = "";
            } else {
                cardBody[i].parentElement.parentElement.style.display = "none";
            }
        }
    }
</script>
@endsection
