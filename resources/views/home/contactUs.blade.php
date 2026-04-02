@extends('home.layouts.pageMaster')
@push('meta')
<meta property="og:type" content="website">
@endpush
@section('content')

<section class="py-7">
    <div class="container">

        @if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Message Sent!',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK',
            confirmButtonColor: '{{ $websiteParameter->secondary_color }}'
        });
    });
</script>
@endif

        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="mb-2">Contact Us</h2>
                <p class="text-muted">
                    Have a question or need help? Fill out the form below and we usually respond within 24 hours.
                </p>
            </div>
        </div>

        {{-- CONTACT INFO CARDS --}}
        <div class="row mb-5 text-center">
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="fa fa-map-marker fa-2x mb-3"
                           style="color:{{ $websiteParameter->primary_color }}"></i>
                        <h6>Office Address</h6>
                        <p class="mb-0" style="white-space: pre-wrap;">{!! $websiteParameter->footer_address !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="fa fa-phone fa-2x mb-3"
                           style="color:{{ $websiteParameter->primary_color }}"></i>
                        <h6>Phone</h6>
                        <p class="mb-0">
                            <a href="tel:{{ $websiteParameter->contact_mobile }}">
                                {{ $websiteParameter->contact_mobile }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="fa fa-envelope fa-2x mb-3"
                           style="color:{{ $websiteParameter->primary_color }}"></i>
                        <h6>Email</h6>
                        <p class="mb-0">
                            <a href="mailto:{{ $websiteParameter->contact_email }}">
                                {{ $websiteParameter->contact_email }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM + MAP --}}
        <div class="row align-items-start">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg rounded">
                    <div class="card-header text-white"
                         style="background-color:{{ $websiteParameter->primary_color }};color:#ffffff !important;">
                        <h5 class="mb-0 w3-text-white">Send Us a Message</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.information') }}" autocomplete="off">
                            @csrf

                            {{-- Honeypot --}}
                            <div style="display:none">
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="customer_name"
                                       class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="customer_email"
                                       class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="customer_message"
                                          rows="5"
                                          class="form-control"
                                          placeholder="Write your message here..."
                                          required></textarea>
                            </div>

                            <button type="submit"
                                    class="btn w-100 text-white"
                                    style="background-color:{{ $websiteParameter->secondary_color }}">
                                Send Message
                            </button>

                            <p class="text-muted text-sm mt-3 mb-0">
                                We respect your privacy. Your information will not be shared.
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            {{-- MAP --}}
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        {!! $websiteParameter->google_map_code_contact !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
