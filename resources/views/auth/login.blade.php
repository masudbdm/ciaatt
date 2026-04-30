@extends('layouts.app')

@section('content')
<style>
    .auth-shell {
        min-height: calc(100vh - 6rem);
        background: radial-gradient(1200px circle at 10% 10%, rgba(13, 110, 253, .14), transparent 45%),
            radial-gradient(900px circle at 90% 20%, rgba(32, 201, 151, .14), transparent 40%),
            radial-gradient(900px circle at 50% 95%, rgba(111, 66, 193, .12), transparent 45%);
    }
    .auth-card {
        border: 1px solid rgba(255, 255, 255, .65);
        box-shadow: 0 18px 50px rgba(16, 24, 40, .12);
        backdrop-filter: blur(8px);
    }
    .auth-muted { color: rgba(33, 37, 41, .72); }
</style>

<div class="auth-shell d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5">
                <div class="card auth-card rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <h1 class="h4 mb-1">{{ __('Welcome back') }}</h1>
                            <div class="auth-muted small">{{ __('Sign in to continue') }}</div>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="vstack gap-3">
                            @csrf

                            <input type="hidden" name="remember" value="1">

                            <div>
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="name@example.com">
                                @error('email')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="input-group input-group-lg">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password"
                                           placeholder="••••••••"
                                           aria-describedby="togglePassword">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                            aria-label="{{ __('Show password') }}" aria-pressed="false">
                                        {{ __('Show') }}
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="link-primary text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot password?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="pt-2 auth-muted small">
                                {{ __('Tip: You will stay signed in on this device.') }}
                            </div>
                        </form>
                        <script>
                            (function () {
                                var input = document.getElementById('password');
                                var btn = document.getElementById('togglePassword');
                                if (!input || !btn) return;

                                btn.addEventListener('click', function () {
                                    var isHidden = input.type === 'password';
                                    input.type = isHidden ? 'text' : 'password';
                                    btn.textContent = isHidden ? 'Hide' : 'Show';
                                    btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
                                    btn.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
                                });
                            })();
                        </script>

                        {{-- <div class="pt-4 border-top mt-4 text-center">
                            <a href="{{ route('login.google') }}" class="btn btn-outline-danger w-100 mb-2">Login with Google</a>
                            <a href="{{ route('login.facebook') }}" class="btn btn-outline-primary w-100">Login with Facebook</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
