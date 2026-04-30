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
                            <h1 class="h4 mb-1">{{ __('Reset your password') }}</h1>
                            <div class="auth-muted small">
                                {{ __('Enter your email and we’ll send you a reset link.') }}
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" class="vstack gap-3">
                            @csrf

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

                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Send Password Reset Link') }}
                            </button>

                            @if (Route::has('login'))
                                <div class="text-center pt-2">
                                    <a class="link-primary text-decoration-none" href="{{ route('login') }}">
                                        {{ __('Back to login') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
