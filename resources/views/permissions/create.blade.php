@extends('admin.layouts.adminMaster')


@section('content')

    <section class="content">
        <div class="container-fluid">

            <br>
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">
                        Permission Create
                    </h4>

                    <div class="card-tools">
                        <a class="btn btn-primary btn-xs" href="{{ route('permissions.index') }}"> Back</a>
                    </div>

                </div>


                <div class="card-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {!! Form::open(['route' => 'permissions.store', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 ">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </section>

@endsection
