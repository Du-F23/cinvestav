@extends('layouts.app')
@section('title', 'Edit User')

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
                    <h4 class="card-title">Edit User</h4>
                    <p class="card-description"> Update your profile information </p>
                    <span class="text-danger">* Required</span>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{ route('users.update', $user->id) }}" class="forms-sample">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title"
                                   value="{{old('title', $user->title)}}"
                                   class="form-control bg-dark text-white @error('title') is-invalid @enderror" id="title">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   value="{{old('name', $user->name)}}"
                                   class="form-control bg-dark text-white @error('name') is-invalid @enderror" id="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email"
                                   value="{{old('email', $user->email)}}"
                                   class="form-control bg-dark text-white @error('email') is-invalid @enderror" id="email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password"
                                   class="form-control bg-dark text-white @error('password') is-invalid @enderror" id="password">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control bg-dark text-white @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                            @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role_id">
                                Role
                            </label>
                            <select name="role_id" id="role_id"
                                    class="form-control bg-dark text-white @error('role_id') is-invalid @enderror">
                                <option value="">Select a role</option>
{{--                                compara el id del rol con el id del usuario y si son iguales lo selecciona y si no lo deja en blanco--}}
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                            @if($role->id == old('role_id', $user->role_id)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 align-items-center justify-content-center">
                            <i class="mdi mdi-content-save mdi-16px align-middle"></i>
                            Update User</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-danger  align-items-center justify-content-center">
                            <i class="mdi mdi-close-circle-outline mdi-16px align-middle"></i>
                            Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
