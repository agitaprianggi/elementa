@php
/*
$layout_page = shop_order_success
**Variables:**
- $orderInfo
*/
@endphp

@extends($sc_templatePath.'.layout')

@section('block_main_content_center')
<h6 class="aside-title">{{ $title }}</h6>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-success container-inv">
            <div class="timer" id="countdown">{{ session('expired_date') }}</div>
            <h2 class="h2">{{ sc_language_render('checkout.order_success_menunggu_pembayaran') }}</h2>
            <p class="p">{{ sc_language_render('checkout.order_settlement') }}</p>

            <div class="box">
                <label>{{ sc_language_render('checkout.order_success_va_number1') }}</label>
                <span class="value">{{ session('va_number') }}</span>
                <button class="copy-btn" onclick="copyToClipboard('{{ session('va_number') }}')">{{ sc_language_render('checkout.salin') }}</button>
            </div>

            <div class="box">
                <label>{{ sc_language_render('checkout.order_success_order_info1') }}</label>
                <span class="value">{{ session('orderID') }}</span>
                <button class="copy-btn" onclick="copyToClipboard('{{ session('orderID') }}')">{{ sc_language_render('checkout.salin') }}</button>
            </div>

            <div class="box">
                <label>{{ sc_language_render('checkout.order_success_metode') }}</label>
                <span class="value"><img src="{{ sc_file('Plugins/Payment/BankTransfer/images/' . session('payment_metode') . '.png') }}" height="50px" width="50px" class="img-fluid bank-img">
                </span>
            </div>

            <div class="box">
                <label>Selamat Anda Telah Membeli Buku Digital {{ session('qty') }} Copy, Akan Diaktifkan di Aplikasi Perpustakaan Digital Kampus/Sekolah/Instansi Anda</label>
            </div>

            <div class="total">{{ sc_language_render('checkout.order_success_total') }} : {{ session('total_order') }}</div>
        </div>
    </div>
</div>
@endsection


@push('styles')
{{-- Your css style --}}
<style>
    .container-inv {
      max-width: 400px;
      margin: 50px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      padding: 30px 20px;
      text-align: center;
    }
    .timer {
      font-size: 28px;
      font-weight: bold;
      color: #2b2b2b;
    }
    .h2 {
      margin-top: 10px;
      font-size: 23px;
      font-weight: bold;
      color: #333;
    }
    .h3 {
      margin-top: 10px;
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }
    .p {
      color: #666;
      font-size: 14px;
      margin-bottom: 20px;
    }
    .check-status {
      color: #1976d2;
      font-weight: 500;
      font-size: 14px;
      margin-bottom: 20px;
      display: inline-block;
      text-decoration: none;
    }
    .box {
      background: #f4f6f8;
      border-radius: 8px;
      padding: 15px;
      text-align: left;
      margin-bottom: 10px;
      position: relative;
    }
    .box label {
      font-size: 12px;
      color: #777;
      display: block;
      margin-bottom: 5px;
    }
    .box .value {
      font-size: 16px;
      font-weight: 600;
      color: #222;
    }
    .copy-btn {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: #e1ecf9;
      color: #007bff;
      padding: 5px 10px;
      font-size: 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .link-btn {
      background: none;
      border: none;
      color: #1976d2;
      font-size: 14px;
      text-align: left;
      padding: 0;
      cursor: pointer;
      margin: 10px 0;
    }
    .total {
      font-size: 18px;
      font-weight: bold;
      margin-top: 15px;
      color: #000;
    }
  </style>
@endpush

@push('scripts')
{{-- //script here --}}
<script>
  function copyToClipboard(text) {
    navigator.clipboard.writeText(text);
    alert("Disalin: " + text);
  }

  const expiredDate = new Date("{{ \Carbon\Carbon::parse(session('expired_date'))->toIso8601String() }}");

  function updateCountdown() {
    const now = new Date();
    const diff = expiredDate - now;

    if (diff <= 0) {
      document.getElementById("countdown").textContent = "00:00:00";
      clearInterval(timer);
      return;
    }

    const totalSeconds = Math.floor(diff / 1000);
    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;

    document.getElementById("countdown").textContent =
      `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
  }

  const timer = setInterval(updateCountdown, 1000);
  updateCountdown();
</script>
@endpush
