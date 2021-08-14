<div class="row" id="infobar">
  <div class="col-md py-1">
    <div class="card bg-secondary text-white">
      <div class="card-body">
        Einheiten {{$currentWorkerCount}} / {{$maxWorkerCount}}
      </div>
    </div>
  </div>
  <div class="col-md py-1">
    <div class="card bg-primary text-white">
      <div class="card-body">
        Einsatzleitung:<br>nicht besetzt
      </div>
    </div>
  </div>
  <div class="col-md py-1">
    <div class="card bg-danger text-white">
      <div class="card-body">
        Leitstelle:<br>nicht besetzt
      </div>
    </div>
  </div>
  @foreach ($medicalDepartments as $medicalDepartment)
    <div class="col-md py-1" onclick="document.getElementById('itemSwitchClosedState_{{$medicalDepartment->id}}').submit();">
      <form id="itemSwitchClosedState_{{$medicalDepartment->id}}" action="{{route('switchItemClosedState')}}" method="POST">
        @csrf
        <input type="hidden" name="item_id" value={{$medicalDepartment->id}}>
        <input type="hidden" name="is_closed" value={{$medicalDepartment->is_closed}}>

        @if($medicalDepartment->is_closed == 0)
          <div class="card bg-success text-white">
            <div class="card-body">
              {{$medicalDepartment->name}}: geöffnet
            </div>
          </div>
        @else
          <div class="card bg-danger text-white">
            <div class="card-body">
              {{$medicalDepartment->name}}: geschlossen
            </div>
          </div>
        @endif
      </form>
    </div>
  @endforeach
</div>
