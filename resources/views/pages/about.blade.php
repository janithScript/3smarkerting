@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 fw-bold mb-3">About 3SMarketing</h1>
                <p class="lead">Your trusted partner in premium automotive products</p>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="mb-4">Our Company</h2>
                <p class="lead">3SMarketing is a leading provider of premium automotive products, specializing in brake oils, radiator coolants, grease products, and lubricants.</p>
                <p>With years of experience in the automotive industry, we have built a reputation for delivering high-quality products that meet the demanding requirements of modern vehicles. Our commitment to excellence drives us to continuously improve our product offerings and maintain the highest standards of quality.</p>
                <p>We serve a wide network of distributors and customers, ensuring that our premium automotive products are accessible wherever they are needed.</p>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <i class="fas fa-industry display-1 text-primary mb-4"></i>
                    <h4>Quality Manufacturing</h4>
                    <p>State-of-the-art facilities ensuring top-quality products</p>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-6 order-lg-2">
                <h2 class="mb-4">Our Mission</h2>
                <p class="lead">To provide superior automotive products that enhance vehicle performance, safety, and longevity while building lasting relationships with our customers and partners.</p>
                <p>We are committed to:</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Delivering exceptional product quality</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Maintaining competitive pricing</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Providing outstanding customer service</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Supporting our distributor network</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Continuous innovation and improvement</li>
                </ul>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="text-center">
                    <i class="fas fa-bullseye display-1 text-primary mb-4"></i>
                    <h4>Focused Approach</h4>
                    <p>Dedicated to automotive excellence</p>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">Our Vision</h2>
                <p class="lead">To be the most trusted and preferred brand in the automotive products industry, known for innovation, quality, and customer satisfaction.</p>
                <p>We envision a future where our products are the first choice for automotive professionals and enthusiasts worldwide. Through continuous research and development, we strive to introduce innovative solutions that address the evolving needs of the automotive industry.</p>
                <p>Our vision extends beyond just selling products – we aim to be a complete solution provider that supports the success of our customers and contributes to the advancement of automotive technology.</p>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <i class="fas fa-rocket display-1 text-primary mb-4"></i>
                    <h4>Future Forward</h4>
                    <p>Innovation driving automotive solutions</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Categories -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Our Product Range</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="fas fa-stop-circle display-4 text-danger mb-3"></i>
                        <h5 class="card-title">Brake Oil</h5>
                        <p class="card-text">High-performance brake fluids ensuring optimal braking performance and safety.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="fas fa-thermometer-half display-4 text-info mb-3"></i>
                        <h5 class="card-title">Radiator Coolant</h5>
                        <p class="card-text">Premium coolants that protect your engine from overheating and corrosion.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="fas fa-tools display-4 text-warning mb-3"></i>
                        <h5 class="card-title">Grease Products</h5>
                        <p class="card-text">Specialized greases for various automotive applications and components.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="fas fa-oil-can display-4 text-success mb-3"></i>
                        <h5 class="card-title">Lubricants</h5>
                        <p class="card-text">High-quality lubricants for engine protection and enhanced performance.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-cubes me-2"></i>Explore All Products
            </a>
        </div>
    </div>
</section>

<!-- Contact Information -->
@if($companySetting ?? null)
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mb-4">Get In Touch</h2>
                <p class="lead mb-4">Ready to learn more about our products or interested in becoming a distributor? We'd love to hear from you.</p>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 text-center h-100">
                            <div class="card-body">
                                <i class="fas fa-phone display-4 text-primary mb-3"></i>
                                <h5>Call Us</h5>
                                <a href="tel:{{ $companySetting->phone_number }}" class="text-decoration-none">
                                    {{ $companySetting->phone_number }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 text-center h-100">
                            <div class="card-body">
                                <i class="fas fa-envelope display-4 text-primary mb-3"></i>
                                <h5>Email Us</h5>
                                <a href="mailto:{{ $companySetting->company_email }}" class="text-decoration-none">
                                    {{ $companySetting->company_email }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 text-center h-100">
                            <div class="card-body">
                                <i class="fab fa-whatsapp display-4 text-success mb-3"></i>
                                <h5>WhatsApp</h5>
                                <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $companySetting->whatsapp_number) }}" class="text-decoration-none" target="_blank">
                                    Send Message
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-envelope me-2"></i>Contact Form
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
