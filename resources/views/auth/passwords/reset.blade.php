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
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card auth-card rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <h1 class="h4 mb-1">{{ __('Set a new password') }}</h1>
                            <div class="auth-muted small">
                                {{ __('Choose a strong password you don’t use elsewhere.') }}
                            </div>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}" class="vstack gap-3">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div>
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                       placeholder="name@example.com">
                                @error('email')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="form-label">{{ __('New Password') }}</label>
                                <input id="password" type="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password"
                                       placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div>
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password"
                                       class="form-control form-control-lg"
                                       name="password_confirmation" required autocomplete="new-password"
                                       placeholder="••••••••">
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Reset Password') }}
                            </button>
                        </form>
                    </div>
                </div>

                @if (Route::has('login'))
                    <div class="text-center pt-3">
                        <a class="link-primary text-decoration-none" href="{{ route('login') }}">
                            {{ __('Back to login') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
