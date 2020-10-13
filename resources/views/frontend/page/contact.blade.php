@extends('frontend.layouts.template')
@php
    $contact_title_bg = "style='background-image:url(images/contact-01.png)'";
@endphp
@section('main')
    <main id="main" class="site-main contact-main">
        <div class="page-title page-title--small align-left" {!! $contact_title_bg !!}>
            <div class="container">
                <div class="page-title__content">
                    <h1 class="page-title__name">{{__('Contact Us')}}</h1>
                    <p class="page-title__slogan">{{__('We want to hear from you.')}}</p>
                </div>
            </div>
        </div><!-- .page-title -->
        <div class="site-content site-contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-text">
                            <h2>{{__('Our Offices')}}</h2>
                            <div class="contact-box">
                                <h3>{{__('USA')}}</h3>
                                <p>{{__('Address')}}</p>
                                <p>{{__('Phone')}}</p>
                                <!--<a href="#" title="Get Direction">{{__('Get Direction')}}</a>-->
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-form">
                            @include('frontend.common.box-alert')

                            <h2>{{__('Get in touch with us')}}</h2>
                            <form action="{{route('page_contact_send')}}" method="POST" class="form-underline">
                                @csrf
                                <div class="field-inline">
                                    <div class="field-input">
                                        <input type="text" name="first_name" placeholder="{{__('First name')}} *" required>
                                    </div>
                                    <div class="field-input">
                                        <input type="text" name="last_name" placeholder="{{__('Last name')}} *" required>
                                    </div>
                                </div>
                                <div class="field-input">
                                    <input type="email" name="email" placeholder="{{__('Email')}} *" required>
                                </div>
                                <div class="field-input">
                                    <input type="tel" name="phone_number" placeholder="{{__('Phone number')}}">
                                </div>
                                <div class="field-textarea">
                                    <textarea name="note" placeholder="{{__('Message')}}"></textarea>
                                </div>
                                <div class="field-submit">
                                    <input type="submit" value="{{__('Send Message')}}" class="btn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->
@stop