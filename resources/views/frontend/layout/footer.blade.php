<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h4 class="footer-title">Royal Furniture</h4>
                <p style="color: rgba(255,255,255,0.7); font-size: 14px; line-height: 1.8;">
                    {{ $siteDescription }}
                </p>
                <div class="social-links" style="margin-top: 20px;">
                    <a href="{{ $facebook }}" class="social-link" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $twitter }}" class="social-link" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $instagram }}" class="social-link" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $youtube }}" class="social-link" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div>
                <h4 class="footer-title">Footer Links</h4>
                <ul class="footer-links">
                    @if($footerLinks->isEmpty())
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('page', 'about-us') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    @else
                        @foreach($footerLinks as $item)
                            <li><a href="{{ $item->url }}" @if($item->opens_in_new_tab) target="_blank" rel="noopener" @endif>{{ $item->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div>
                <h4 class="footer-title">Customer Service</h4>
                <ul class="footer-links">
                    @if($customerService->isEmpty())
                        <li><a href="{{ route('page', 'faq') }}">FAQ</a></li>
                        <li><a href="{{ route('page', 'shipping-returns') }}">Shipping & Returns</a></li>
                        <li><a href="{{ route('page', 'privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('page', 'terms-conditions') }}">Terms & Conditions</a></li>
                    @else
                        @foreach($customerService as $item)
                            <li><a href="{{ $item->url }}" @if($item->opens_in_new_tab) target="_blank" rel="noopener" @endif>{{ $item->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Contact Us</h4>
                <div class="footer-contact">
                    <p><i class="fas fa-map-marker-alt"></i> {{ $footerAddress }}</p>
                    <p><i class="fas fa-phone"></i> {{ $footerPhone }}</p>
                    <p><i class="fas fa-envelope"></i> {{ $footerEmail }}</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Royal Furniture. All Rights Reserved. Designed with <i class="fas fa-heart" style="color: var(--secondary);"></i></p>
        </div>
    </div>
</footer>
