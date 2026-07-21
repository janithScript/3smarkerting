@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-0">Contact Us</h1>
                <p class="mb-0">Get in touch with our team</p>
            </div>
            <div class="col-md-4 text-md-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 mb-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="mb-4">Send us a Message</h2>

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>Please correct the following errors:
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}" x-data="contactForm()">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                    <select class="form-select @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                                        <option value="">Select a subject</option>
                                        <option value="Product Inquiry" {{ old('subject') == 'Product Inquiry' ? 'selected' : '' }}>Product Inquiry</option>
                                        <option value="Distributor Partnership" {{ old('subject') == 'Distributor Partnership' ? 'selected' : '' }}>Distributor Partnership</option>
                                        <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                                        <option value="Bulk Order" {{ old('subject') == 'Bulk Order' ? 'selected' : '' }}>Bulk Order</option>
                                        <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                        <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror"
                                          id="message" name="message" rows="5" required
                                          placeholder="Please describe your inquiry in detail...">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg" :disabled="submitting">
                                <span x-show="!submitting">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </span>
                                <span x-show="submitting">
                                    <i class="fas fa-spinner fa-spin me-2"></i>Sending...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4 mb-5">
                <!-- Company Info -->
                @if($companySetting ?? null)
                <div class="card shadow mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-3">
                            <i class="fas fa-building text-primary me-2"></i>Contact Information
                        </h4>

                        <div class="mb-3">
                            <h6><i class="fas fa-envelope text-primary me-2"></i>Email</h6>
                            <p class="mb-0">
                                <a href="mailto:{{ $companySetting->company_email }}" class="text-decoration-none">
                                    {{ $companySetting->company_email }}
                                </a>
                            </p>
                        </div>

                        <div class="mb-3">
                            <h6><i class="fas fa-phone text-primary me-2"></i>Phone</h6>
                            <p class="mb-0">
                                <a href="tel:{{ $companySetting->phone_number }}" class="text-decoration-none">
                                    {{ $companySetting->phone_number }}
                                </a>
                            </p>
                        </div>

                        <div class="mb-0">
                            <h6><i class="fab fa-whatsapp text-success me-2"></i>WhatsApp</h6>
                            <p class="mb-0">
                                <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $companySetting->whatsapp_number) }}"
                                   class="text-decoration-none" target="_blank">
                                    {{ $companySetting->whatsapp_number }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Business Hours -->
                <div class="card shadow mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-3">
                            <i class="fas fa-clock text-primary me-2"></i>Business Hours
                        </h4>
                        <div class="row text-sm">
                            <div class="col-6">
                                <p class="mb-1"><strong>Monday - Friday</strong></p>
                                <p class="mb-1"><strong>Saturday</strong></p>
                                <p class="mb-0"><strong>Sunday</strong></p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="mb-1">9:00 AM - 6:00 PM</p>
                                <p class="mb-1">9:00 AM - 2:00 PM</p>
                                <p class="mb-0">Closed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Contact -->
                <div class="card shadow border-primary">
                    <div class="card-body p-4 text-center">
                        <h5 class="mb-3">Need Immediate Assistance?</h5>
                        <p class="text-muted mb-3">For urgent inquiries, please call us directly or send a WhatsApp message.</p>
                        @if($companySetting ?? null)
                        <div class="d-grid gap-2">
                            <a href="tel:{{ $companySetting->phone_number }}" class="btn btn-primary">
                                <i class="fas fa-phone me-2"></i>Call Now
                            </a>
                            <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $companySetting->whatsapp_number) }}"
                               class="btn btn-success" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Distributors Section -->
@if($distributors->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Our Distributors</h2>

        @if($distributorHead ?? null)
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
                <div class="card shadow border-primary">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-user-tie display-4 text-primary mb-3"></i>
                        <h4>Head of Distributors</h4>
                        <h5 class="text-primary">{{ $distributorHead->head_name }}</h5>
                        <p class="mb-3">Contact our distribution head for partnership opportunities and distributor support.</p>
                        <a href="tel:{{ $distributorHead->phone_number }}" class="btn btn-primary">
                            <i class="fas fa-phone me-2"></i>{{ $distributorHead->phone_number }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            @foreach($distributors as $distributor)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $distributor->name }}
                        </h5>
                        <p class="card-text text-muted mb-3">
                            <strong>Coverage Areas:</strong><br>
                            {{ $distributor->covering_regions }}
                        </p>
                        <a href="tel:{{ $distributor->phone_number }}" class="btn btn-outline-primary">
                            <i class="fas fa-phone me-1"></i>{{ $distributor->phone_number }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faq1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1">
                                How can I become a distributor?
                            </button>
                        </h3>
                        <div id="faqCollapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                To become a distributor, please contact our Head of Distributors or fill out the contact form with "Distributor Partnership" as the subject. We'll review your application and get back to you with requirements and next steps.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2">
                                Do you offer bulk pricing?
                            </button>
                        </h3>
                        <div id="faqCollapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, we offer competitive bulk pricing for large orders. Please contact us with your requirements, and our sales team will provide a customized quote based on quantity and products needed.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3">
                                What is your typical response time?
                            </button>
                        </h3>
                        <div id="faqCollapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We strive to respond to all inquiries within 24 hours during business days. For urgent matters, please call us directly or send a WhatsApp message for immediate assistance.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4">
                                Do you provide technical support?
                            </button>
                        </h3>
                        <div id="faqCollapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Absolutely! Our technical team is available to provide product specifications, application guidance, and technical support. Please contact us with "Technical Support" as the subject for specialized assistance.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function contactForm() {
    return {
        submitting: false,

        init() {
            // Form validation and enhancement can be added here
        }
    }
}
</script>
@endpush
@endsection
