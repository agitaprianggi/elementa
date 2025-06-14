@extends($templatePathAdmin.'layout')

@section('main')
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
                <div class="card-header with-border">
                    <h2 class="card-title">{{ $title_description??'' }}</h2>

                    <div class="card-tools">
                        <div class="btn-group float-right mr-5">
                            <a href="{{ sc_route_admin('admin_customer.index') }}" class="btn  btn-flat btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs"> {{ sc_language_render('admin.back_list') }}</span></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"  enctype="multipart/form-data">


                    <div class="card-body">
                        <div class="fields-group">

                            @if (sc_config_admin('customer_lastname'))
                            <div class="form-group row {{ $errors->has('first_name') ? ' text-red' : '' }}">
                                <label for="first_name"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.first_name') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="first_name" type="text" class="form-control" name="first_name" 
                                        value="{{ (old('first_name', $customer['first_name'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('first_name'))
                                    <span class="form-text">{{ $errors->first('first_name') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('last_name') ? ' text-red' : '' }}">
                                <label for="last_name"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.last_name') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="last_name" type="text" class="form-control" name="last_name" 
                                        value="{{ (old('last_name', $customer['last_name'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('last_name'))
                                    <span class="form-text">{{ $errors->first('last_name') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            @else
                            <div class="form-group row {{ $errors->has('first_name') ? ' text-red' : '' }}">
                                <label for="first_name"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.name') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="first_name" type="text" class="form-control" name="first_name" 
                                        value="{{ (old('first_name', $customer['first_name'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('first_name'))
                                    <span class="form-text">{{ $errors->first('first_name') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            @endif
    
                            @if (sc_config_admin('customer_name_kana'))
                            <div class="form-group row {{ $errors->has('first_name_kana') ? ' text-red' : '' }}">
                                <label for="first_name_kana"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.first_name_kana') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="first_name_kana" type="text" class="form-control" name="first_name_kana"
                                        value="{{ (old('first_name_kana', $customer['first_name_kana'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('first_name_kana'))
                                    <span class="form-text">{{ $errors->first('first_name_kana') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('last_name_kana') ? ' text-red' : '' }}">
                                <label for="last_name_kana"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.last_name_kana') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="last_name_kana" type="text" class="form-control" name="last_name_kana"
                                        value="{{ (old('last_name_kana', $customer['last_name_kana'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('last_name_kana'))
                                    <span class="form-text">{{ $errors->first('last_name_kana') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            @endif
    
                            @if (sc_config_admin('customer_phone'))
                            <div class="form-group row {{ $errors->has('phone') ? ' text-red' : '' }}">
                                <label for="phone"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.phone') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="phone" type="text" class="form-control" name="phone" 
                                        value="{{ (old('phone', $customer['phone'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('phone'))
                                    <span class="form-text">{{ $errors->first('phone') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            @endif
    
                            <div class="form-group row {{ $errors->has('email') ? ' text-red' : '' }}">
                                <label for="email"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.email') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="email" type="text" class="form-control" name="email" 
                                        value="{{ (old('email',$customer['email'] ?? ''))}}">
                                    </div>
    
                                    @if($errors->has('email'))
                                    <span class="form-text">{{ $errors->first('email') }}</span>
                                    @endif
    
                                </div>
                            </div>
    
                            <!-- <div class="form-group row {{ $errors->has('address1') ? ' text-red' : '' }}">
                                <label for="address1"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.address1') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="address1" type="text" class="form-control" name="address1" 
                                        value="{{ (old('address1', $customer['address1'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('address1'))
                                    <span class="form-text">{{ $errors->first('address1') }}</span>
                                    @endif
    
                                </div>
                            </div> -->

                            <div class="form-group row {{ $errors->has('address1') ? ' text-red' : '' }}">
                                <label for="address1" 
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.address1') }}</label>

                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <textarea id="address1" class="form-control" name="address1" required>{{ old('address1', $customer['address1'] ?? '') }}</textarea>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary">Cari</button>
                                        </div>
                                    </div>

                                    @if($errors->has('address1'))
                                    <span class="help-block">{{ $errors->first('address1') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group d-none">
                                <input type="hidden" name="id_addr" value="{{ old('id_addr') }}">
                            </div>

                            @if (sc_config('customer_province'))
                            <div class="form-group row {{ $errors->has('province') ? ' has-error' : '' }}">
                                <label for="province"
                                    class="col-sm-2 col-form-label">Provinsi</label>

                                <div class="col-sm-8">
                                    <input id="province" type="text" class="form-control" name="province" required
                                        value="{{ (old('province'))?old('province'):$customer['province']}}" readonly>

                                    @if($errors->has('province'))
                                    <span class="help-block">{{ $errors->first('province') }}</span>
                                    @endif

                                </div>
                            </div>
                            @endif

                            @if (sc_config('customer_regency'))
                            <div class="form-group row {{ $errors->has('regency') ? ' has-error' : '' }}">
                                <label for="regency"
                                    class="col-sm-2 col-form-label">Kabupaten</label>

                                <div class="col-sm-8">
                                    <input id="regency" type="text" class="form-control" name="regency" required
                                        value="{{ (old('regency'))?old('regency'):$customer['regency']}}" readonly>

                                    @if($errors->has('regency'))
                                    <span class="help-block">{{ $errors->first('regency') }}</span>
                                    @endif

                                </div>
                            </div>
                            @endif

                            @if (sc_config('customer_district'))
                            <div class="form-group row {{ $errors->has('district') ? ' has-error' : '' }}">
                                <label for="district"
                                    class="col-sm-2 col-form-label">Kecamatan</label>

                                <div class="col-sm-8">
                                    <input id="district" type="text" class="form-control" name="district" required
                                        value="{{ (old('district'))?old('district'):$customer['district']}}" readonly>

                                    @if($errors->has('district'))
                                    <span class="help-block">{{ $errors->first('district') }}</span>
                                    @endif

                                </div>
                            </div>
                            @endif

                            @if (sc_config('customer_subdistrict'))
                            <div class="form-group row {{ $errors->has('subdistrict') ? ' has-error' : '' }}">
                                <label for="subdistrict"
                                    class="col-sm-2 col-form-label">Kelurahan</label>

                                <div class="col-sm-8">
                                    <input id="subdistrict" type="text" class="form-control" name="subdistrict" required
                                        value="{{ (old('subdistrict'))?old('subdistrict'):$customer['subdistrict']}}" readonly>

                                    @if($errors->has('subdistrict'))
                                    <span class="help-block">{{ $errors->first('subdistrict') }}</span>
                                    @endif

                                </div>
                            </div>
                            @endif

                            @if (sc_config('customer_postcode'))
                            <div class="form-group row {{ $errors->has('postcode') ? ' has-error' : '' }}">
                                <label for="postcode"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.postcode') }}</label>

                                <div class="col-sm-8">
                                    <input id="postcode" type="text" class="form-control" name="postcode" required
                                        value="{{ (old('postcode'))?old('postcode'):$customer['postcode']}}" readonly>

                                    @if($errors->has('postcode'))
                                    <span class="help-block">{{ $errors->first('postcode') }}</span>
                                    @endif

                                </div>
                            </div>
                            @endif

                            @if (sc_config_admin('customer_address2'))
                            <div class="form-group row {{ $errors->has('address2') ? ' text-red' : '' }}">
                                <label for="address2"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.address2') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="address2" type="text" class="form-control" name="address2" 
                                        value="{{ (old('address2', $customer['address2'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('address2'))
                                    <span class="form-text">{{ $errors->first('address2') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            @endif
    
                            @if (sc_config_admin('customer_address3'))
                            <div class="form-group row {{ $errors->has('address3') ? ' text-red' : '' }}">
                                <label for="address3"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.address3') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="address3" type="text" class="form-control" name="address3" 
                                        value="{{ (old('address3', $customer['address3'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('address3'))
                                    <span class="form-text">{{ $errors->first('address3') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            @endif

    
                            @if (sc_config_admin('customer_country'))
                            @php
                            $country = old('country', $customer['country'] ?? '');
                            @endphp
    
                            <div class="form-group row {{ $errors->has('country') ? ' text-red' : '' }}">
                                <label for="country"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.country') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control country" style="width: 100%;" name="country">
                                        <option>__{{ sc_language_render('customer.country') }}__</option>
                                        @foreach ($countries as $k => $v)
                                        <option value="{{ $k }}" {{ ($country == $k) ? 'selected':'' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                    <span class="form-text">
                                        {{ $errors->first('country') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endif
    
                            @if (sc_config_admin('customer_sex'))
                            @php
                            $sex = old('sex', $customer['sex'] ?? 0);
                            @endphp
                            <div class="form-group{{ $errors->has('sex') ? ' text-red' : '' }}">
                                <label
                                    class="col-sm-2 validate account_input {{ ($errors->has('sex'))?"input-error":"" }}">{{ sc_language_render('customer.sex') }}:
                                </label>
                                <div class="col-sm-8">
                                <label class="radio-inline"><input value="0" type="radio" name="sex"
                                        {{ ($sex == 0)?'checked':'' }}> {{ sc_language_render('customer.sex_women') }}</label>
                                <label class="radio-inline"><input value="1" type="radio" name="sex"
                                        {{ ($sex == 1)?'checked':'' }}> {{ sc_language_render('customer.sex_men') }}</label>
                                </div>
                                @if ($errors->has('sex'))
                                <span class="form-text">
                                    {{ $errors->first('sex') }}
                                </span>
                                @endif
                            </div>
                            @endif
    
                            @if (sc_config_admin('customer_birthday'))
                            <div class="form-group row {{ $errors->has('birthday') ? ' text-red' : '' }}">
                                <label for="birthday"
                                    class="col-sm-2 col-form-label">
                                    {{ sc_language_render('customer.birthday') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input type="text" id="birthday" class="form-control date_time" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                        name="birthday" 
                                        value="{{ (old('birthday', $customer['birthday'] ?? ''))}}">
                                    </div>
                                    @if($errors->has('birthday'))
                                    <span class="form-text">{{ $errors->first('birthday') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            @endif

                            @if (sc_config_admin('customer_group'))
                            <div class="form-group row {{ $errors->has('group') ? ' text-red' : '' }}">
                                <label for="group"
                                    class="col-sm-2 col-form-label">{{ sc_language_render('customer.group') }}</label>
    
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                    <input id="group" type="number" class="form-control" name="group" 
                                        value="{{ (old('group', $customer['group'] ?? ''))}}">
                                    </div>
    
                                    @if($errors->has('group'))
                                    <span class="form-text">{{ $errors->first('group') }}</span>
                                    @endif
    
                                </div>
                            </div>
                            @endif


                            <div class="form-group  row {{ $errors->has('password') ? ' text-red' : '' }}">
                                <label for="password" class="col-sm-2  col-form-label">{{ sc_language_render('customer.password') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input type="text"   id="password" name="password" value="{{ old('password')??'' }}" class="form-control password" placeholder="" />
                                    </div>
                                        @if ($errors->has('password'))
                                            <span class="form-text">
                                                <i class="fa fa-info-circle"></i> {{ $errors->first('password') }}
                                            </span>
                                        @else
                                            @if ($customer)
                                                <span class="form-text">
                                                     {!! sc_language_render('customer.admin.keep_password') !!}
                                                 </span>
                                            @endif
                                        @endif
                                </div>
                            </div>
                            
                            @if ($customer['provider'])
                            <div class="form-group  row">
                                <label for="status" class="col-sm-2  col-form-label">{{ sc_language_render('customer.admin.provider') }}</label>
                                <div class="col-sm-8">
                                    {{ $customer['provider'] }}
                                </div>
                            </div>
                            @endif


                            <div class="form-group  row">
                                <label for="status" class="col-sm-2  col-form-label">{{ sc_language_render('customer.status') }}</label>
                                <div class="col-sm-8">
                                    <input class="checkbox" type="checkbox" name="status"  {{ old('status',(empty($customer['status'])?0:1))?'checked':''}}>

                                </div>
                            </div>


                            {{-- Custom fields --}}
                            @php
                                $customFields = isset($customFields) ? $customFields : [];
                                $fields = !empty($customer) ? $customer->getCustomFields() : [];
                            @endphp
                            @includeIf($templatePathAdmin.'component.render_form_custom_field', ['customFields' => $customFields, 'fields' => $fields])
                            {{-- //Custom fields --}}

                        </div>
                    </div>



                    <!-- /.card-body -->

                    <div class="card-footer row">
                        @csrf
                        <div class="col-md-2">
                        </div>
    
                        <div class="col-md-8">
                            <div class="btn-group float-right">
                                <button type="submit" class="btn btn-primary">{{ sc_language_render('action.submit') }}</button>
                            </div>
    
                            <div class="btn-group float-left">
                                <button type="reset" class="btn btn-warning">{{ sc_language_render('action.reset') }}</button>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-footer -->
                </form>

            </div>

            <!-- <div class="card">
                @if (!empty($addresses))
                    <div class="card-header with-border">
                        <h2 class="card-title">{{ sc_language_render('customer.address_list') }}</h2>
                    </div>
                    @foreach($addresses as $address)
                        <div class="list">
                        @if (sc_config_admin('customer_lastname'))
                        <b>{{ sc_language_render('customer.first_name') }}:</b> {{ $address['first_name'] }}<br>
                        <b>{{ sc_language_render('customer.last_name') }}:</b> {{ $address['last_name'] }}<br>
                        @else
                        <b>{{ sc_language_render('customer.name') }}:</b> {{ $address['first_name'] }}<br>
                        @endif
                        
                        @if (sc_config_admin('customer_phone'))
                        <b>{{ sc_language_render('customer.phone') }}:</b> {{ $address['phone'] }}<br>
                        @endif
            
                        @if (sc_config_admin('customer_postcode'))
                        <b>{{ sc_language_render('customer.postcode') }}:</b> {{ $address['postcode'] }}<br>
                        @endif

                        <b>{{ sc_language_render('customer.address1') }}:</b> {{ $address['address1'] }}<br>
                        
                        @if (sc_config_admin('customer_address2'))
                        <b>{{ sc_language_render('customer.address2') }}:</b> {{ $address['address2'] }}<br>
                        @endif
            
                        @if (sc_config_admin('customer_address3'))
                        <b>{{ sc_language_render('customer.address3') }}:</b> {{ $address['address3'] }}<br>
                        @endif

                        @if (sc_config_admin('customer_country'))
                        <b>{{ sc_language_render('customer.country') }}:</b> {{ $countries[$address['country']] ?? $address['country'] }}<br>
                        @endif
            
                        <span class="btn">
                            <a title="{{ sc_language_render('customer.addresses.edit') }}" href="{{ sc_route_admin('admin_customer.update_address', ['id' => $address->id]) }}"><i class="fa fa-edit"></i></a>
                        </span>
                        <span class="btn">
                            <a href="#" title="{{ sc_language_render('customer.addresses.delete') }}" class="delete-address" data-id="{{ $address->id }}"><i class="fa fa-trash"></i></a>
                        </span>
                        @if ($address->id == $customer['address_id'])
                        <span class="btn" title="{{ sc_language_render('customer.addresses.default') }}"><i class="fa fa-university" aria-hidden="true"></i></span>
                        @endif
                        </div>
                    @endforeach
                @endif
            </div> -->


        </div>
    </div>
@endsection

@push('styles')
<style>
    .list{
        padding: 5px;
        margin: 5px;
        border-bottom: 1px solid #dcc1c1;
    }
</style>
@endpush

@push('scripts')

<script>
    $('.delete-address').click(function(){
      var r = confirm("{{ sc_language_render('customer.confirm_delete') }}");
      if(!r) {
        return;
      }
      var id = $(this).data('id');
      $.ajax({
              url:'{{ route("admin_customer.delete_address") }}',
              type:'POST',
              dataType:'json',
              data:{id:id,"_token": "{{ csrf_token() }}"},
                  beforeSend: function(){
                  $('#loading').show();
              },
              success: function(data){
                if(data.error == 0) {
                  location.reload();
                }
              }
          });
    });
    
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

@endpush
