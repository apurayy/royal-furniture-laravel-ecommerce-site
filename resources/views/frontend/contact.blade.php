@extends('frontend.layout.main')

@section('title', 'Contact Us - Royal Furniture')

@section('styles')
<style>
    .contact-page {
        padding: 40px 0;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
    }
    
    .contact-info h1 {
        font-family: 'Cinzel', serif;
        font-size: 36px;
        color: var(--primary);
        margin-bottom: 20px;
    }
    
    .contact-info > p {
        color: var(--text-light);
        line-height: 1.8;
        margin-bottom: 30px;
    }
    
    .contact-methods {
        margin-bottom: 30px;
    }
    
    .contact-method {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .contact-method-icon {
        width: 50px;
        height: 50px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .contact-method-icon i {
        font-size: 20px;
        color: var(--secondary);
    }
    
    .contact-method-info h4 {
        font-size: 16px;
        color: var(--primary);
        margin-bottom: 5px;
    }
    
    .contact-method-info p {
        color: var(--text-light);
        font-size: 14px;
    }
    
    .contact-form {
        background: var(--white);
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    
    .contact-form h3 {
        font-family: 'Cinzel', serif;
        font-size: 24px;
        color: var(--primary);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--secondary);
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
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
    
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }
    
    .map-container {
        margin-top: 50px;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    
    .map-container iframe {
        width: 100%;
        height: 400px;
        border: none;
    }
    
    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="contact-page">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h1>Get In Touch</h1>
                <p>Have a question or need assistance? We'd love to hear from you. Our team is here to help with any inquiries about our products, orders, or services.</p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-method-info">
                            <h4>Visit Our Showroom</h4>
                            <p>123 Royal Street, New York, NY 10001</p>
                        </div>
                    </div>
                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-method-info">
                            <h4>Call Us</h4>
                            <p>+1 234 567 890<br>Mon - Fri: 9AM - 6PM</p>
                        </div>
                    </div>
                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-method-info">
                            <h4>Email Us</h4>
                            <p>info@royalfurniture.com<br>support@royalfurniture.com</p>
                        </div>
                    </div>
                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-method-info">
                            <h4>Business Hours</h4>
                            <p>Monday - Friday: 9AM - 6PM<br>Saturday: 10AM - 4PM<br>Sunday: Closed</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Your Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject *</label>
                        <select name="subject" class="form-control" required>
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="order">Order Related</option>
                            <option value="product">Product Question</option>
                            <option value="complaint">Complaint</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message *</label>
                        <textarea name="message" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
        
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>
@endsection
