@extends('layout.master')
{{-- @section('header', 'Listado') --}}
{{-- @section('title', 'Pacientes') --}}
@section('content')
    <div class="row mb-4">

        <div class="col-lg-12 col-md-12 mb-md-0 mb-12">
            <div class="card">
                <div class="card-header pb-0 bg-info">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6 class="text-white">Listado</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body px-2 pb-2">
                    <div class="text-end">
                        <button class="btn btn-success btn-sm" title="Añadir paciente">
                            <i class="fa-solid fa-user-plus fa-lg"></i>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nombre completo</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fecha de <br> nacimiento</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Edad</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Sexo</th> --}}

                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ciudad de origen</th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fecha de inscripción</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hospital de <br> origen</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nombre del tutor</th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nombre y <br> teléfono del tutor</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <i class="fa-solid fa-gear fa-2xl"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td class="align-middle text-center text-sm">

                                    </td>
                                    <td class="align-middle">

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button class="btn btn-info btn-sm" title="Ver información"> <i
                                                class="fa-solid fa-eye fa-lg"></i> </button>
                                        <button class="btn btn-secondary btn-sm" title="Editar información"><i
                                                class="fa-solid fa-pen-to-square fa-lg"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Descargar pdf"><i
                                                class="fa-solid fa-file-pdf fa-lg"></i></button>
                                        <button class="btn btn-primary btn-sm" title="Eliminar paciente"><i
                                                class="fa-solid fa-trash fa-lg"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
