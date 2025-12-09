@extends('layouts.app')

@section('title', 'Login')

@section('head')
    <style>
        /* Dark mode adjustments for login form */
        html[data-bs-theme="dark"] .bi-person-circle {
            color: #a78bfa !important;
        }

        html[data-bs-theme="dark"] .form-check-label {
            color: var(--bs-body-color);
        }

        html[data-bs-theme="dark"] .form-check-input {
            background-color: #334155;
            border-color: #475569;
        }

        html[data-bs-theme="dark"] .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        /* Ensure light mode form inputs are white */
        html:not([data-bs-theme="dark"]) .form-control,
        html:not([data-bs-theme="dark"]) .form-select {
            background-color: white !important;
            color: #1f2937 !important;
            border-color: #d1d5db !important;
        }

        html:not([data-bs-theme="dark"]) .form-control:focus,
        html:not([data-bs-theme="dark"]) .form-select:focus {
            background-color: white !important;
            color: #1f2937 !important;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle" style="font-size: 3rem; color: #667eea;"></i>
                        <h4 class="card-title mt-3">Welcome Back</h4>
                        <p class="text-muted">Sign in to your account</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" required class="form-control">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right me-2"></i>Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
