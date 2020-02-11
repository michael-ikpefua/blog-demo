@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th>{{ $user->name }}</th>
                                <td> 
                                    @can(\App\Classes\Permissions::USER_READ)
                                    <a href="" class="btn btn-primary btn-sm">Details</a>
                                    @endcan

                                    @can(\App\Classes\Permissions::USER_UPDATE)
                                    <a href="" class="btn btn-success btn-sm">Edit</a>
                                    @endcan

                                    @can(\App\Classes\Permissions::USER_DELETE)
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
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