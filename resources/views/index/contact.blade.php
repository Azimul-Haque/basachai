@extends('layouts.index')
@section('title')
    Contact Us
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
@endsection

@section('content')
    <!-- head section -->
    <section class="content-top-margin wow fadeInUp bg-gray">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6 xs-margin-bottom-four">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 text-uppercase agency-title">Contact Us</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                    <span class="text-extra-large font-weight-400"></span>
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <!-- end head section -->

    <section class="wow fadeIn">
        <div class="container">
            <div class="row">
                <!-- office address -->
                <div class="col-md-6 col-sm-6 xs-margin-bottom-ten">
                    {{-- <div class="position-relative"><img src="{{ asset('images/abc.png') }}" alt=""/><a class="highlight-button-dark btn btn-very-small view-map no-margin bg-black white-text" href="https://www.google.co.in/maps" target="_blank">See on Map</a></div> --}}
                    <div id="canvas1" class="col-md-12 col-sm-12 no-padding contact-map map">
                        <iframe id="map_canvas1" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116834.00977785622!2d90.34928579127303!3d23.780777744540654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1612207055079!5m2!1sen!2sbd" style="max-height: 380px !important;"></iframe>
                    </div>
                    <div class="row">
                        <div class="col-md-6 xs-text-center">
                            <p class="text-med black-text letter-spacing-1 margin-ten no-margin-bottom text-uppercase font-weight-600 xs-margin-top-five">Head Office</p>
                            <p><i class="fa fa-map-marker black-text"></i> Dhaka, Bangladesh</p>
                        </div>
                        <div class="col-md-6 xs-text-center">
                            <p class="text-med black-text letter-spacing-1 margin-ten no-margin-bottom text-uppercase font-weight-600 xs-margin-top-five">Contact Info.</p>
                            <p class="black-text no-margin-bottom"><strong><i class="fa fa-phone black-text"></i></strong> <a href="tel:+8801580323847">+88 01580-323847</a></p>
                            <p class="black-text"><strong><i class="fa fa-envelope black-text"></i></strong> <a href="mailto:basachai@gmail.com">basachai@gmail.com</a></p>
                        </div>
                    </div>
                </div>
                <!-- end office address -->

                <div class="col-md-6 col-sm-6">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">Contact Form</span><br/><br/><br/>
                    {!! Form::open(['route' => 'index.storeformmessage', 'method' => 'POST']) !!}
                        <div id="success" class="no-margin-lr"></div>
                        <input name="name" type="text" value="{{ old('name') }}" placeholder="Name" required="" />
                        <input name="email" type="email" value="{{ old('email') }}" placeholder="Email"  required="" />
                        <textarea name="message" placeholder="Message"  required="">{{ old('message') }}</textarea>
                        
{{--                         @php
                          $contact_num1 = rand(1,20);
                          $contact_num2 = rand(1,20);
                          $contact_sum_result_hidden = $contact_num1 + $contact_num2;
                        @endphp --}}
                        <img src="data:image/png;base64,{{ $imstr }}" style="height: 60px; width: auto; margin-bottom: 5px;" />
                        <input type="hidden" name="hidden_capthcatext" value="{{ $capthcatext }}">
                        {{-- <input type="hidden" name="contact_sum_result_hidden" value="{{ $contact_sum_result_hidden }}"> --}}
                        <input type="text" name="contact_capthcatext" id="" class="form-control" placeholder="Fill the capthca text" required="">
                        
                        <button id="contact-us-button" type="submit" class="highlight-button-dark btn btn-small button xs-margin-bottom-five"><i class="fa fa-paper-plane"></i> Send</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="wow fadeIn no-padding">
        <div class="container-fuild">
            <div class="row no-margin">
                <div id="canvas1" class="col-md-12 col-sm-12 no-padding contact-map map">
                    <iframe id="map_canvas1" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.0504462044805!2d90.36544581538512!3d23.78121789351428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa19b3a900e5de37f!2sKilla%20Consultancy!5e0!3m2!1sen!2sbd!4v1571605991033!5m2!1sen!2sbd"></iframe>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@section('js')
   
@endsection