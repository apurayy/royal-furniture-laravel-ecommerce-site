@extends('frontend.layout.main')

@section('title', 'Login - Royal Furniture')

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
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .form-label a {
        font-size: 13px;
        font-weight: 400;
        color: var(--secondary);
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
    
    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }
    
    .remember-me input {
        margin: 0;
    }
    
    .remember-me label {
        font-size: 14px;
        color: var(--text-light);
    }
    
    .btn-block {
        width: 100%;
    }
    
    .social-login {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid var(--border);
    }
    
    .social-login p {
        text-align: center;
        color: var(--text-light);
        font-size: 14px;
        margin-bottom: 15px;
    }
    
    .social-buttons {
        display: flex;
        gap: 15px;
    }
    
    .social-btn {
        flex: 1;
        padding: 12px;
        border: 2px solid var(--border);
        border-radius: 5px;
        background: var(--white);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .social-btn:hover {
        border-color: var(--primary);
        background: var(--bg-light);
    }
    
    .social-btn i {
        font-size: 18px;
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
                    <h1>Welcome Back</h1>
                    <p>Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
                </div>
                
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                        <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Password
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                        <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </form>
                
                <div class="social-login">
                    <p>Or continue with</p>
                    <div class="social-buttons">
                        <button type="button" class="social-btn">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button type="button" class="social-btn">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                    </div>
                </div>
            </div>
            
            <p class="auth-footer">
                Don't have an account? <a href="{{ route('register') }}">Register now</a>
            </p>
        </div>
    </div>
</div>
@endsection
