<footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-oil-can me-2"></i>3SMarketing</h5>
                    <p class="mb-3">Premium automotive products including brake oil, radiator coolant, grease products, and lubricants for all your automotive needs.</p>
                    @if($companySetting ?? null)
                        <div class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:{{ $companySetting->phone_number }}" class="text-white text-decoration-none">
                                {{ $companySetting->phone_number }}
                            </a>
                        </div>
                        <div class="mb-2">
                            <i class="fab fa-whatsapp me-2"></i>
                            <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $companySetting->whatsapp_number) }}" class="text-white text-decoration-none" target="_blank">
                                WhatsApp
                            </a>
                        </div>
                    @endif
                </div>

                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-white-50 text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="{{ route('products.index') }}" class="text-white-50 text-decoration-none">Products</a></li>
                        <li class="mb-2"><a href="{{ route('contact.index') }}" class="text-white-50 text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>Product Categories</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><span class="text-white-50">Brake Oil</span></li>
                        <li class="mb-2"><span class="text-white-50">Radiator Coolant</span></li>
                        <li class="mb-2"><span class="text-white-50">Grease Products</span></li>
                        <li class="mb-2"><span class="text-white-50">Lubricants</span></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>Connect With Us</h6>
                    @if($companySetting ?? null)
                        <div class="mb-3">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:{{ $companySetting->company_email }}" class="text-white-50 text-decoration-none">
                                {{ $companySetting->company_email }}
                            </a>
                        </div>
                    @endif
                    <div>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-white-50 mb-0">&copy; {{ date('Y') }} 3SMarketing. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white-50 text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white-50 text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>