@extends('layout.app')

@section('title', 'POS | Edit User')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">

            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-9">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">Edit User</h2>
                    </div><!--//resume-title-->
                </div><!--//row-->

            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
                <form action="{{ route('updated_user') }}" method="POST" autocomplete="off" class="row g-3">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="inputAddress">
                        @if ($errors->has('name'))
                            <span class="error" style="color: red">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Username</label>
                        <input type="text" name="username" value="{{ $user->username }}" class="form-control" id="inputCity" readonly>
                        @if ($errors->has('username'))
                            <span class="error" style="color: red">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Contact</label>
                        <input type="number" name="contact" value="{{ $user->contact }}" min="0" class="form-control" id="inputEmail4">
                        @if ($errors->has('contact'))
                            <span class="error" style="color: red">{{ $errors->first('contact') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                      <label for="inputState" class="form-label">User Role</label>
                      <select id="inputState" name="role" class="form-select">
                        <option value="{{ $user->role }}" selected>{{ ($user->role == 0) ? 'User' : 'Admin' }}</option>
                        <option value="1">Admin</option>
                        <option value="0">User</option>
                      </select>
                        @if ($errors->has('role'))
                            <span class="error" style="color: red">{{ $errors->first('role') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">User Position</label>
                        <select id="inputState" name="position" class="form-select">
                          <option>--Select--</option>
                          <option @if ($user->position == 'Manager') selected @endif>Manager</option>
                          <option @if ($user->position == 'Sales Person') selected @endif >Sales Person</option>
                          <option @if ($user->position == 'Receptionist') selected @endif >Receptionist</option>
                          <option @if ($user->position == 'Production Manager') selected @endif >Production Manager</option>
                          <option @if ($user->position == 'Designer') selected @endif >Designer</option>
                        </select>
                        @if ($errors->has('position'))
                            <span class="error" style="color: red">{{ $errors->first('position') }}</span>
                        @endif
                      </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword4" readonly>
                        @if ($errors->has('password'))
                            <span class="error" style="color: red">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="inputPassword5" readonly>
                        @if ($errors->has('confirm_password'))
                            <span class="error" style="color: red">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div><!--//resume-intro-->
            <hr>

            <div class="resume-footer text-center" style="margin-bottom: 1rem;">
                @include('layout.footer')
                {{-- <small class="copyright text-muted">Designed and created by Sammav IT Consult</small> --}}
            </div><!--//resume-footer-->
        </article>

    </div><!--//container-->

@endsection
