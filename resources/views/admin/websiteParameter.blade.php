@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
<div class="container-fluid">

    @include('alerts.alerts')
    
    <div class="card card-widget">
        <div class="card-header with-border">
            <h3 class="card-title">
                Website Parameter Update
            </h3>
        </div>

        <form method="post" action="{{ route('admin.websiteParameterUpdate') }}" enctype="multipart/form-data">
            <div class="card-body" style="background-color: #ccc;">
                <div class="row">
                    <div class="col-md-6">

                        <div class="card card-widget">
                            <div class="card-body">

                                @csrf



                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="  control-label">Title in Head Tag</label>

                                    <input type="text" name="title" class="form-control"
                                    value="{{ old('title') ?: $post->title ?? '' }}" id="title"
                                    placeholder="Title of HTML Head Part <title>Title Here</title>"
                                    autocomplete="off">
                                    @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="form-group {{ $errors->has('h1') ? ' has-error' : '' }}">
                                    <label for="h1" class="  control-label">h1</label>

                                    <input type="text" name="h1" class="form-control"
                                    value="{{ old('h1') ?: $post->h1 ?? '' }}" id="h1"
                                    placeholder="Main Heading (h1)" autocomplete="off">
                                    @if ($errors->has('h1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('h1') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('short_title') ? ' has-error' : '' }}">
                                    <label for="short_title" class="  control-label">Short Title</label>

                                    <input type="text" name="short_title" class="form-control"
                                    value="{{ old('short_title') ?: $post->short_title ?? '' }}" id="short_title"
                                    placeholder="Short Title for Admin Left Sidebar" autocomplete="off">
                                    @if ($errors->has('short_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('short_title') }}</strong>
                                    </span>
                                    @endif

                                </div>



                                <div class="form-group {{ $errors->has('slogan') ? ' has-error' : '' }}">
                                    <label for="slogan" class="  control-label">Slogan</label>

                                    <input type="text" name="slogan" class="form-control"
                                    value="{{ old('slogan') ?: $post->slogan ?? '' }}" id="slogan"
                                    placeholder="Main Heading (slogan)" autocomplete="off">
                                    @if ($errors->has('slogan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slogan') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="form-group {{ $errors->has('welcome_page_msg') ? ' has-error' : '' }}">
                                    <label for="welcome_page_msg" class="control-label"> Welcome Page Message </label>

                                    <textarea name="welcome_page_msg" class="form-control" rows="5"
                                    id="welcome_page_msg"
                                    placeholder="Welcome Page Message">{!! old('welcome_page_msg') ?: $post->welcome_page_msg ?? '' !!}</textarea>

                                    @if ($errors->has('welcome_page_msg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('welcome_page_msg') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <hr>
                                <h5 class="mb-2"><b>Homepage Services Section (Dynamic)</b></h5>

                                <div class="form-group {{ $errors->has('home_services_front_title') ? ' has-error' : '' }}">
                                    <label for="home_services_front_title" class="control-label">Front Card Title</label>
                                    <input type="text" name="home_services_front_title" class="form-control"
                                        value="{{ old('home_services_front_title', $post->home_services_front_title ?? '') }}"
                                        id="home_services_front_title"
                                        placeholder="Touch Here / To see our services">
                                    @if ($errors->has('home_services_front_title'))
                                        <span class="help-block"><strong>{{ $errors->first('home_services_front_title') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('home_services_front_text') ? ' has-error' : '' }}">
                                    <label for="home_services_front_text" class="control-label">Front Card Text</label>
                                    <textarea name="home_services_front_text" class="form-control" rows="3"
                                        id="home_services_front_text"
                                        placeholder="Short description (supports line breaks)">{{ old('home_services_front_text', $post->home_services_front_text ?? '') }}</textarea>
                                    @if ($errors->has('home_services_front_text'))
                                        <span class="help-block"><strong>{{ $errors->first('home_services_front_text') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('home_services_back_title') ? ' has-error' : '' }}">
                                    <label for="home_services_back_title" class="control-label">Back Card Title</label>
                                    <input type="text" name="home_services_back_title" class="form-control"
                                        value="{{ old('home_services_back_title', $post->home_services_back_title ?? '') }}"
                                        id="home_services_back_title"
                                        placeholder="Why Choose ...?">
                                    @if ($errors->has('home_services_back_title'))
                                        <span class="help-block"><strong>{{ $errors->first('home_services_back_title') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('home_services_back_text') ? ' has-error' : '' }}">
                                    <label for="home_services_back_text" class="control-label">Back Card Text</label>
                                    <textarea name="home_services_back_text" class="form-control" rows="3"
                                        id="home_services_back_text"
                                        placeholder="Back side description (supports line breaks)">{{ old('home_services_back_text', $post->home_services_back_text ?? '') }}</textarea>
                                    @if ($errors->has('home_services_back_text'))
                                        <span class="help-block"><strong>{{ $errors->first('home_services_back_text') }}</strong></span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('home_services_back_button_text') ? ' has-error' : '' }}">
                                            <label for="home_services_back_button_text" class="control-label">Back Button Text</label>
                                            <input type="text" name="home_services_back_button_text" class="form-control"
                                                value="{{ old('home_services_back_button_text', $post->home_services_back_button_text ?? '') }}"
                                                id="home_services_back_button_text"
                                                placeholder="Start to know more">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('home_services_back_button_link') ? ' has-error' : '' }}">
                                            <label for="home_services_back_button_link" class="control-label">Back Button Link</label>
                                            <input type="text" name="home_services_back_button_link" class="form-control"
                                                value="{{ old('home_services_back_button_link', $post->home_services_back_button_link ?? '') }}"
                                                id="home_services_back_button_link"
                                                placeholder="e.g. /page/our-services/10 or full URL">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('home_services_right_1_title') ? ' has-error' : '' }}">
                                            <label for="home_services_right_1_title" class="control-label">Right Box #1 Title</label>
                                            <input type="text" name="home_services_right_1_title" class="form-control"
                                                value="{{ old('home_services_right_1_title', $post->home_services_right_1_title ?? '') }}"
                                                id="home_services_right_1_title"
                                                placeholder="Pre-Production Services">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('home_services_right_1_link') ? ' has-error' : '' }}">
                                            <label for="home_services_right_1_link" class="control-label">Right Box #1 Link</label>
                                            <input type="text" name="home_services_right_1_link" class="form-control"
                                                value="{{ old('home_services_right_1_link', $post->home_services_right_1_link ?? '') }}"
                                                id="home_services_right_1_link"
                                                placeholder="Optional: /page/... or full URL">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('home_services_right_1_text') ? ' has-error' : '' }}">
                                    <label for="home_services_right_1_text" class="control-label">Right Box #1 Text</label>
                                    <textarea name="home_services_right_1_text" class="form-control" rows="2"
                                        id="home_services_right_1_text"
                                        placeholder="Supports line breaks">{{ old('home_services_right_1_text', $post->home_services_right_1_text ?? '') }}</textarea>
                                </div>
                                <div class="form-group {{ $errors->has('home_services_right_1_link_text') ? ' has-error' : '' }}">
                                    <label for="home_services_right_1_link_text" class="control-label">Right Box #1 Link Text</label>
                                    <input type="text" name="home_services_right_1_link_text" class="form-control"
                                        value="{{ old('home_services_right_1_link_text', $post->home_services_right_1_link_text ?? '') }}"
                                        id="home_services_right_1_link_text"
                                        placeholder="Optional: Read more">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('home_services_right_2_title') ? ' has-error' : '' }}">
                                            <label for="home_services_right_2_title" class="control-label">Right Box #2 Title</label>
                                            <input type="text" name="home_services_right_2_title" class="form-control"
                                                value="{{ old('home_services_right_2_title', $post->home_services_right_2_title ?? '') }}"
                                                id="home_services_right_2_title"
                                                placeholder="Testing Services">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('home_services_right_2_link') ? ' has-error' : '' }}">
                                            <label for="home_services_right_2_link" class="control-label">Right Box #2 Link</label>
                                            <input type="text" name="home_services_right_2_link" class="form-control"
                                                value="{{ old('home_services_right_2_link', $post->home_services_right_2_link ?? '') }}"
                                                id="home_services_right_2_link"
                                                placeholder="Optional: /page/... or full URL">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('home_services_right_2_text') ? ' has-error' : '' }}">
                                    <label for="home_services_right_2_text" class="control-label">Right Box #2 Text</label>
                                    <textarea name="home_services_right_2_text" class="form-control" rows="2"
                                        id="home_services_right_2_text"
                                        placeholder="Supports line breaks">{{ old('home_services_right_2_text', $post->home_services_right_2_text ?? '') }}</textarea>
                                </div>
                                <div class="form-group {{ $errors->has('home_services_right_2_link_text') ? ' has-error' : '' }}">
                                    <label for="home_services_right_2_link_text" class="control-label">Right Box #2 Link Text</label>
                                    <input type="text" name="home_services_right_2_link_text" class="form-control"
                                        value="{{ old('home_services_right_2_link_text', $post->home_services_right_2_link_text ?? '') }}"
                                        id="home_services_right_2_link_text"
                                        placeholder="Optional: Read more">
                                </div>

                                {{-- <div class="form-group {{ $errors->has('user_page_msg') ? ' has-error' : '' }}">
                                    <label for="user_page_msg" class="control-label"> User Page Message </label>

                                    <textarea name="user_page_msg" class="form-control" rows="3" id="user_page_msg"
                                    placeholder="User Page Message">{!! old('user_page_msg') ?: $post->user_page_msg ?? '' !!}</textarea>

                                    @if ($errors->has('user_page_msg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_page_msg') }}</strong>
                                    </span>
                                    @endif
                                </div> --}}

                                    {{-- <div
                                        class="form-group {{ $errors->has('job_post_instraction') ? ' has-error' : '' }}">
                                        <label for="job_post_instraction" class="control-label"> Instraction for job post
                                        </label>

                                        <textarea name="job_post_instraction" class="form-control textarea" rows="5"
                                            id="job_post_instraction"
                                            placeholder="Job post instraction">{!! old('job_post_instraction') ?: $post->job_post_instraction ?? '' !!}</textarea>

                                        @if ($errors->has('job_post_instraction'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('job_post_instraction') }}</strong>
                                            </span>
                                        @endif
                                    </div> --}}


                                    


                            <div class="form-group">
                                <label>Primary Color</label>
                                <div style="display:flex; gap:10px;">
                                    <input type="color"
                                    id="primary_color_picker"
                                    value="{{ old('primary_color', $post->primary_color ?? '#0d6efd') }}">

                                    <input type="text"
                                    name="primary_color"
                                    id="primary_color"
                                    class="form-control"
                                    value="{{ old('primary_color', $post->primary_color ?? '#0d6efd') }}"
                                    placeholder="#0d6efd">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Secondary Color</label>
                                <div style="display:flex; gap:10px;">
                                    <input type="color"
                                    id="secondary_color_picker"
                                    value="{{ old('secondary_color', $post->secondary_color ?? '#6c757d') }}">

                                    <input type="text"
                                    name="secondary_color"
                                    id="secondary_color"
                                    class="form-control"
                                    value="{{ old('secondary_color', $post->secondary_color ?? '#6c757d') }}"
                                    placeholder="#6c757d">
                                </div>
                            </div>

                            


                        </div>
                    </div>





                </div>


                <div class="col-sm-6">

                    <div class="card card-widget">
                        <div class="card-body">


                            <div class="form-group {{ $errors->has('meta_author') ? ' has-error' : '' }}">
                                <label for="meta_author" class="  control-label">Meta Author for Website</label>

                                <input type="text" name="meta_author" class="form-control"
                                value="{{ old('meta_author') ?: $post->meta_author ?? '' }}" id="meta_author"
                                placeholder="Meta Author for SEO of website" autocomplete="off">
                                @if ($errors->has('meta_author'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('meta_author') }}</strong>
                                </span>
                                @endif

                            </div>



                            <div class="form-group {{ $errors->has('meta_description') ? ' has-error' : '' }}">
                                <label for="meta_description" class="control-label">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="4"
                                id="meta_description"
                                placeholder="Meta Description for SEO of Website">{{ old('meta_description') ?: $post->meta_description ?? '' }}</textarea>
                                @if ($errors->has('meta_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('meta_description') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                                <label for="meta_keyword" class="control-label">Meta Keyword</label>


                                <textarea name="meta_keyword" class="form-control" rows="4" id="meta_keyword"
                                placeholder="Meta Keyword for SEO of Website">{{ old('meta_keyword') ?: $post->meta_keyword ?? '' }}</textarea>
                                @if ($errors->has('meta_keyword'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('meta_keyword') }}</strong>
                                </span>
                                @endif

                            </div>


                            


                            <div class="form-group {{ $errors->has('google_map_code_contact') ? ' has-error' : '' }}">
                                <label for="google_map_code_contact" class="control-label">Google Map Code (Contact Page)</label>

                                <textarea name="google_map_code_contact" class="form-control" rows="6"
                                id="google_map_code_contact"
                                placeholder="Paste Google Map iframe code for Contact page">{{ old('google_map_code_contact') ?: $post->google_map_code_contact ?? '' }}</textarea>

                                @if ($errors->has('google_map_code_contact'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('google_map_code_contact') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('google_map_code') ? ' has-error' : '' }}">
                                <label for="google_map_code" class="control-label">Google Map Code (Footer / General)</label>

                                <textarea name="google_map_code" class="form-control" rows="6"
                                id="google_map_code"
                                placeholder="Paste Google Map iframe code for footer or general use">{{ old('google_map_code') ?: $post->google_map_code ?? '' }}</textarea>

                                @if ($errors->has('google_map_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('google_map_code') }}</strong>
                                </span>
                                @endif
                            </div>


                                    {{-- <div class="form-group {{ $errors->has('footer_copyright') ? ' has-error' : '' }}">
                                        <label for="footer_copyright" class="control-label">Footer Copyright Text</label>


                                        <textarea name="footer_copyright" class="form-control" rows="4"
                                            id="footer_copyright"
                                            placeholder="Copyright text in footer area">{{ old('footer_copyright') ?: $post->footer_copyright ?? '' }}</textarea>
                                        @if ($errors->has('footer_copyright'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('footer_copyright') }}</strong>
                                            </span>
                                        @endif

                                    </div> --}}

                                    {{-- <div class="form-group {{ $errors->has('payment_no') ? ' has-error' : '' }}">
                                        <label for="payment_no" class="  control-label">Payment Numbers</label>

                                        <textarea type="text" name="payment_no" class="form-control textarea" rows="5"
                                            value="{{ old('payment_no') ?: $post->payment_no ?? '' }}" id="payment_no"
                                            placeholder="ex. something@some.com"
                                            autocomplete="off">{!! old('payment_no') ?: $post->payment_no ?? '' !!}</textarea>
                                        @if ($errors->has('payment_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('payment_no') }}</strong>
                                            </span>
                                        @endif
                                    </div> --}}

                                    
                                    <div class="form-group {{ $errors->has('fb_page_code') ? ' has-error' : '' }}">
                                        <label for="fb_page_code" class="control-label">
                                            Facebook Page ID
                                        </label>

                                        <input
                                        type="text"
                                        name="fb_page_code"
                                        class="form-control"
                                        id="fb_page_code"
                                        value="{{ old('fb_page_code') ?: ($post->fb_page_code ?? '') }}"
                                        placeholder="e.g. 123456789012345"
                                        autocomplete="off">

                                        @if ($errors->has('fb_page_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fb_page_code') }}</strong>
                                        </span>
                                        @endif
                                    </div>


                                    <div class="form-group {{ $errors->has('fb_url') ? ' has-error' : '' }}">
                                        <label for="fb_url" class="  control-label">Facebook Page Url</label>

                                        <input type="text" name="fb_url" class="form-control"
                                        value="{{ old('fb_url') ?: $post->fb_page_link ?? '' }}" id="fb_url"
                                        placeholder="https://facebook.com/page.username" autocomplete="off">
                                        @if ($errors->has('fb_url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fb_url') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('twitter_url') ? ' has-error' : '' }}">
                                        <label for="twitter_url" class="  control-label">Twitter Url</label>

                                        <input type="text" name="twitter_url" class="form-control"
                                        value="{{ old('twitter_url') ?: $post->twitter_url ?? '' }}" id="twitter_url"
                                        placeholder="Twitter url" autocomplete="off">
                                        @if ($errors->has('twitter_url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('twitter_url') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('youtube_url') ? ' has-error' : '' }}">
                                        <label for="youtube_url" class="  control-label">Youtube Url</label>

                                        <input type="text" name="youtube_url" class="form-control"
                                        value="{{ old('youtube_url') ?: $post->youtube_url ?? '' }}" id="youtube_url"
                                        placeholder="Youtube Url" autocomplete="off">
                                        @if ($errors->has('youtube_url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('youtube_url') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('linkedin_url') ? ' has-error' : '' }}">
                                        <label for="linkedin_url" class="control-label">LinkedIn URL</label>

                                        <input type="url" name="linkedin_url" class="form-control"
                                        value="{{ old('linkedin_url', $post->linkedin_url ?? '') }}" id="linkedin_url"
                                        placeholder="https://www.linkedin.com/company/..." autocomplete="off">
                                        @if ($errors->has('linkedin_url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('linkedin_url') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    {{-- <div class="form-group ">
                                        <label for="news_editions" class=" control-label">News Editions</label> <br>
                                        <?php
                                        $locales = ['en', 'bn'];
                                        $oldNewsLan = $post->news_editions ? explode(', ', $post->news_editions) : null;
                                        
                                        ?>
                                        @foreach ($locales as $locale)
                                        
                                            <label for="{{ $locale }}"><input {{ in_array($locale,$oldNewsLan) ? 'checked' : '' }} type="checkbox" name="news_editions[]"
                                                    id="{{ $locale }}" value="{{ $locale }}">
                                                {{ $locale }}</label>
                                        @endforeach



                                    </div> --}}


                                    <div class="form-group {{ $errors->has('contact_mobile') ? ' has-error' : '' }}">
                                <label for="contact_mobile" class="  control-label">Contact Mobile</label>

                                <input type="text" name="contact_mobile" class="form-control"
                                value="{{ old('contact_mobile') ?: $post->contact_mobile ?? '' }}"
                                id="contact_mobile" placeholder="+055654646515" autocomplete="off">
                                @if ($errors->has('contact_mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_mobile') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('contact_email') ? ' has-error' : '' }}">
                                <label for="contact_email" class="  control-label">Contact email</label>

                                <input type="text" name="contact_email" class="form-control"
                                value="{{ old('contact_email') ?: $post->contact_email ?? '' }}"
                                id="contact_email" placeholder="ex. something@some.com" autocomplete="off">
                                @if ($errors->has('contact_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('footer_address') ? ' has-error' : '' }}">
                                <label for="footer_address" class="control-label">Footer Address</label>


                                <textarea name="footer_address" class="form-control" rows="2" id="footer_address"
                                placeholder="Website address in footer area">{{ old('footer_address') ?: $post->footer_address ?? '' }}</textarea>
                                @if ($errors->has('footer_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('footer_address') }}</strong>
                                </span>
                                @endif

                            </div>


                            <div
                                    class="form-group {{ $errors->has('google_analytics_code') ? ' has-error' : '' }}">
                                    <label for="google_analytics_code" class="control-label"> Google Analytics
                                    (Tracking) Code </label>

                                    <textarea name="google_analytics_code" class="form-control" rows="2"
                                    id="google_analytics_code"
                                    placeholder="Google Analytics Code (Tracking Code)">{!! old('google_analytics_code') ?: $post->google_analytics_code ?? '' !!}</textarea>

                                    @if ($errors->has('google_analytics_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('google_analytics_code') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div
                                class="form-group {{ $errors->has('facebook_pixel_code') ? ' has-error' : '' }}">
                                <label for="facebook_pixel_code" class="control-label"> Facebook (Pixel) Code
                                </label>

                                <textarea name="facebook_pixel_code" class="form-control" rows="2"
                                id="facebook_pixel_code"
                                placeholder="Facebook Pixel Code (Tracking Code)">{!! old('facebook_pixel_code') ?: $post->facebook_pixel_code ?? '' !!}</textarea>

                                @if ($errors->has('facebook_pixel_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('facebook_pixel_code') }}</strong>
                                </span>
                                @endif
                            </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="card card-widget">
                                <div class="card-header with-border">
                                    <h3 class="card-title">Update Favicon </h3>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group {{ $errors->has('favicon') ? ' has-error' : '' }}">
                                                <label for="favicon" class="col-sm-3 control-label">favicon</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="favicon" class="" id="favicon">
                                                    <span class="help-block">Image Dimention 16px X 16px and Ratio
                                                    16/16 is better.</span>

                                                    @if ($errors->has('favicon'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('favicon') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            @if (isset($post->favicon))
                                            <div class="w3-display-container" style="height:110px;">
                                                <img class="img-responsive" style="max-width: 100%;"
                                                src="{{ asset('storage/favicon/' . $post->favicon) }}" alt="">


                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card card-widget">
                                <div class="card-header with-border">
                                    <h3 class="card-title">Update Logo</h3>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                                                <label for="logo" class="col-sm-3 control-label">Logo</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="logo" class="" id="logo">
                                                    <span class="help-block">Image Dimention 100px X 100px or larger
                                                    and Ratio 100/100 is better.</span>

                                                    @if ($errors->has('logo'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('logo') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            @if (isset($post->logo))

                                            <div class="w3-display-container" style="max-height:110px;">
                                                <img class="img-responsive" style="max-width: 100%;"
                                                src="{{ asset('storage/logo/' . $post->logo) }}" alt="">


                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card card-widget">
                                <div class="card-header with-border">
                                    <h3 class="card-title">Update alternate Logo</h3>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group {{ $errors->has('logo_alt') ? ' has-error' : '' }}">
                                                <label for="logo_alt" class="col-sm-4 control-label">Alt Logo</label>
                                                <div class="col-sm-8">
                                                    <input type="file" name="logo_alt" class=""
                                                    id="logo_alt">
                                                    <span class="help-block">Image Dimention 100px X 100px or larger
                                                    and Ratio 100/100 is better.</span>

                                                    @if ($errors->has('logo_alt'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('logo_alt') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            @if (isset($post->logo_alt))
                                            <div class="w3-display-container" style="height:110px;">
                                                <img class="img-responsive" style="max-width: 100%;"
                                                src="{{ asset('storage/logo/' . $post->logo_alt) }}" alt="">


                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>
                        
                        

                        <div class="col-sm-6">

                            <div class="card card-widget">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="mb-2"><b>Homepage Featured Team Member</b></label><br>

                                        <div class="form-check">
                                            <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="front_team_show"
                                            name="front_team_show"
                                            value="1"
                                            {{ old('front_team_show', $post->front_team_show ?? 0) ? 'checked' : '' }}
                                            >

                                            <label class="form-check-label" for="front_team_show">
                                                Featured Team Members Show (Max 4)
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <div class="card card-widget">
                             
                                <div class="card-body">

                                 <div class="form-group">
                                    <label><b>Homepage Featured Content</b></label><br>

                                    <label style="margin-right:15px;">
                                        <input type="radio" name="hero_type" value="image"
                                        {{ old('hero_type', $post->hero_type ?? 'image') == 'image' ? 'checked' : '' }}>
                                        Featured Image
                                    </label>

                                    <label>
                                        <input type="radio" name="hero_type" value="video"
                                        {{ old('hero_type', $post->hero_type ?? '') == 'video' ? 'checked' : '' }}>
                                        Featured Video
                                    </label>
                                </div>


                                

                            </div>
                        </div>



                        <div class="card card-widget">
                            <div class="card-header with-border">
                                <h3 class="card-title">Featured Video (Homepage)</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group {{ $errors->has('featured_video') ? ' has-error' : '' }}">
                                    <label for="featured_video">Featured Video (Max 60MB)</label>
                                    <br><span class="help-block text-danger">
                                        Video ratio must be <b>1240 × 580</b> (≈ 2.13:1)
                                    </span>

                                    <input type="file"
                                    name="featured_video"
                                    id="featured_video"
                                    class="form-control"
                                    accept="video/mp4,video/webm,video/quicktime">

                                    @if ($errors->has('featured_video'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('featured_video') }}</strong>
                                    </span>
                                    @endif

                                    @if(!empty($post->featured_video))
                                    <video width="240" controls style="margin-top:10px">
                                        <source src="{{ asset($post->featuredVideo()) }}">
                                        </video>
                                        @endif
                                    </div>


                                    @if(!empty($post->featured_video))
                                    <small class="text-muted">
                                        Current Video: {{ $post->featured_video }}
                                    </small>
                                    @endif

                                </div>
                            </div>

                            <div class="card card-widget">
                                <div class="card-header with-border">
                                    <h3 class="card-title">Featured Image (Homepage) <b>(1200px X 340px)</b></h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group {{ $errors->has('featured_image') ? ' has-error' : '' }}">
                                        <label for="featured_image" class="control-label">
                                            Featured Image <span class="help-block text-danger">
                                                Mandatory size: <b>1200 × 340 px</b>
                                            </span>
                                        </label>

                                        <input type="file" name="featured_image" id="featured_image">

                                        <span class="help-block">
                                            Recommended size: 1200×630
                                        </span>

                                        @if ($errors->has('featured_image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('featured_image') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    @if(isset($post->featured_image))
                                    <img src="{{ asset($post->featuredImage()) }}"
                                    class="img-responsive"
                                    style="max-height:120px;">
                                    @endif

                                </div>
                            </div>
                        </div>

                        

                    </div>




                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    @push('js')

    <script>
        document.getElementById('primary_color_picker').addEventListener('input', e => {
            document.getElementById('primary_color').value = e.target.value;
        });
        document.getElementById('primary_color').addEventListener('input', e => {
            document.getElementById('primary_color_picker').value = e.target.value;
        });

        document.getElementById('secondary_color_picker').addEventListener('input', e => {
            document.getElementById('secondary_color').value = e.target.value;
        });
        document.getElementById('secondary_color').addEventListener('input', e => {
            document.getElementById('secondary_color_picker').value = e.target.value;
        });
    </script>


    @endpush
