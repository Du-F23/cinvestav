@extends('layouts.app')
@section('title', 'Edit Ramas')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Rama</h4>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{ route('ramas.update', $rama->id) }}" class="forms-sample">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   value="{{old('name', $rama->name)}}"
                                   class="form-control bg-dark text-white @error('name') is-invalid @enderror"
                                   id="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description"
                                   value="{{old('description', $rama->description)}}"
                                   class="form-control bg-dark text-white @error('description') is-invalid @enderror"
                                   id="description">
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 align-items-center justify-content-center">
                            <i class="mdi mdi-content-save mdi-16px align-middle"></i>
                            Update User
                        </button>
                        <a href="{{ route('dashboard') }}"
                           class="btn btn-outline-danger  align-items-center justify-content-center">
                            <i class="mdi mdi-close-circle-outline mdi-16px align-middle"></i>
                            Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
