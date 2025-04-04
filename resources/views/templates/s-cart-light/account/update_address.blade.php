@php
/*
$layout_page = shop_profile
** Variables:**
- $customer
- $countries
- $address
*/ 
@endphp

@extends($sc_templatePath.'.account.layout')
@section('block_main_profile')
    <h3 class="title-store">{{ $title }}</h3>
        <form method="POST" action="{{ sc_route('customer.post_update_address', ['id' => $address->id]) }}">
            @csrf
            @if (sc_config('customer_lastname'))
            <div class="form-group row {{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.first_name') }}</label>

                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control" name="first_name" required
                        value="{{ (old('first_name'))?old('first_name'):$address['first_name']}}">

                    @if($errors->has('first_name'))
                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                    @endif

                </div>
            </div>
            <div class="form-group row {{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.last_name') }}</label>

                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control" name="last_name" required
                        value="{{ (old('last_name'))?old('last_name'):$address['last_name']}}">

                    @if($errors->has('last_name'))
                    <span class="help-block">{{ $errors->first('last_name') }}</span>
                    @endif

                </div>
            </div>
            @else
            <div class="form-group row {{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.name') }}</label>

                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control" name="first_name" required
                        value="{{ (old('first_name'))?old('first_name'):$address['first_name']}}">

                    @if($errors->has('first_name'))
                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                    @endif

                </div>
            </div>
            @endif


            @if (sc_config('customer_phone'))
            <div class="form-group row {{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.phone') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone" required
                        value="{{ (old('phone'))?old('phone'):$address['phone']}}">

                    @if($errors->has('phone'))
                    <span class="help-block">{{ $errors->first('phone') }}</span>
                    @endif

                </div>
            </div>
            @endif


            <div class="form-group row {{ $errors->has('address1') ? ' has-error' : '' }}">
                <label for="address1" class="col-md-4 col-form-label text-md-right">
                    {{ sc_language_render('customer.address1') }}
                </label>

                <div class="col-md-6">
                    <div class="input-group">
                        <textarea id="address1" class="form-control" name="address1" required>{{ old('address1', $address['address1'] ?? '') }}</textarea>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary">Cari</button>
                        </div>
                    </div>

                    @if($errors->has('address1'))
                    <span class="help-block">{{ $errors->first('address1') }}</span>
                    @endif
                </div>
            </div>


            @if (sc_config('customer_address2'))
            <div class="form-group row {{ $errors->has('address2') ? ' has-error' : '' }}">
                <label for="address2"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.address2') }}</label>
                <div class="col-md-6">
                    <input id="address2" type="text" class="form-control" name="address2" required
                        value="{{ (old('address2'))?old('address2'):$address['address2']}}">

                    @if($errors->has('address2'))
                    <span class="help-block">{{ $errors->first('address2') }}</span>
                    @endif

                </div>
            </div>
            @endif

            @if (sc_config('customer_address3'))
            <div class="form-group row {{ $errors->has('address3') ? ' has-error' : '' }}">
                <label for="address3"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.address3') }}</label>
                <div class="col-md-6">
                    <input id="address3" type="text" class="form-control" name="address3" required
                        value="{{ (old('address3'))?old('address3'):$address['address3']}}">

                    @if($errors->has('address3'))
                    <span class="help-block">{{ $errors->first('address3') }}</span>
                    @endif

                </div>
            </div>
            @endif            

            <div class="form-group d-none">
                <input type="hidden" name="id_addr" value="{{ old('id_addr') }}">
            </div>

            @if (sc_config('customer_province'))
            <div class="form-group row {{ $errors->has('province') ? ' has-error' : '' }}">
                <label for="province"
                    class="col-md-4 col-form-label text-md-right">Provinsi</label>

                <div class="col-md-6">
                    <input id="province" type="text" class="form-control" name="province" required
                        value="{{ (old('province'))?old('province'):$address['province']}}" readonly>

                    @if($errors->has('province'))
                    <span class="help-block">{{ $errors->first('province') }}</span>
                    @endif

                </div>
            </div>
            @endif

            @if (sc_config('customer_regency'))
            <div class="form-group row {{ $errors->has('regency') ? ' has-error' : '' }}">
                <label for="regency"
                    class="col-md-4 col-form-label text-md-right">Kabupaten</label>

                <div class="col-md-6">
                    <input id="regency" type="text" class="form-control" name="regency" required
                        value="{{ (old('regency'))?old('regency'):$address['regency']}}" readonly>

                    @if($errors->has('regency'))
                    <span class="help-block">{{ $errors->first('regency') }}</span>
                    @endif

                </div>
            </div>
            @endif

            @if (sc_config('customer_district'))
            <div class="form-group row {{ $errors->has('district') ? ' has-error' : '' }}">
                <label for="district"
                    class="col-md-4 col-form-label text-md-right">Kecamatan</label>

                <div class="col-md-6">
                    <input id="district" type="text" class="form-control" name="district" required
                        value="{{ (old('district'))?old('district'):$address['district']}}" readonly>

                    @if($errors->has('district'))
                    <span class="help-block">{{ $errors->first('district') }}</span>
                    @endif

                </div>
            </div>
            @endif

            @if (sc_config('customer_subdistrict'))
            <div class="form-group row {{ $errors->has('subdistrict') ? ' has-error' : '' }}">
                <label for="subdistrict"
                    class="col-md-4 col-form-label text-md-right">Kelurahan</label>

                <div class="col-md-6">
                    <input id="subdistrict" type="text" class="form-control" name="subdistrict" required
                        value="{{ (old('subdistrict'))?old('subdistrict'):$address['subdistrict']}}" readonly>

                    @if($errors->has('subdistrict'))
                    <span class="help-block">{{ $errors->first('subdistrict') }}</span>
                    @endif

                </div>
            </div>
            @endif

            @if (sc_config('customer_postcode'))
            <div class="form-group row {{ $errors->has('postcode') ? ' has-error' : '' }}">
                <label for="postcode"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.postcode') }}</label>

                <div class="col-md-6">
                    <input id="postcode" type="text" class="form-control" name="postcode" required
                        value="{{ (old('postcode'))?old('postcode'):$address['postcode']}}" readonly>

                    @if($errors->has('postcode'))
                    <span class="help-block">{{ $errors->first('postcode') }}</span>
                    @endif

                </div>
            </div>
            @endif


            @if (sc_config('customer_country'))
            @php
            $country = (old('country'))?old('country'):$address['country'];
            @endphp

            <div class="form-group row {{ $errors->has('country') ? ' has-error' : '' }}">
                <label for="country"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.country') }}</label>
                <div class="col-md-6">
                    <select class="form-control country" style="width: 100%;" name="country">
                        <option>__{{ sc_language_render('customer.country') }}__</option>
                        @foreach ($countries as $k => $v)
                        <option value="{{ $k }}" {{ ($country ==$k) ? 'selected':'' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('country'))
                    <span class="help-block">
                        {{ $errors->first('country') }}
                    </span>
                    @endif
                </div>
            </div>
            @endif

            @if ($address->id != $customer->address_id)
            <div class="form-group row">
                <label for="default"
                    class="col-md-4 col-form-label text-md-right">{{ sc_language_render('customer.address_set_default') }}</label>
                <div class="col-md-6">
                    <input id="default" type="checkbox" class="form-control" name="default">
                </div>
            </div>
            @endif

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    @php
                    $dataButton = [
                            'class' => '', 
                            'id' =>  '',
                            'type_w' => '',
                            'type_t' => 'buy',
                            'type_a' => '',
                            'type' => 'submit',
                            'name' => ''.sc_language_render('customer.update_infomation'),
                            'html' => ''
                        ];
                    @endphp
                    @include($sc_templatePath.'.common.button.button', $dataButton)
                </div>
            </div>
        </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchButton = document.querySelector(".btn-primary");
            const loadingSpinner = document.createElement("div");
            loadingSpinner.classList.add("loading-spinner");
            searchButton.appendChild(loadingSpinner);
            
            searchButton.addEventListener("click", function () {
                let address = document.querySelector("textarea[name='address1']").value.trim();
                if (!address) {
                    alert("Silakan masukkan alamat terlebih dahulu");
                    return;
                }
                
                let searchQuery = encodeURIComponent(address);
                loadingSpinner.style.display = "inline-block";
                fetch(`/search-address?search=${searchQuery}`)
                    .then(response => response.json())
                    .then(data => {
                        loadingSpinner.style.display = "none";
                        if (data.data && data.data.length > 0) {
                            let popupContent = `<div class='popup-container' id='popup'>`;
                            data.data.forEach(item => {
                                popupContent += `<p class='popup-item' data-id_addr='${item.id}' data-province='${item.province_name}' data-regency='${item.city_name}' data-district='${item.district_name}' data-subdistrict='${item.subdistrict_name}' data-zip='${item.zip_code}'>${item.label}</p>`;
                            });
                            popupContent += "<button class='popup-close' onclick='document.getElementById(\"popup\").remove()'>Close</button></div>";
                            document.body.insertAdjacentHTML("beforeend", popupContent);
                            
                            document.querySelectorAll(".popup-item").forEach(item => {
                                item.addEventListener("click", function () {
                                    document.querySelector("input[name='id_addr']").value = this.dataset.id_addr;
                                    document.querySelector("input[name='province']").value = this.dataset.province;
                                    document.querySelector("input[name='regency']").value = this.dataset.regency;
                                    document.querySelector("input[name='district']").value = this.dataset.district;
                                    document.querySelector("input[name='subdistrict']").value = this.dataset.subdistrict;
                                    document.querySelector("input[name='postcode']").value = this.dataset.zip;
                                    document.getElementById("popup").remove();
                                });
                            });
                        } else {
                            alert("Data tidak ditemukan.");
                        }
                    })
                    .catch(error => {
                        loadingSpinner.style.display = "none";
                        console.error("Error fetching data:", error);
                        alert("Terjadi kesalahan saat mengambil data.");
                    });
            });
        });
    </script>

    <style>
        .popup-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            z-index: 1000;
            width: 400px;
            max-height: 300px;
            overflow-y: auto;
            text-align: center;
        }
        .popup-item {
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .popup-item:hover {
            background-color: #f0f0f0;
        }
        .popup-close {
            margin-top: 10px;
            padding: 5px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endsection