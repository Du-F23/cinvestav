@extends('layouts.app')

@section('title', 'Usuarios')

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
                    <h4 class="card-title">Users List</h4>
                    {{--                    boton para crear un nuevo usuario--}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-sm mb-3"
                           type="button">
                            <i class="mdi mdi-account-plus-outline mdi-16px align-middle"></i>
                            New User</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="table-dark">
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{ $user->title }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}"
                                           class="btn btn-outline-warning btn-sm" type="button"
                                           title="Editar Usuario {{$user->name}}">
                                            <i class="mdi mdi-pencil-outline mdi-16px align-middle"></i>
                                            Edit</a>
                                        <button
                                            class="btn btn-danger btn-sm align-items-center justify-center items-center text-center"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            data-bs-placement="top"
                                            title="Eliminar"
                                            type="button"
                                            onclick="deleteUser({{$user->id}})"
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
                            {{ $users->links() }}
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="deleteForm" method="POST">
                                        @csrf
                                        @method('DELETE')
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
            @if($usersDeleted->count() !== 0)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users Deleted List</h4>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usersDeleted as $user)
                                    <tr class="table-dark">
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{ $user->title }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <button
                                                class="btn btn-outline-success btn-sm align-items-center justify-center items-center text-center"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal3"
                                                data-bs-placement="top"
                                                title="Restaurar"
                                                type="button"
                                                onclick="restoreUser({{$user->id}})"
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
                                                onclick="deleteForceDeleteUser({{$user->id}})"
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
                                {{ $usersDeleted->links() }}
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">User Force Delete</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" id="deleteForm" method="POST">
                                            @csrf
                                            @method('PUT')
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
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">User Restore</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" id="restoreForm" method="POST">
                                            @csrf
                                            @method('put')
                                            <p id="banner">¿Estas seguro de restaurar este registro?</p>
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
                <div class="dropdown-divider"></div>
            @endif
        </div>

        <script type="text/javascript">
            function deleteUser(id) {
                let form = document.getElementById('deleteForm')
                form.action = '/users/' + id

                $.ajax({
                    url: '/users/' + id,
                    type: 'GET',
                    success: function (response) {
                        $('#banner').html('¿Estas seguro de eliminar este registro? ' + response.title + ' ' + response.name);
                    }
                })
            }

            function restoreUser(id) {
                let form = document.getElementById('restoreForm')
                form.action = '/users/' + id + '/restore'

                $.ajax({
                    url: '/users/' + id,
                    type: 'GET',
                    success: function (response) {
                        $('#banner').html('¿Estas seguro de restaurar este registro? ' + response.title + ' ' + response.name);
                    }
                })
            }

            function deleteForceDeleteUser(id) {
                let form = document.getElementById('deleteForm')
                form.action = '/users/' + id + '/forceDelete'

                $.ajax({
                    url: '/users/' + id,
                    type: 'GET',
                    success: function (response) {
                        $('#banner').html('¿Estas seguro de eliminar permanentemente este registro? ' + response.title + ' ' + response.name);
                    }
                })
            }
        </script>
    </div>
@endsection
