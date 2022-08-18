@extends('layout.master')
{{-- @section('header', 'Listado') --}}
{{-- @section('title', 'Pacientes') --}}
@section('content')
    <div class="row" id="patient">

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
                    <div class="row">
                        <div class="col-md-11">
                            <div class="input-group input-group-static mb-4" v-if="patients.length > 6">
                                <label class="text-uppercase text-secondary text-xs font-weight-bolder"
                                    style="color: #000000 !important">Buscar
                                    paciente:</label>
                                <input type="text" class="form-control" placeholder="Ingrese el nombre" v-model="search"
                                    onkeypress="return letters(event);">
                            </div>
                            <label v-if="patients.length == 0"
                                class="text-uppercase text-secondary text-xs font-weight-bolder">
                                No hay ningún registro
                            </label>
                        </div>
                        <div class="col-md-1 align-items-center">
                            <button class="btn btn-success btn-sm" v-on:click="showModal()" title="Añadir paciente">
                                <i class="fa-solid fa-user-plus fa-lg"></i>
                            </button>
                        </div>
                    </div>
                    {{-- <div class="text-end">


                    </div> --}}
                    <div class="table-responsive" v-if="patients.length > 0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder"
                                        style="color: #000000 !important">
                                        #</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder"
                                        style="color: #000000 !important">
                                        Nombre completo</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder"
                                        style="color: #000000 !important">
                                        Fecha de <br> nacimiento</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder"
                                        style="color: #000000 !important">
                                        Edad</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder"
                                        style="color: #000000 !important">
                                        Fecha de <br> inscripción</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder"
                                        style="color: #000000 !important">
                                        Hospital de origen</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder"
                                        style="color: #000000 !important">
                                        Nombre y <br> teléfono del tutor</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder"
                                        style="color: #000000 !important">
                                        <i class="fa-solid fa-gear fa-2xl"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(patient,index) in patientFilter"
                                    class="align-middle text-center text-secondary text-sm font-weight-bolder">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ patient.full_name }}</td>
                                    <td>@{{ patient.birth_date }}</td>
                                    <td>@{{ patient.age }}</td>
                                    <td>@{{ patient.inscription_date }}</td>
                                    <td>@{{ patient.origin_hospital }}</td>
                                    <td>@{{ patient.tutor }} <br> @{{ patient.tutor_telephone }} </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" v-on:click="showPatient(patient.id)"
                                            title="Ver información"> <i class="fa-solid fa-eye fa-sm"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-sm" v-on:click="editPatient(patient.id)"
                                            title="Editar información"><i
                                                class="fa-solid fa-pen-to-square fa-sm"></i></button>
                                        {{-- El pdf se abre en una ventana emergente --}}
                                        <button class="btn btn-danger btn-sm" title="Descargar pdf"
                                            v-on:click="showPDF(patient.id)"><i class="fa-solid fa-file-pdf fa-sm"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm" v-on:click="deletePatient(patient.id)"
                                            title="Eliminar paciente"><i class="fa-solid fa-trash fa-sm"></i></button>
                                    </td>
                                    <p v-if="patientFilter.length == 0"
                                        class="text-uppercase text-secondary text-xs font-weight-bolder">
                                        No se encontraron resultados para ésta búsqueda...
                                    </p>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add-->
        <div class="modal fade" id="add_patient" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title font-weight-normal text-white">Nuevo paciente</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                            v-on:click="clean()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Nombre completo</label>
                                    <input type="text" class="form-control" v-model="full_name"
                                        onkeypress="return letters(event);" required>
                                    <div v-if="errors && errors.full_name">
                                        <small class="text-danger">
                                            @{{ errors.full_name[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Sexo</label>
                                    <select class="form-control form-select" v-model="sex">
                                        <option value="" disabled>Seleccione la opción</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                    <div v-if="errors && errors.sex">
                                        <small class="text-danger">
                                            @{{ errors.sex[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Edad</label>
                                    <input type="text" class="form-control" v-model="age"
                                        onkeypress="return numbers(event);" maxlength="2" min="1"
                                        pattern="^[0-9]+" step="1">
                                    <div v-if="errors && errors.age">
                                        <small class="text-danger">
                                            @{{ errors.age[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Fecha de nacimiento</label>
                                    <input type="date" class="form-control" v-model="birth_date">
                                    <div v-if="errors && errors.birth_date">
                                        <small class="text-danger">
                                            @{{ errors.birth_date[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Fecha de inscripción</label>
                                    <input type="date" class="form-control" v-model="inscription_date">
                                    <div v-if="errors && errors.inscription_date">
                                        <small class="text-danger">
                                            @{{ errors.inscription_date[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Ciudad de origen</label>
                                    <input type="text" class="form-control" v-model="origin_city"
                                        onkeypress="return letters(event);" required>
                                    <div v-if="errors && errors.origin_city">
                                        <small class="text-danger">
                                            @{{ errors.origin_city[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Hospital de origen</label>
                                    <input type="text" class="form-control" v-model="origin_hospital" required>
                                    <div v-if="errors && errors.origin_hospital">
                                        <small class="text-danger">
                                            @{{ errors.origin_hospital[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Nombre del tutor</label>
                                    <input type="text" class="form-control" v-model="tutor"
                                        onkeypress="return letters(event);" required>
                                    <div v-if="errors && errors.tutor">
                                        <small class="text-danger">
                                            @{{ errors.tutor[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Teléfono del tutor</label>
                                    <input type="text" class="form-control" v-model="tutor_telephone"
                                        onkeypress="return numbers(event);" required maxlength="10">
                                    <div v-if="errors && errors.tutor_telephone">
                                        <small class="text-danger">
                                            @{{ errors.tutor_telephone[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            v-on:click="clean()">Cerrar</button>
                        <button type="button" class="btn btn-success" v-on:click="addPatient()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Add --}}

        <!-- Modal Edit-->
        <div class="modal fade" id="edit_patient" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title font-weight-normal text-white">Editar información</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                            v-on:click="clean()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Nombre completo</label>
                                    <input type="text" class="form-control" v-model="full_name"
                                        onkeypress="return letters(event);" required>
                                    <div v-if="errors && errors.full_name">
                                        <small class="text-danger">
                                            @{{ errors.full_name[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Sexo</label>
                                    <select class="form-control form-select" v-model="sex" required>
                                        <option value="" disabled>Seleccione la opción</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                    <div v-if="errors && errors.sex">
                                        <small class="text-danger">
                                            @{{ errors.sex[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Edad</label>
                                    <input type="text" class="form-control" v-model="age"
                                        onkeypress="return numbers(event);" maxlength="2" min="1"
                                        pattern="^[0-9]+" step="1">
                                    <div v-if="errors && errors.age">
                                        <small class="text-danger">
                                            @{{ errors.age[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Fecha de nacimiento</label>
                                    <input type="date" class="form-control" v-model="birth_date" required>
                                    <div v-if="errors && errors.birth_date">
                                        <small class="text-danger">
                                            @{{ errors.birth_date[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Fecha de inscripción</label>
                                    <input type="date" class="form-control" v-model="inscription_date" required>
                                    <div v-if="errors && errors.inscription_date">
                                        <small class="text-danger">
                                            @{{ errors.inscription_date[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Ciudad de origen</label>
                                    <input type="text" class="form-control" v-model="origin_city"
                                        onkeypress="return letters(event);" required>
                                    <div v-if="errors && errors.origin_city">
                                        <small class="text-danger">
                                            @{{ errors.origin_city[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Hospital de origen</label>
                                    <input type="text" class="form-control" v-model="origin_hospital" required>
                                    <div v-if="errors && errors.origin_hospital">
                                        <small class="text-danger">
                                            @{{ errors.origin_hospital[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Nombre del tutor</label>
                                    <input type="text" class="form-control" v-model="tutor"
                                        onkeypress="return letters(event);" required>
                                    <div v-if="errors && errors.tutor">
                                        <small class="text-danger">
                                            @{{ errors.tutor[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Teléfono del tutor</label>
                                    <input type="text" class="form-control" v-model="tutor_telephone" maxlength="10"
                                        onkeypress="return numbers(event);" required>
                                    <div v-if="errors && errors.tutor_telephone">
                                        <small class="text-danger">
                                            @{{ errors.tutor_telephone[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            v-on:click="clean()">Cerrar</button>
                        <button type="button" class="btn btn-info"
                            v-on:click="updatePatient(id_patient)">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Edit --}}

        {{-- Modal Show --}}
        <div class="modal fade" id="show_patient" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title font-weight-normal text-white">Información</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                            v-on:click="clean()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Nombre completo</label>
                                    <input type="text" class="form-control" v-model="full_name" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Sexo</label>
                                    <input type="text" class="form-control" v-model="sex" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Edad</label>
                                    <input type="text" class="form-control" v-model="age" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Fecha de nacimiento</label>
                                    <input type="date" class="form-control" v-model="birth_date" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Fecha de inscripción</label>
                                    <input type="date" class="form-control" v-model="inscription_date" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Ciudad de origen</label>
                                    <input type="text" class="form-control" v-model="origin_city" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Hospital de origen</label>
                                    <input type="text" class="form-control" v-model="origin_hospital" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Nombre del tutor</label>
                                    <input type="text" class="form-control" v-model="tutor" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label>Teléfono del tutor</label>
                                    <input type="text" class="form-control" v-model="tutor_telephone" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            v-on:click="clean()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Show --}}

    </div>
@endsection

@push('scripts')
    <script src="js/validation.js"></script>
    <script src="js/patient.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
