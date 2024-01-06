@extends('layouts.login-register')
@section('title', 'Rental Buku | Login')
@section('content-auth')
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid"
                    alt="Phone image">
            </div>

            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                @if (Session::has('status'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                @endif

                <form action="" method="POST">
                    @csrf
                    <!-- username input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="username" id="username" class="form-control form-control-lg"
                            required />
                        <label class="form-label mt-1" for="username">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control form-control-lg"
                            required />
                        <label class="form-label mt-1" for="password">Password</label>
                    </div>
                    <!-- Submit button -->
                    <div class="btn-lg d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary form-control">Sign in</button>
                    </div>
                    <div class="text-center mt-2">Don't have account?
                        <a href="register">Sign UP</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
