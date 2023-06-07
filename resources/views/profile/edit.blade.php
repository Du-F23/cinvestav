@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-white">Excelente</a>.
                    {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profile User Information</h4>
                    <p class="card-description"> Update your profile information </p>
                    <span class="text-danger">* Required</span>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{ route('profile.update') }}" class="forms-sample">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <input type="text" name="id" value="{{old('id', $user->id)}}"
                                   class="form-control bg-dark text-white" id="id" hidden>
                        </div>
                        <div class="form-group">
                            <label for="id">Name</label>
                            <input type="text" name="name" value="{{old('name', $user->name)}}"
                                   class="form-control bg-dark text-white" id="id">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="form-control bg-dark text-white" id="email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 align-items-center justify-content-center">
                            <i class="mdi mdi-content-save mdi-16px align-middle"></i>
                            Update Info</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-danger  align-items-center justify-content-center">
                            <i class="mdi mdi-close-circle-outline mdi-16px align-middle"></i>
                            Cancel</a>
                    </form>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Password</h4>
                    <p class="card-description"> Update your password </p>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{ route('password.update') }}" class="forms-sample">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password"
                                   class="form-control bg-dark text-white">
                            @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-100">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control bg-dark text-white">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control bg-dark text-white">
                            @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 align-items-center justify-content-center">
                            Update Password
                        <i class="mdi mdi-lock-outline mdi-16px align-middle"></i>
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-danger  align-items-center justify-content-center">
                            <i class="mdi mdi-close-circle-outline mdi-16px align-middle"></i>
                            Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

    </script>
@endsection
