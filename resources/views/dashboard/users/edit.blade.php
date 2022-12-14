@extends('layouts.app')


@section('content')
    <div class="page-wrapper">
        <div class="page-content">

            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Actualizar Usuario
                        </div>
                        <div class="card-body">
                            @can('show user')
                                <a href="{{route('users.index')}}" class="btn btn-dark mb-3">Ver todos</a>
                            @endcan

                            {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Nombre</label>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Email</label>
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Contraseña</label>
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Confirmar contraseña</label>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Asignar rol</label>
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}

                                </div>
                                @can('edit user')
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-dark mt-3 px-5">Guardar</button>
                                    </div>
                                @endcan

                            </div>
                            {!! Form::close() !!}

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection