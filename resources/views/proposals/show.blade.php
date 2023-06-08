@extends('layouts.app')
@if(Auth::user()->role_id === 2)
    @section('title', 'Show Proposals')
@else
    @section('title', 'Show My Proposals')
@endif

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Show Proposal</h4>
                    <div class="float-end mb-3">
                        <p class="text-muted">Status: &nbsp;&nbsp;&nbsp;<span
                                class="badge @if($proposal->status === 1) badge-success @elseif($proposal->status === 2) badge-danger @else badge-warning @endif">
                                @if($proposal->status === 1)
                                    Approved
                                @elseif($proposal->status === 2)
                                    Rejected
                                @else
                                    Pending
                                @endif</span>
                    </div>
                    <div class="dropdown-divider"></div>
                    <h4 class="card-title">Project Info</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="name">Name of Project</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ $proposal->project->name }}"
                                           class="form-control bg-dark text-white"
                                           name="name" id="name"
                                           disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="description">Description</label>
                                <div class="col-sm-9">
                                                <textarea
                                                    class="form-control bg-dark text-white"
                                                    rows="4" name="description"
                                                    disabled
                                                    id="description">{{ $proposal->project->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <h4 class="card-title">Proposal Info</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="archive">Archive</label>
                                <div class="col-sm-9">
                                    <a href="{{ route('proposals.download', $proposal->id) }}" target="_blank"
                                       class="btn btn-dark">
                                        <i class="mdi mdi-file-pdf btn-icon-prepend"></i>
                                        View Archive
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="rama_id">Rama Or
                                    Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control bg-dark text-white" name="rama_id" id="rama_id"
                                            disabled>
                                        <option
                                            value="{{ $proposal->rama->id }}">{{ $proposal->rama->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('proposals.index') }}" class="btn btn-dark">Return</a>
                    &nbsp;&nbsp;
                    @if(Auth::user()->role_id === 2)
                        <button
                            class="btn btn-danger btn-sm align-items-center justify-center items-center text-center"
                            data-bs-toggle="modal"
                            data-bs-target="#updateStatus"
                            data-bs-placement="top"
                            title="Change Status"
                            type="button"
                        >
                            <i class="mdi mdi-file-check-outline btn-icon-prepend"></i>
                            Change Status
                        </button>
                        <div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Status</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" id="updateForm"
                                              action="{{ route('proposals.evaluateStore', $proposal->id) }}">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="statusUpdate">Status</label>
                                                <select class="form-control bg-dark text-white" name="statusUpdate"
                                                        id="statusUpdate">
                                                    <option value="0">Pending</option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-facebook" type="button"
                                                        data-bs-dismiss="modal">Cancelar
                                                </button>
                                                <button class="btn btn-success" type="submit"
                                                        onclick="updateStatus({{ $proposal->id }})">Guardar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
