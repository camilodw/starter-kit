@extends('layouts.app')
@section('content')

    <div class="page-wrapper">
        <div class="page-content">

            <div class="row">
                <div class="col-xl-9 mx-auto">

                    <div class="card">
                        <div class="card-header">
                            Panel de usuarios
                        </div>
                        <div class="card-body">
                            @can('create user')
                            <a href="{{ route('users.create') }}" class="btn btn-dark mb-3">Agregar Usuario</a>
                            @endcan
                            <table class="table mb-2" id="example2">
                                <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th width="280px">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <span class="badge bg-success">{{$v}}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>


                                            <form action="{{ route('users.destroy',$user->id) }}" method="POST">

                                                @can('show user')
                                                        <a class="btn" href="{{ route('users.show',$user->id) }}"><i class="fas fa-eye fa-lg"></i></a>
                                                @endcan
                                                @can('edit user')
                                                    <a class="btn" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-pencil-alt fa-lg"></i></a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('delete user')
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario?');" class="btn"><i class="fas fa-trash fa-lg"></i></button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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