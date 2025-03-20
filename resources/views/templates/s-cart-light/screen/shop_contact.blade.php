@php
/*
$layout_page = shop_contact
*/
@endphp

@extends($sc_templatePath.'.layout')

@section('block_main')

<section class="banner-contact">
    <div class="overlay"></div>
    <div class="banner-contact-content">
        <h1>Hubungi Kami & Mulai Kolaborasi!</h1>
        <p>Kami siap membantu Anda! Jangan ragu untuk menghubungi kami atau kunjungi lokasi kami untuk diskusi lebih lanjut. Mari bekerja sama dan ciptakan peluang baru bersama!</p>
    </div>
</section>

<section class="section section-sm section-first bg-default text-md-left">
<div class="container" style="margin-top: -40px;">
    <div class="row">
        <div class="col-md-6 contact_content text-center p-4 shadow-sm rounded bg-white d-flex flex-column align-items-center">
            <div class="mb-4">
                <img src="{{ sc_file(sc_store('logo')) }}" class="img-fluid" style="max-width: 200px; height: auto;">
            </div>
            <!-- <h4 class="font-weight-bold mb-3" style="font-family: 'Poppins', sans-serif; color: #0074A8;">{{ sc_store('title') }}</h4> -->
            <address class="text-left w-100">
                <p class="mb-2 d-flex align-items-start">
                    <span class="icon mdi mdi-map-marker" style="color: #F5A623; margin-right: 5px;"></span>
                    <strong style="color: #0074A8;">Alamat:</strong>
                    <span class="ml-2">{{ sc_store('address') }}</span>
                </p>
                <p class="mb-2 d-flex align-items-center">
                    <span class="icon mdi mdi-phone" style="color: #F5A623; margin-right: 5px;"></span>
                    <strong style="color: #0074A8;">Telepon:</strong>
                    <span class="ml-2">{{ sc_store('long_phone') }}</span>
                </p>
                <p class="mb-2 d-flex align-items-center">
                    <span class="icon mdi mdi-email-outline" style="color: #F5A623; margin-right: 5px;"></span>
                    <strong style="color: #0074A8;">Email:</strong>
                    <span class="ml-2">{{ sc_store('email') }}</span>
                </p>
            </address>
            <!-- <h4 class="text-center mt-4" style="font-family: 'Poppins', sans-serif; color: #0074A8;">Lokasi Kami</h4> -->
            <h4 class="lokasi-heading" style="padding-top: 20px">Lokasi Kami</h4>
            <h4 class="lokasi-heading" style="color: #F5A623;">Siap Menyambut Anda di Sini!</h4>
            <div class="embed-responsive embed-responsive-16by9 shadow-sm rounded mt-3" style="border-radius: 10px; overflow: hidden;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.363088510419!2d110.374153!3d-7.8426454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNTAnMzMuNSJTIDExMMKwMjInMjcuMCJF!5e0!3m2!1sen!2s!4v1611816812024!5m2!1sen!2s"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            <!-- <h4 class="text-center mb-4 mt-4" style="font-family: 'Poppins', sans-serif; color: #0074A8;">Hubungi Kami - Kami Siap Membantu Anda!</h4> -->
            <form method="post" action="{{ sc_route('contact.post') }}" class="contact-form p-4 shadow-sm rounded bg-light" id="sc_form-process">
                <h4 class="lokasi-heading">Hubungi Kami</h4>
                <h4 class="lokasi-heading" style="color: #F5A623;">Kami Siap Membantu Anda!</h4>
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label style="color: #0074A8;">{{ sc_language_render('contact.name') }}:</label>
                        <input type="text" class="form-control" name="name" placeholder="{{ sc_language_render('contact.name') }}" value="{{ old('name') }}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label style="color: #0074A8;">{{ sc_language_render('contact.email') }}:</label>
                        <input type="email" class="form-control" name="email" placeholder="{{ sc_language_render('contact.email') }}" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label style="color: #0074A8;">{{ sc_language_render('contact.phone') }}:</label>
                        <input type="tel" class="form-control" name="phone" placeholder="{{ sc_language_render('contact.phone') }}" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label style="color: #0074A8;">{{ sc_language_render('contact.subject') }}:</label>
                        <input type="text" class="form-control" name="title" placeholder="{{ sc_language_render('contact.subject') }}" value="{{ old('title') }}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label style="color: #0074A8;">{{ sc_language_render('contact.content') }}:</label>
                        <textarea class="form-control" rows="5" name="content" placeholder="{{ sc_language_render('contact.content') }}">{{ old('content') }}</textarea>
                    </div>
                </div>
                {!! $viewCaptcha?? '' !!}
                <div class="text-center">
                    <button type="submit" class="btn" style="background-color: #F5A623; color: white;">{{ sc_language_render('action.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection

<style>
    h4 {
    text-transform: none !important;
    }

    .lokasi-heading {
        font-family: 'Poppins', sans-serif;
        color: #0074A8;
        font-size: 1.1rem; /* Ukuran font sedikit lebih kecil */
        text-align: center;
    }

    .banner-contact {
        position: relative;
        width: 100%;
        height: 400px;
        background: url("{{ asset('data/banner/banner-contact.png') }}") no-repeat center center/cover;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        color: white;
        padding-left: 10%;
    }

    /* Overlay efek untuk latar belakang */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
    }

    /* Konten banner */
    .banner-contact-content {
        position: relative;
        z-index: 1;
        max-width: 600px;
        text-align: left;
    }

    .banner-contact-content h1 {
        font-size: 3rem;
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        margin-bottom: 10px;
        text-transform: none;
        color: #f0f0f0;
    }

    .banner-contact-content p {
        font-size: 1.2rem;
        line-height: 1.5;
        color: #f0f0f0;
    }

    /* Responsif untuk layar tablet */
    @media (max-width: 768px) {
        .contact-form {
            text-align: left;
        }

        .lokasi-heading {
            font-size: 1rem; 
        }

        .banner-contact {
            height: 300px;
            padding-left: 5%;
        }

        .banner-contact-content h1 {
            font-size: 2rem;
        }

        .banner-contact-content p {
            font-size: 1rem;
        }
    }

    /* Responsif untuk layar lebih kecil (HP kecil) */
    @media (max-width: 480px) {
        .banner-contact {
            height: 250px;
            padding-left: 3%;
            justify-content: center;
            text-align: center;
        }

        .banner-contact-content h1 {
            font-size: 1.8rem;
        }

        .banner-contact-content p {
            font-size: 0.9rem;
        }
    }
</style>
