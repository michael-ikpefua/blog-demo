@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('danger'))
            <div class="alert alert-danger" role="alert">
                {{ session('danger') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>Users</div>
                    <div>
                        @can("create", \App\User::class)
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Add User</a>
                        @endcan
                    </div>
                </div>


                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th>{{ $user->name }}</th>
                                @foreach($user->roles as $role)
                                 <td>
                                     {{ $role->name }}
                                 </td>
                                 @endforeach
                                <td class="d-flex justify-content-center"> 
                                    @can(\App\Classes\Permissions::USER_READ)
                                    <a href="{{ $user->path() }}" class="btn btn-primary btn-sm mr-1">Details</a>
                                    @endcan

                                    @can(\App\Classes\Permissions::USER_UPDATE)
                                    <a href="{{ route('user.edit', $user->getKey()) }}" 
                                        class="btn btn-success btn-sm mr-1">
                                        Edit
                                    </a>
                                    @endcan

                                    @can(\App\Classes\Permissions::USER_DELETE)
                                    <form action="{{ route('user.delete', $user->getKey()) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan


                                    
                                 </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection