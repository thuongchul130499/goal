<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @include('layouts.style')
</head>
<body>
  <div class="authentication-theme auth-style_1">
    <div class="row">
      <div class="col-12 logo-section mb-0">
        <a href="../../index.html" class="logo">
          <img src="{{ asset('images/goal.svg') }}" alt="logo" />
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
        <div class="grid">
          <div class="grid-body">
            <div class="row">
              <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                <form action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="form-group input-rounded">
                    <input 
                      type="email" 
                      class="form-control @error('email') is-invalid @enderror" 
                      placeholder="Username"
                      name="email"
                      value="{{ old('email')}}"
                    />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group input-rounded">
                    <input 
                      type="password" 
                      class="form-control @error('password') is-invalid @enderror" 
                      name="password"
                      placeholder="Password" 
                      value="{{ old('password')}}"
                    />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-inline">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : ''}} />Remember me <i class="input-frame"></i>
                      </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block"> Login </button>
                  <div class="row text-center">
                    <a class="btn btn-rounded social-btn-outlined btn-facebook mt-2 col-md-6" href="button">
                      <i class="mdi mdi-facebook"></i>Facebook
                    </a>
                    <a class="btn btn-rounded social-btn-outlined btn-google mt-2 col-md-6" href="{{ route('redirect') }}">
                      <i class="mdi mdi-google"></i>Google
                    </a>
                  </div>
                </form>
                <div class="signup-link">
                  <p>Don't have an account yet?</p>
                  <a href="#">Sign Up</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="auth_footer">
      <p class="text-muted text-center">© Label Inc 2019</p>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @include('layouts.script')
</body>
</html>
