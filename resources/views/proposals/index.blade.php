@extends('layouts.app')
@section('title', 'Proposals')
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
                    <h4 class="card-title">Proposals List</h4>
                    @if(Auth::user()->role_id === 3)
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('proposals.create') }}" class="btn btn-primary mb-2">
                                <i class="mdi mdi-plus btn-icon-prepend"></i>
                                Add Proposal
                            </a>
                        </div>
                    @endif
                    <div class="dropdown-divider"></div>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name of Project</th>
                                <th>Description of Project</th>
                                <th>Rama</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($proposals as $prop)
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $prop->project->name }}</td>
                                    <td>{{ $prop->project->description }}</td>
                                    <td>{{ $prop->rama->name }}</td>
                                    <td>{{ $prop->user->name }}</td>
                                    <td>{{ $prop->status }}</td>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
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
        </div>
    </div>
@endsection
