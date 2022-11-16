@extends('layouts.app')


@section('content')
<div class="page-wrapper">
            <div class="page-content">
<div class="row justify-content-center">
    <div class="col-lg-9 margin-tb">
        <div class="card">
            <div class="card-header">
                Crear rol nuevo
            </div>
            <div class="card-body">
                @can('show role')
                    <a class="btn btn-dark mb-1" href="{{ route('roles.index') }}"> Volver</a>
                @endcan
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

                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="card mt-3">
                    <div class="card-header bg-dark text-white">Permisos de rol</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                <div class="form-group">
                                    <strong>Permisos:</strong>

                                    <div class="row">
                                        @foreach($permission as $value)
                                            <div class="col-md-3">
                                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                                    {{ $value->name }}</label>
                                            </div>

                                            <br/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-dark mt-2">Save</button>
                            </div>
                        </div>
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