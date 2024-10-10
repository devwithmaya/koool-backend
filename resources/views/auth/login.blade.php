@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-6 col-xl-4 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">

          </div>
        </div>


          <div class="col-md-12 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block text-center mb-2">Koool</a>
              <h5 class="text-muted fw-normal text-center mb-4">Welcome back! Log in to your account.</h5>

              <form class="forms-sample" action="{{route('login')}}" method="POST">
                  @csrf
                  <div class="mb-3">
                      <label for="email" class="form-label">Email address</label>
                      <input type="email"
                             class="form-control @if($errors->any()) is-invalid @endif"
                             name="email"
                             id="email"
                             placeholder="Email">
                      @if($errors->any())
                      <div class="invalid-feedback">
                          Identifiants Incorrects
                      </div>
                      @endif
                  </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="userPassword" autocomplete="current-password" placeholder="Password">
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="authCheck">
                  <label class="form-check-label" for="authCheck">
                    Remember me
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-50 mb-2 mb-0">Login</button>
                  <a href="{{route('google')}}"  class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="twitter"></i>
                    Login with google
                  </a>
                </div>
                {{--<a href="{{ url('/auth/register') }}" class="d-block mt-3 text-muted">Not a user? Sign up</a>--}}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
