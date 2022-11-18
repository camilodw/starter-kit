@extends('layouts.app')


@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row justify-content-center">
                <div class="col-lg-9 margin-tb">
                    <div class="card">
                        <div class="card-header">Crear nuevo usuario</div>
                        <div class="card-body">
                            @can('show user')
                                <a class="btn btn-dark" href="{{ route('users.index') }}"> Volver</a>
                            @endcan
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>oops!</strong>Existen algunos problemas con los datos ingresados<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nombre:</strong>
                                        {!! Form::text('name', null, ['placeholder' => 'Nombre', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Contraseña:</strong>
                                        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Confirmar contraseña:</strong>
                                        {!! Form::password('confirm-password', ['placeholder' => 'Confirmar Password', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Role:</strong>
                                        {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-dark mt-3">Guardar</button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
