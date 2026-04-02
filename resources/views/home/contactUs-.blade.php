@extends('home.layouts.pageMaster')
@section('content')

    <!-- -------- START HEADER 8 w/ card over right bg image ------- -->
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">

                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">







                        <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                            loading="lazy">
                            <iframe class="border-radius-xl"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7297.283740276537!2d90.38277553582218!3d23.86684767580182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c41bd3575995%3A0x52ad89621386c4c4!2sSector%2014%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1768309637034!5m2!1sen!2sbd"
                                width="500" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
 
                        </div>
                        
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                        <div class="card d-flex blur justify-content-center shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-success- shadow-primary border-radius-lg p-3" style="background-color: {{ $websiteParameter->primary_color }};">
                                    <h3 class="text-white text-primary mb-0">Contact us</h3>
                                </div>
                                
                            <div class="card border-1 border-success- mb-3 w-100 mt-4" style="border-color: {{ $websiteParameter->secondary_color }};">
                                {{-- <div class="card-title text-success mt-2">Contact-us</div> --}}
                                <div class="card-body">
                                    <ul class="" style="list-style: none">
                                        <li><i class="fa fa-phone" style="color:{{ $websiteParameter->secondary_color }};" aria-hidden="true" ></i> &nbsp;<a href="tel:{{ $websiteParameter->contact_mobile }}">{{ $websiteParameter->contact_mobile }}</a></li>
                                        <li><i class="fa fa-envelope " style="color:{{ $websiteParameter->secondary_color }};" aria-hidden="true"></i> &nbsp;<a href="mailto:{{ $websiteParameter->contact_email }}">{{ $websiteParameter->contact_email }}</a></li>
                                    </ul>
        
                                </div>
                            </div>
                            </div>

                            <div class="card-body">
                                <p class="pb-3">
                                    For further questions, including partnership opportunities, please email
                                    {{ $websiteParameter->contact_email }}
                                    or contact using our contact form.
                                </p>
                                <form id="contact-form" action="{{ route('user.information') }}" method="post"
                                    autocomplete="off">
                                    @csrf

                                    <div style="display:none">
                                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                                    </div>



                                    <div class="card-body p-0 my-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" placeholder="Full Name"
                                                        name="customer_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ps-md-2">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control"
                                                        placeholder="{{ $websiteParameter->contact_email }}" name="customer_email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 mt-md-0 mt-4">
                                            <div class="input-group input-group-static mb-4">
                                                <label>How can we help you?</label>
                                                <textarea class="form-control" id="message" rows="6"
                                                    placeholder="Describe your problem in at least 250 characters"
                                                    name="customer_message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn bg-gradient-success- mt-3 mb-0" style="background-color:{{ $websiteParameter->secondary_color }} !important;color:white;">Send
                                                    Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

    <!-- -------- END HEADER 8 w/ card over right bg image ------- -->

    <div class="container-fluid">
        <div class="card bg-white">
            <div class="card-body">
                <div class="row">
                    <div class="d-lg-none">
                        <div class="col-12 text-center">
                            <iframe class="img-fluid border-radius-xl"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7297.283740276537!2d90.38277553582218!3d23.86684767580182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c41bd3575995%3A0x52ad89621386c4c4!2sSector%2014%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1768309637034!5m2!1sen!2sbd"
                                width="350" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-">
                            <div class="card-header text-center m-0 p-0">
                                <i class="fa fa-map-marker" aria-hidden="true" style="display: inline-block; text-align: center; width: 120px; height: 120px;
                                                                  line-height: 120px;background-color: {{ $websiteParameter->primary_color }};color: rgb(255, 255, 255);
                                                                  border-radius: 100%;
                                                                  margin-bottom: 20px;
                                                                  font-size: 36px;"></i>
                            </div>
                            <div class="card-body text-center m-0 p-0">
                                <h6><b style="color:{{ $websiteParameter->secondary_color }};">Address</b></h6>
                                <p style="white-space: pre-wrap;">{!! $websiteParameter->footer_address !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-">
                            <div class="card-header text-center  m-0 p-0">
                                <i class="fa fa-phone" aria-hidden="true"
                                    style="display: inline-block; text-align: center;
                                                                  width: 120px; height: 120px;
                                                                  line-height: 120px; background-color: {{ $websiteParameter->primary_color }}; color: rgb(255, 255, 255); border-radius: 100%; margin-bottom: 20px; font-size: 36px;"></i>
                            </div>
                            <div class="card-body text-center m-0 p-0">
                                <h6><b style="color:{{ $websiteParameter->secondary_color }};">Contact Number</b></h6>
                                <p><a href="tel:{{ $websiteParameter->contact_mobile }}">{{ $websiteParameter->contact_mobile }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-">
                            <div class="card-header text-center m-0 p-0">
                                <i class="fa fa-envelope" aria-hidden="true" style="display: inline-block; text-align: center;
                                                                  width: 120px;
                                                                  height: 120px;
                                                                  line-height: 120px; background-color: {{ $websiteParameter->primary_color }};
                                                                  color: rgb(255, 255, 255);
                                                                  border-radius: 100%;
                                                                  margin-bottom: 20px;
                                                                  font-size: 36px;"></i>
                            </div>
                            <div class="card-body text-center m-0 p-0">
                                <h6><b style="color:{{ $websiteParameter->secondary_color }};">Email Address</b></h6>
                                <p>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <a href="mailto:{{ $websiteParameter->contact_email }}">{{ $websiteParameter->contact_email }}</a> <br>
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
