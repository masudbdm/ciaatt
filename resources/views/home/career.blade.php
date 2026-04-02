@extends('home.layouts.pageMaster')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Career</h3>
                </div>
            </div>
            <div class="card-body">
                <li>Challenging work with smart and innovative people, Forced on adding value to our customers and
                    contributing
                    to
                    the company’s success</li>
                <li>A flexible, diverse, and open environment within a well-managed business where people are committed and
                    engaged</li>
                <li>An environment that thrives on teamwork, accountability and continuous improvement</li>
                <li>A balance between work and personal life</li>
                <li>If you are confident to be a part of Sky View family, please fill the form given below</li>

                <span class="text-bold">If you are confident to be a part of Sky View family, please fill the form given
                    below.</span>
                <br>
                <span class="text-bold">Fill The Application Form.</span>
                <br>

                <h4>Send your Resume/CV</h4>

                <form action="{{ route('user.information', ['type' => 'career']) }}" id="contact-form" method="post"
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0 my-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-static mb-4">
                                    <label>Message Subject*</label>
                                    <input type="text" class="form-control" placeholder="Subject" name="subject" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group input-group-static mb-4">
                                    <label>Enter Your Full Name*</label>
                                    <input type="email" class="form-control" placeholder="Full Name" name="customer_name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <label>Email Address*</label>
                                    <input type="email" class="form-control" placeholder="info@skviewlounge2.com"
                                        name="customer_email" required>
                                </div>
                            </div>
                            <div class="col-md-12 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <label>Contact No*</label>
                                    <input type="number" class="form-control" placeholder="Number" name="contact_number"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <label>Enter your Message</label>
                                    <input type="text" class="form-control" placeholder="Enter your Message" name="image"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <label>Upload your CV</label>
                                    <input type="file" class="form-control" placeholder="Number" name="file" required>
                                </div>
                            </div>
                            <div class="col-md-12 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <label>Upload your image</label>
                                    <input type="file" class="form-control" placeholder="Upload your CV" name="image"
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
