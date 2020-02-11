@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-7">
            @if(session('success'))
            <div class="alert alert-danger">
                {{ session('success') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>{{ $user->name }} Details</div>

                </div>


                <div class="card-body">
                    <ul>
                        <li>{{ $user->name }}</li>
                        <li>{{ $user->email }}</li>
                        <li class="font-weight-bold">Permission Details</li>
                        @foreach($user->permissions as $userPermission)
                        <label class="badge badge-info">{{ $userPermission->name }} </label>
                        @endforeach
                    </ul>

                    @can(\App\Classes\Permissions::USER_UPDATE)
                    <button class="btn btn-primary " id='permission-button'>
                        Update User Permission
                    </button>
                    @endcan

                </div>
            </div>
        </div>

        <div class="col-md-5" style="display: none;" id="permission-dashboard">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.permission', $user->getKey()) }}" method="POST">
                        @csrf
                        <form-group>
                            <label for="permission">Permissions</label>

                            <select class="form-control @error('permissions') is-invalid @enderror" multiple="multiple" name="permissions[]" required>
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach

                            </select>
                        </form-group>
                        <button class="btn btn-primary btn-sm mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    document.querySelector('#permission-button').addEventListener('click', () => {
        document.querySelector('#permission-dashboard').style.display = 'block';
    })
</script>

@endsection