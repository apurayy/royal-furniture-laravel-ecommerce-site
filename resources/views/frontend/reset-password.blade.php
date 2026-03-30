@extends('frontend.layout.main')

@section('title', 'Reset Password - Royal Furniture')

@section('styles')
<style>
    .auth-page {
        padding: 60px 0;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }

    .auth-container {
        max-width: 450px;
        margin: 0 auto;
    }

    .auth-box {
        background: var(--white);
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .auth-header h1 {
        font-family: 'Cinzel', serif;
        font-size: 28px;
        color: var(--primary);
        margin-bottom: 10px;
    }

    .auth-header p {
        color: var(--text-light);
        font-size: 14px;
    }

    .auth-header a {
        color: var(--secondary);
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--border);
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--secondary);
    }

    .btn-block {
        width: 100%;
    }

    .auth-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 14px;
        color: var(--text-light);
    }

    .auth-footer a {
        color: var(--secondary);
        font-weight: 600;
    }

    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>
@endsection

@section('content')
<div class="auth-page">
    <div class="container">
        <div class="auth-container">
            <div class="auth-box">
                <div class="auth-header">
                    <h1>Reset Password</h1>
                    <p>Enter your new password below.</p>
                </div>

                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                </form>
            </div>

            <p class="auth-footer">
                Remember your password? <a href="{{ route('login') }}">Back to login</a>
            </p>
        </div>
    </div>
</div>
@endsection
