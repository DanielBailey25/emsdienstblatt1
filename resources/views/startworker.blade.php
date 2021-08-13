@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <form action={{route('formStartWorker')}} method="POST">
            @csrf
            <div class="form-group">
                <label for="item_id">Ort / Dienstwagen</label>
                <select  name="item_id" class="form-select">
                    @foreach ($items as $item)
                        <option value={{$item->id}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="state_id">Status</label>
                <select name="state_id" class="form-select">
                    @foreach ($states as $state)
                        <option value={{$state->id}}>{{$state->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="addDescription">Beschreibung</label>
                <input class="form-control" name="description" id="description" rows="1">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Eintragen</button>
            </div>
        </form>
    </div>
</div>
@endsection
