@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <div class="text-center mb-4">
      <img src="{{ asset('image/login.png') }}" alt="Login" width="150" height="150">
    </div>
    
    <form action="/login" method="post">
      @csrf
      
      <div class="form-floating mb-3">
        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>

      <div class="form-floating mb-3">
        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="remember-me" id="rememberMe">
          <label class="form-check-label" for="rememberMe">
            Remember me
          </label>
        </div>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

    </form>
  </div>
</div>
@endsection
