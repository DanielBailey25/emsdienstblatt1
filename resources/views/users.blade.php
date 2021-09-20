@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100">
        <div class='row py-4'>
            <div class='col-md-6'>
                <h1 class="display-8">Benutzer <span class="badge bg-secondary">{{$users->count()}}</span></h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @foreach ($users as $user)
                    <div class='card bg-grey'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-5'>
                                    {{$user->name}}
                                </div>
                                <div class='col-7'>
                                    <select name="state_id" class="form-select bg-light" onchange="changeRole(this)" data-user="{{$user->id}}">
                                        @foreach ($roles as $role)
                                            @if ($user->hasRole($role->name))
                                                <option selected value="{{$role->name}}">{{$role->name}}</option>
                                            @else
                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <form action="{{route('addUserView')}}">
                    <button style="float: right" type="submit" class="btn btn-success text-white">hinzufügen</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function changeRole(val) {
        console.log('You selected: ', val.value);
        console.log('For: ', val.dataset.user);

        postData("{{route('changeRole')}}", { user_id: val.dataset.user, role: val.value})
            .then(data => {
                console.log(data);
            });
    }


    async function postData(url, data = {}) {
        const response = await fetch(url, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data)
        });
        response.text()
            .then((body) => {
                console.log(body);
            });
        }
</script>
@endsection
