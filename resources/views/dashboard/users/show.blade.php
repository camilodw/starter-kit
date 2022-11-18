@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row justify-content-center">
                <div class="col-lg-9 margin-tb">
                    <div class="card">
                        <div class="card-header">Mostrar Usuario</div>
                        <div class="card-body">
                            @can('show user')
                                <a class="btn btn-dark mb-3" href="{{ route('users.index') }}"> Volver</a>
                            @endcan
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nombre:</strong>
                                        {{ $user->name }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Roles:</strong>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge bg-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
