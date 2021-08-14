<div class="row" id="infobar">
  <div class="col-md py-1">
    <div class="card bg-secondary text-white">
      <div class="card-body">
        Einheiten {{$currentWorkerCount}} / {{$maxWorkerCount}}
      </div>
    </div>
  </div>
  @foreach ($controlCenters as $center)
    <div class="col-md py-1" onclick="document.getElementById('centerChangeAssignment_{{$center->id}}').submit();">
      <form id="centerChangeAssignment_{{$center->id}}" action="{{route('centerChangeAssignment')}}" method="POST">
        @csrf
        <input type="hidden" name="center_id" value={{$center->id}}>
        @if ($center->id == 1)
            @if($center->user_id == null)
              <div class="card bg-primary text-white">
                <div class="card-body">
                  Einsatzleitung:<br>nicht besetzt
                </div>
              </div>
            @else
              <div class="card bg-warning text-black">
                <div class="card-body">
                  Einsatzleitung:<br>{{Auth::user()->name}}
                </div>
              </div>
            @endif
        @elseif ($center->id == 2)
            @if($center->user_id == null)
              <div class="card bg-danger text-white">
                <div class="card-body">
                  Leitstelle:<br>nicht besetzt
                </div>
              </div>
            @else
              <div class="card bg-success text-white">
                <div class="card-body">
                  Leitstelle:<br>{{Auth::user()->name}}
                </div>
              </div>
            @endif
        @endif
      </form>
    </div>
  @endforeach

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
