@extends('layouts.guest')

@section('content')
<body  class=" d-flex flex-column bg-white">
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="row g-0 flex-fill">
      <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
        <div class="container container-tight my-5 px-lg-5">
          <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./logo.png" height="36" alt=""></a>
          </div>
          <h2 class="h3 text-center mb-3">
            Login
          </h2>
          <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Endereço email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label">
                Senha
                @if (Route::has('password.request'))
                    <div class="form-label-description">
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
                </label>
                <div class="input-group input-group-flat">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
          {{-- <div class="text-center text-muted mt-3">
            Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
          </div> --}}
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
        <!-- Photo -->
        <div class="bg-cover h-100 min-vh-100" style="background-image: url(./login.jpg)"></div>
      </div>
    </div>
@endsection
