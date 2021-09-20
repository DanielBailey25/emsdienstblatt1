<div class="row" id="infobar">
  <div class="col-md-2 col-sm-6 py-1">
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
      </form>
    </div>
  @endforeach
</div>
