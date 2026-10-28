      <!-- Footer Start -->
      <footer class="py-5" style="background-color: #17324D;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-home me-2" style="font-size: 32px; color: #D6AD60;"></i>
                        <h3 class="text-white fw-bold mb-0" style="font-size: 24px;">RealEstate</h3>
                    </div>
                    <p class="text-white mb-4" style="opacity: 0.8; line-height: 1.8;">
                        Your trusted partner for finding exceptional properties and unforgettable accommodations worldwide.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white" style="opacity: 0.7; font-size: 20px; transition: opacity 0.3s ease;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white" style="opacity: 0.7; font-size: 20px; transition: opacity 0.3s ease;"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white" style="opacity: 0.7; font-size: 20px; transition: opacity 0.3s ease;"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white" style="opacity: 0.7; font-size: 20px; transition: opacity 0.3s ease;"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="text-white fw-bold mb-3" style="font-size: 18px;">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('index') }}" class="text-white text-decoration-none" style="opacity: 0.7; transition: opacity 0.3s ease;">Home</a></li>
                        <li class="mb-2"><a href="{{ route('properties.index') }}" class="text-white text-decoration-none" style="opacity: 0.7; transition: opacity 0.3s ease;">Properties</a></li>
                        <li class="mb-2"><a href="{{ route('categories.index') }}" class="text-white text-decoration-none" style="opacity: 0.7; transition: opacity 0.3s ease;">Categories</a></li>
                        <li class="mb-2"><a href="{{ route('show') }}" class="text-white text-decoration-none" style="opacity: 0.7; transition: opacity 0.3s ease;">Search</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="text-white fw-bold mb-3" style="font-size: 18px;">Categories</h5>
                    <ul class="list-unstyled">
                        @if(isset($categories))
                            @foreach($categories->take(4) as $category)
                                <li class="mb-2"><a href="{{ route('show') }}?catigory_filter={{ $category->name }}" class="text-white text-decoration-none" style="opacity: 0.7; transition: opacity 0.3s ease;">{{ $category->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5 class="text-white fw-bold mb-3" style="font-size: 18px;">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 text-white" style="opacity: 0.7;"><i class="fas fa-envelope me-2"></i>info@realestate.com</li>
                        <li class="mb-2 text-white" style="opacity: 0.7;"><i class="fas fa-phone me-2"></i>+1 234 567 890</li>
                        <li class="mb-2 text-white" style="opacity: 0.7;"><i class="fas fa-map-marker-alt me-2"></i>123 Real Estate Ave</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-white mb-0" style="opacity: 0.5; font-size: 14px;">
                        © 2024 RealEstate. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3" style="opacity: 0.5; font-size: 14px;">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none" style="opacity: 0.5; font-size: 14px;">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->