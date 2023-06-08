@extends('layouts.app')

@section('title', 'Ramas')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                    {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ramas List</h4>
                    <div class="d-flex justify-content-end">
                        <button
                            class="btn btn-info btn-sm align-items-center justify-center items-center text-center"
                            data-bs-toggle="modal"
                            data-bs-target="#ramaCreate"
                            data-bs-placement="top"
                            title="New Rama"
                            type="button"
                        >
                            <i class="mdi mdi-routes mdi-16px align-middle"></i>
                            New Rama
                        </button>
                        <div class="modal fade" id="ramaCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Rama</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('ramas.store') }}" id="newForm" method="POST">
                                            @csrf
                                            @method('POST')

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name"
                                                       value="{{old('name')}}"
                                                       class="form-control bg-dark text-white @error('name') is-invalid @enderror" id="name">
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description"
                                                       value="{{old('description')}}"
                                                       class="form-control bg-dark text-white @error('description') is-invalid @enderror" id="description">
                                                @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-facebook" type="button"
                                                        data-bs-dismiss="modal">Cancelar
                                                </button>
                                                <button class="btn btn-success" type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ramas as $rama)
                                <tr class="table-dark">
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{ $rama->name }}</td>
                                    <td>{{ $rama->description }}</td>
                                    <td>
                                        <a
                                            class="btn btn-outline-warning btn-sm" type="button"
                                            title="Editar Rama {{$rama->name}}"
                                            href="{{ route('ramas.edit', $rama->id) }}"
                                        >
                                            <i class="mdi mdi-pencil-outline mdi-16px align-middle"></i>
                                            Edit</a>
                                        <button
                                            class="btn btn-danger btn-sm align-items-center justify-center items-center text-center"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            data-bs-placement="top"
                                            title="Eliminar"
                                            type="button"
                                            onclick="deleteRama({{$rama->id}})"
                                        >
                                            <i class="mdi mdi-delete mdi-16px align-middle"></i>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $ramas->links() }}
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Rama</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="deleteForm" method="POST">
                                        @csrf
                                        @method('delete')
                                        <p id="banner">¿Estas seguro de eliminar este registro?</p>
                                        <div class="modal-footer">
                                            <button class="btn btn-facebook" type="button"
                                                    data-bs-dismiss="modal">Cancelar
                                            </button>
                                            <button class="btn btn-danger" type="submit">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
                @if($ramasDeleted->count() !== 0)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ramas Deleted List</h4>
                            <div class="dropdown-divider"></div>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ramasDeleted as $rama)
                                        <tr class="table-dark">
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{ $rama->name }}</td>
                                            <td>{{ $rama->description }}</td>
                                            <td>
                                                <button
                                                    class="btn btn-outline-success btn-sm align-items-center justify-center items-center text-center"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal3"
                                                    data-bs-placement="top"
                                                    title="Restaurar"
                                                    type="button"
                                                    onclick="restoreRama({{$rama->id}})"
                                                >
                                                    <i class="mdi mdi-restore mdi-16px align-middle"></i>
                                                    Restore
                                                </button>

                                                <button
                                                    class="btn btn-danger btn-sm align-items-center justify-center items-center text-center"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal2"
                                                    data-bs-placement="top"
                                                    title="Eliminar"
                                                    type="button"
                                                    onclick="deleteForceDeleteRama({{$rama->id}})"
                                                >
                                                    <i class="mdi mdi-delete mdi-16px align-middle"></i>
                                                    Delete Permanent
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $ramasDeleted->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Rama Force Delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="deleteForceForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <p id="bannerForce">¿Estas seguro de eliminar este registro?</p>
                                    <div class="modal-footer">
                                        <button class="btn btn-facebook" type="button"
                                                data-bs-dismiss="modal">Cancelar
                                        </button>
                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Rama Restore</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="restoreForm" method="POST">
                                    @csrf
                                    @method('put')
                                    <p id="bannerRestore">¿Estas seguro de restaurar este registro?</p>
                                    <div class="modal-footer">
                                        <button class="btn btn-facebook" type="button"
                                                data-bs-dismiss="modal">Cancelar
                                        </button>
                                        <button class="btn btn-success" type="submit">Restaurar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <script type="text/javascript">
        function deleteRama(id) {
            let form = document.getElementById('deleteForm')
            form.action = '/ramas/' + id

            $.ajax({
                url: '/ramas/' + id,
                type: 'GET',
                success: function (response) {
                    $('#banner').html('¿Estas seguro de eliminar este registro? ' + response.name);
                }
            })
        }
        function restoreRama(id) {
            let form = document.getElementById('restoreForm')
            form.action = '/ramas/' + id + '/restore'

            $.ajax({
                url: '/ramas/' + id,
                type: 'GET',
                success: function (response) {
                    console.log(response.name)
                    $('#bannerRestore').html('¿Estas seguro de restaurar este registro? ' + response.name);
                }
            })
        }
        function deleteForceDeleteRama(id) {
            let form = document.getElementById('deleteForceForm')
            form.action = '/ramas/' + id + '/forceDelete'

            $.ajax({
                url: '/ramas/' + id,
                type: 'GET',
                success: function (response) {
                    $('#bannerForce').html('¿Estas seguro de eliminar permanentemente este registro? ' + response.name);
                }
            })
        }
    </script>
@endsection
