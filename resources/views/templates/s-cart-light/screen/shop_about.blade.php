@php
/*
$layout_page = shop_about
**Variables:**
- $page: no paginate
*/ 
@endphp

@extends($sc_templatePath.'.layout')

@section('block_main')
<section class="banner-contact">
    <div class="overlay"></div>
    <div class="banner-contact-content">
        <h1>Tentang Kami</h1>
        <p>PT. Elementa Media Literasi hadir untuk menyediakan buku cetak dan digital dengan tema beragam dan kekinian. Kami berkomitmen untuk menghadirkan bacaan berkualitas guna memperkaya wawasan dan memenuhi kebutuhan literasi Anda.</p>
    </div>
</section>

<section class="about-us">
    <div class="about-left">
        <h2>PT. Elementa Media Literasi</h2>
        <a href="https://elementa-media.pustakadigital.id/id/shop" target="_blank">TEMUKAN KOLEKSI MENARIK KAMI</a>
        <p>PT. Elementa Media Literasi adalah Distributor dan Penerbitan Buku baik cetak maupun digital (ebook, audiobook, videobook). Imprint Penerbitan yang tergabung dengan kami di antaranya: <strong>PT. Elementa Media Literasi, PT. Elementa Agro Lestari dan CV. Elementa Media</strong>. Penerbitan kami berfokus pada tema-tema menarik yang kekinian untuk menunjang edukasi dan literasi di Indonesia.</p>
    </div>
    <div class="about-right">
        <p>Tulisan yang dibuat cukup tematik, dengan perencanaan konten yang tertuju pada sasaran market sesuai jenjang, baik dari SD, SMP, SMA/SMK hingga Perguruan Tinggi. Saat ini kami banyak menerbitkan buku tentang budidaya, pertanian, peternakan, perkebunan, lingkungan, bisnis, teknologi, keterampilan, cerita anak, pendidikan anak, motivasi dan inspirasi, psikologi, pengembangan diri, pariwisata, serta pengetahuan lainnya.</p>
        <p>Selain menerbitkan buku, kami juga dapat membantu Anda untuk memiliki perpustakaan digital di lingkungan pendidikan Anda sesuai dengan yang Anda inginkan.</p>
    </div>
</section>

<section class="services">
    <div class="container-service">
        <div class="service">
            <i class="fas fa-book"></i>
            <h3>Buku Cetak & Digital</h3>
            <p>Menawarkan koleksi buku fisik dan elektronik dalam berbagai kategori.</p>
        </div>
        <div class="service">
            <i class="fas fa-lightbulb"></i>
            <h3>Tema Beragam & Kekinian</h3>
            <p>Selalu menghadirkan konten yang relevan dan menarik untuk semua usia.</p>
        </div>
        <div class="service">
            <i class="fas fa-star"></i>
            <h3>Kualitas & Inspirasi</h3>
            <p>Setiap buku dipilih dengan cermat untuk memberikan nilai tambah bagi pembaca.</p>
        </div>
        <div class="service">
            <i class="fas fa-user-graduate"></i>
            <h3>Edukasi & Literasi</h3>
            <p>Mendukung perkembangan literasi dengan menyediakan bacaan yang edukatif dan informatif.</p>
        </div>
    </div>
</section>

<section class="team-section">
        <h2 class="team-title" style="color: #0074A8;">Tim Kami</h2>
        <p class="team-subtitle">Di balik setiap produk hebat, ada tim luar biasa yang bekerja keras untuk mewujudkannya. Tim kami terdiri dari para profesional berbakat dengan semangat inovasi, kolaborasi, dan dedikasi tinggi. Kami percaya bahwa kerja sama yang kuat dan kreativitas tanpa batas adalah kunci keberhasilan dalam menciptakan solusi terbaik bagi Anda.</p>
        <div class="team-container">
            <div class="team-member">
                <img src="{{ asset('data/avatar/avatar.png') }}" alt="Irfan Hilmi">
                <h3>Irfan Hilmi</h3>
                <p>Direktur Utama</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="mdi mdi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="mdi mdi-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="mdi mdi-facebook"></i></a>
                </div>
            </div>
            <div class="team-member">
                <img src="{{ asset('data/avatar/avatar.png') }}" alt="Agustin Fadhilah">
                <h3>Agustin Fadhilah</h3>
                <p>Manajer Keuangan</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="mdi mdi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="mdi mdi-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="mdi mdi-facebook"></i></a>
                </div>
            </div>
            <div class="team-member">
                <img src="{{ asset('data/avatar/avatar.png') }}" alt="Sinta Darma Utama">
                <h3>Sinta Darma Utama</h3>
                <p>Manajer Redaksi</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="mdi mdi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="mdi mdi-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="mdi mdi-facebook"></i></a>
                </div>
            </div>
        </div>
    </section>

<section class="subscribe">
    <div class="subscribe-content">
        <h4>Berlangganan Newsletter Kami</h4>
        <p>Dapatkan informasi terbaru tentang koleksi dan promo eksklusif.</p>
    </div>
    <a href="#" class="btn">Berlangganan Sekarang</a>
</section>
@endsection


@push('styles')
{{-- Your css style --}}
<style>
    .container.about-us {
    width: 80%;
    margin: auto;
    text-align: center;
    padding: 50px 0;
    }
    .about-us {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 60px;
        background-color: #ffffff;
        max-width: 1200px;
        margin: auto;
    }
    .about-left, .about-right {
        width: 48%;
        text-align: left;
    }
    .about-left {
        margin-right: 40px;
    }
    .about-left h2 {
        font-family: 'Roboto', sans-serif;
        font-size: 36px;
        color: #0074A8;
        font-weight: bold;
        text-transform: none;
        margin-bottom: 10px;
    }
    .about-left p {
        font-size: 18px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
        margin-top: 20px;
        text-align: justify;
    }
    .about-left a {
        display: inline-block;
        margin-top: 5px;
        padding: 10px 20px;
        background: #F5A623;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }
    .about-left a:hover {
        background: #2575fc;
    }
    .about-right p {
        font-size: 18px;
        color: #666;
        line-height: 1.6;
        text-align: justify;
    }
    .container-service {
        width: 80%;
        margin: auto;
        padding: 50px 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        justify-content: center;
        text-align: center;
    }

    .service {
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .service i {
        font-size: 40px;
        color: #F5A623;
        margin-bottom: 15px;
    }
    .service h3 {
        font-size: 22px;
        color: #0074A8;
        margin-bottom: 10px;
    }
    .service p {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }
    .subscribe {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 50px;
        background: #27a7b2;
        color: white;
        border-radius: 10px;
        max-width: 1200px;
        margin: 50px auto;
    }

    .subscribe-content {
        flex: 1;
        text-align: left;
    }

    .subscribe h4 {
        margin: 0;
        color: #FFFFFF;
        font-family: 'Roboto', sans-serif;
    }

    .subscribe p {
        margin-top: 5px;
    }

    .subscribe .btn {
        padding: 12px 25px;
        background: linear-gradient(45deg, #ff0080, #ff00ff);
        color: white;
        border-radius: 30px;
        text-decoration: none;
        font-weight: bold;
        border: 2px solid transparent;
        transition: 0.3s;
    }

    .subscribe .btn:hover {
        background: transparent;
        border: 2px solid #F5A623;
    }

    h4 {
    text-transform: none !important;
    }
    .banner-contact {
        position: relative;
        width: 100%;
        height: 400px;
        background: url("{{ asset('data/banner/banner-about-us.png') }}") no-repeat center center/cover;
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
    section.team-section {
            padding: 50px 20px;
            text-align: center;
            background-color: #f8f9fa;
            width: 80%;
            justify-content: center;
            margin: auto;
        }
        .team-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            font-family: 'Roboto', sans-serif;
            text-transform: none;
            
        }
        .team-subtitle {
            color: #6c757d;
            margin-bottom: 40px;
            font-family: 'Roboto', sans-serif;
            text-transform: none;
        }
        .team-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            font-family: 'Roboto', sans-serif;
            text-transform: none;
        }
        .team-member {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 250px;
            transition: 0.3s;
            font-family: 'Roboto', sans-serif;
            text-transform: none;
        }
        .team-member:hover {
            background: #27a7b2;
            color: #fff;
        }
        .team-member:hover p {
            color: #f1f1f1;
        }
        .team-member:hover .social-icons a {
            color: #fff;
        }
        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .team-member h3 {
            margin: 10px 0 5px;
            font-size: 20px;
            font-family: 'Roboto', sans-serif;
            text-transform: none;
        }
        .team-member p {
            color: #6c757d;
            margin: 5px 0;
            font-family: 'Roboto', sans-serif;
            text-transform: none;
        }
        .team-member .social-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .team-member .social-icons a {
            text-decoration: none;
            font-size: 24px;
            color: #333;
        }
        .team-member.active {
            background: #6c5ce7;
            color: #fff;
        }
        .team-member.active p {
            color: #ddd;
        }
        .team-member.active .social-icons a {
            color: #fff;
        }
    /* Responsif untuk layar tablet */
    @media (max-width: 768px) {
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
        .about-us {
            flex-direction: column;
            text-align: center;
            padding: 30px;
        }
        .about-left, .about-right {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }
        .about-left {
            margin-right: 0;
        }
        .about-left h2 {
            font-size: 28px;
        }
        .about-left p {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .about-left a {
            display: block;
            margin: 5px auto;
        }
        .subscribe {
            flex-direction: column;
            text-align: center;
        }
        .subscribe-content {
            text-align: center;
            margin-bottom: 20px;
        }
        .team-container {
        flex-direction: column;
        align-items: center;
        }

        .team-member {
            width: 80%;
            max-width: 300px;
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
        .team-member {
        width: 90%;
        }

        .team-member img {
            width: 80px;
            height: 80px;
        }

        .team-member h3 {
            font-size: 18px;
        }

        .team-member p {
            font-size: 14px;
        }

        .team-member .social-icons a {
            font-size: 20px;
        }
    }
</style>
@endpush

@push('scripts')
{{-- //script here --}}
@endpush