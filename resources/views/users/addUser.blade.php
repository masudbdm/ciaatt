@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
    @include('alerts.alerts')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header bg-success">
                        <h3 class="card-title">Add User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => ['users.store'], 'method' => 'post', 'files' => true]) !!}
                        @include('users.userForm')
                        <div class="form-group">
                            {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
