@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>Users</div>
                    <div>
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Add User</a>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                      @include('user._partials.form-data')

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection