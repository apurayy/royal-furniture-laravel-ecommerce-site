@extends('frontend.layout.main')

@section('title', 'Register - Royal Furniture')

@section('styles')
<style>
    .auth-page {
        padding: 60px 0;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }
    
    .auth-container {
        max-width: 500px;
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
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
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
    
    .checkbox-group {
        margin-bottom: 20px;
    }
    
    .checkbox-group label {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 14px;
        color: var(--text-light);
        cursor: pointer;
    }
    
    .checkbox-group input {
        margin-top: 3px;
    }
    
    .checkbox-group a {
        color: var(--secondary);
    }
    
    .btn-block {
        width: 100%;
    }
    
    .auth-divider {
        display: flex;
        align-items: center;
        margin: 25px 0;
    }
    
    .auth-divider::before, .auth-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }
    
    .auth-divider span {
        padding: 0 15px;
        color: var(--text-light);
        font-size: 14px;
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
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .field-error {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="auth-page">
    <div class="container">
        <div class="auth-container">
            <div class="auth-box">
                <div class="auth-header">
                    <h1>Create Account</h1>
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                </div>
                
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">First Name *</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name *</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required>
                        <small style="color: var(--text-light); font-size: 12px;">Must be at least 8 characters</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Confirm Password *</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                            Subscribe to our newsletter for exclusive offers and updates
                        </label>
                    </div>
                    
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="terms" required>
                            I agree to the <a href="{{ route('page', 'terms-conditions') }}">Terms & Conditions</a> and <a href="{{ route('page', 'privacy-policy') }}">Privacy Policy</a> *
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                </form>
                
                <div class="auth-divider"><span>or</span></div>
                
                <div class="social-buttons">
                    <button type="button" class="social-btn">
                        <i class="fab fa-google"></i> Google
                    </button>
                    <button type="button" class="social-btn">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </button>
                </div>
            </div>
            
            <p class="auth-footer">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection
