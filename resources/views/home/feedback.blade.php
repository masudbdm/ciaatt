@extends('home.layouts.pageMaster')
@section('content')
    <div class="container mt-5">
        <div class="card text-center">
            <div class="card-header">
                <h4>Send your Feedback</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.information', ['type' => 'feedback']) }}" id="contact-form" method="post"
                    autocomplete="off">
                    @csrf
                    <div class="card-body p-0 my-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-static mb-4">
                                    <label>Your Name (required)</label>
                                    <input type="text" class="form-control" placeholder="Name" name="customer_name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group input-group-static mb-4">
                                    <label>Your Email (required)</label>
                                    <input type="email" class="form-control" placeholder="Email" name="customer_email"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" placeholder="Subject" name="subject" required>
                                </div>
                            </div>
                            <div class="col-md-12 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <label>Your Message</label>
                                    <input type="text" class="form-control" placeholder="Message" name="customer_message"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-gradient-primary mt-3 mb-0">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        <?php if (session('success')) { ?>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        })

        <?php } ?>
        <?php if (session('error')) { ?>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 1500
        })

        <?php } ?>
    </script>

@endpush
