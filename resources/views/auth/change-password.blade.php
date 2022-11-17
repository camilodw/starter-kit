@extends('layouts/app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-header">Cambiar contraseña</div>
                        <div class="card-body">
                            <form class="row g-3" method="post" action="{{route('update-password.store')}}">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="">Contraseña actual</label>
                                    <input type="password" class="form-control" name="oldpass" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Contraseña nueva</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Confirmar contraseña</label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark px-5">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->

        </div>
@endsection
