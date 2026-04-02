@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
    @include('alerts.alerts')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header bg-success">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($user,['route' => ['users.update',$user->id], 'method' => 'patch', 'files' => true]) !!}
                        <input type="hidden" name="type" value="user">
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name','id' => 'name']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'E-mail') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail','id' => 'email']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('avatar', 'avatar') !!}
                            {!! Form::file('avatar', ['class' => 'form-control', 'placeholder' => 'Confirmation Password', 'id' => 'avatar']) !!}
                            @if ($user->provider_id)
                            <img src="{{ $user->avatar }}" class="pt-2" alt="{{ alt($user->avatar) }}" srcset="" width="70px" height="60px">
                            @else
                            <img class="pt-3" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $user->avatar() ]) }}" alt="{{ alt($user->avatar) }}" srcset="">
                            @endif
                            
                        </div>
                        
                        
                        <div class="form-group">
                            {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header bg-success">
                        <h3 class="card-title">Edit/update Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($user,['route' => ['users.update',$user->id], 'method' => 'patch', 'files' => true]) !!}
                        <input type="hidden" name="type" value="password">
                        <div class="form-group">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password','id' => 'password']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirmation Password') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmation Password', 'id' => 'password_confirmation']) !!}
                        </div>
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
