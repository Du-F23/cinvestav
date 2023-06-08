@extends('layouts.app')
@section('title', 'Profile')

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
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{old('title', $user->title)}}"
                                   class="form-control bg-dark text-white" id="title">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                <div class="dropdown-divider"></div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Profile Picture</h4>
                        <p class="card-description"> Update your Picture </p>
                        <div class="dropdown-divider"></div>
                        <form method="post" action="{{ route('profile.changePicture') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group w-100">
                                <label for="img">Profile Picture</label>
                                <input type="file" name="img" id="img"
                                       class="form-control bg-dark text-white @error('img') is-invalid @enderror border border-dark"
                                        style="padding: 0.375rem 0.75rem; line-height: 1.5; border-radius: 0.25rem; font-size: 0.875rem; width: 100%; height: calc(1.5em + 0.75rem + 2px); color: #363455; background-color: #000000; background-clip: padding-box; border: 1px solid #343a40; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;"
                                        accept="image/png, image/jpeg, image/jpg">
                                @error('img')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 align-items-center justify-content-center">
                                Update Picture
                                <i class="mdi mdi-image-outline mdi-16px align-middle"></i>
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-danger  align-items-center justify-content-center">
                                <i class="mdi mdi-close-circle-outline mdi-16px align-middle"></i>
                                Cancel</a>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection
