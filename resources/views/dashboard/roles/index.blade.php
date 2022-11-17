@extends('layouts.app')


@section('content')
    <div class="page-wrapper">
        <div class="page-content">

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-header">Panel de roles</div>
                        <div class="card-body">
                            @can('create role')
                                <a href="{{ route('roles.create') }}" class="btn btn-dark mb-3">Agregar Role</a>
                            @endcan
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <table class="table mb-2" id="example2">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre de rol</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $role->name }}</td>

                                            <td>

                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                    @can('show role')
                                                        <a class="btn btn-sm" href="{{ route('roles.show', $role->id) }}"><i
                                                                class="fas fa-eye fa-lg"></i></a>
                                                    @endcan
                                                    @can('edit role')
                                                        <a class="btn btn-sm" href="{{ route('roles.edit', $role->id) }}"><i
                                                                class="fas fa-pencil-alt fa-lg"></i></a>
                                                    @endcan

                                                    @csrf
                                                    @method('DELETE')
                                                    @can('delete role')
                                                        <button type="submit"
                                                            onclick="return confirm('¿Estás seguro de eliminar el rol?');"
                                                            class="btn btn-sm"><i class="fas fa-trash fa-lg"></i></button>
                                                    @endcan
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr><td>{{$roles->links()}}</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
@endsection
