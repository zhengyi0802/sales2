
<style>
  p.input {
      margin-left : 20px;
      font-size   : 20px;
  }
  p.title {
      margin-left : 10px;
      font-size   : 20px;
  }
  div.block {
      border           : 1px solid blue;
      border-radius    : 10px;
      margin-top       : 4px;
      margin-bottom    : 4px;
      background-color : white;
  }
  button.submit {
      background-color : #4CAF50; /* Green */
      border           : none;
      color            : white;
      padding          : 15px 32px;
      text-align       : center;
      text-decoration  : none;
      display          : inline-block;
      font-size        : 16px;
  }
  span.must {
      color      : red;
      font-size  : 12px;
  }
  span.noused {
      color      : blue;
      font-size  : 12px;
  }
  .error {
     color       : red;
     margin-left : 10px;
     font-size   : 12px;
  }
  label.error {
     display     : inline;
  }
</style>

<form id="applyForm" name="applyForm" action="{{ route('eapplies.store') }}" method="POST">
    @csrf
    <input type="hidden" id="reseller_id" name="reseller_id" value="{{ ($reseller) ? $reseller->id : 1 }}">
    <div class="row">
            <div>
                <p class="title"><strong>{{ __('eapplies.title') }}</strong></p>
                <p class="input">{{ __('eapplies.reseller') }}:{{ ($reseller) ? $reseller->name : '總公司' }}</p>
            </div>
            <div class="block">
                <p class="title"><strong>{{ __('eapplies.project') }} : <span class="must">{{ __('tables.must') }}</span></strong>
                   <span id="span_oldlock" style="{{ ($reseller_id == 1) ? "display:none" : null }}">
                       <input type="checkbox" id="oldlock" name="oldlock" onChange="checkOldlock(this)" {{ ($oldlock == 1) ? "checked" : null }}>
                       <label for="oldlock">{{ __('eapplies.oldlock') }}</label>
                   </span>
                </p>
                <p class="input">
                   <select id="project_id" name="project_id" onClick="changeProject(this)">
                        <option value="0" > {{ __('eapplies.no_project') }}</option>
                     @foreach($dprojects as $dproject)
                        <option value="{{ $dproject->id }}">{{ $dproject->name }}</option>
                     @endforeach
                   </select>
                </p>
            <script>
                function changeProject(event) {
                    document.getElementById('bPriceField').style.display = '';
                    if (event.value == 4){
                        document.getElementById('bPriceField').style.display = 'none';
                    }
                }
                function checkOldlock(event) {
                    var reseller = document.getElementById('reseller_id').value;

                    if (event.checked) {
                        window.location="https://shops.mdo.tw/eapplies?reseller_id=" + reseller + "&oldlock=1";
                    } else {
                        window.location="https://shops.mdo.tw/eapplies?reseller_id=" + reseller + "&oldlock=0";
                    }
                }
            </script>
            <div class="block" id="div_amount">
                <p class="title"><strong>{{ __('eapplies.doorlock').__('eapplies.amount') }} : <span class="must">{{ __('tables.must') }}</span></strong></p>
                <p class="input"><input type="number" name="amount" class="form-control" value="1" onchange="changeAmount(this)"></p>
            </div>
            <div class="block" id="bundles">
                <p class="title"><strong>{{ __('eapplies.bundles') }}</strong></p>
                <p class="input" id="bPriceField" >{{ __('eapplies.battery').__('eapplies.amount') }} : <span id="bPrice">Z6500(W)電池1800元/個, Z5000W電池2800元/個</span><input type="number" id="b_amount" name="b_amount" class="form-control" value="0"></p>
            </div>
            <script>
                function changeAmount(event) {
                    //document.getElementById('b_amount').value=event.value;
                }
            </script>
            <div class="block">
                <p class="title"><strong>{{ __('eapplies.name') }} : <span class="must">{{ __('tables.must') }}</span></strong></p>
                <p class="input"><input type="text" name="name" class="form-control" value="{{ old('name') }}"></p>
            </div>
            <div class="block">
                <p class="title"><strong>{{ __('eapplies.unified_number') }} : <span class="must">{{ __('tables.must2') }}</span></strong></p>
                <p class="input"><input type="text" name="unified_number" class="form-control" value="{{ old('unified_number') }}"></p>
            </div>
            <div class="block">
                <p class="title"><strong>{{ __('eapplies.phone') }} : <span class="must">{{ __('tables.must') }}</span></strong></p>
                <p class="input"><input type="text" name="phone" class="form-control" value="{{ old('phone') }}"></p>
            </div>
            <div class="block">
                <p class="title"><strong>{{ __('eapplies.email') }} : <span class="must">{{ __('tables.must3') }}</span></strong></p>
                <p class="input"><input type="text" name="email" class="form-control" value="{{ old('email') }}"></p>
            </div>
            <div class="block">
                <p class="title"><strong>{{ __('eapplies.address') }} : <span class="must">{{ __('tables.must') }}</span></strong></p>
                <p class="input"><input type="text" name="address" class="form-control" style="width: 95%;" value="{{  old('address') }}"></p>
            </div>
            <div class="block">
                <p class="title"><strong>{{ __('eapplies.line_id') }} : </strong></p>
                <p class="input"><input type="text" name="line_id" class="form-control" value="{{ old('line_id') }}"></p>
            </div>
            <div class="block">
                <p class="title"><strong>{{ __('eapplies.memo') }} :</strong></p>
                <p class="input"><textarea name="memo" class="form-control" rows="5" value="{{ old('memo') }}"></textarea></p>
            </div>
            <div class="block">
                <p class="title"><strong>{{ __('orders.payment') }} : <span class="must">{{ __('tables.must') }}</span></strong></p>
                <p class="input">
                   <!-- <input type="radio" name="payment" value="1">{{ __('eapplies.payment_tt') }} -->
                   <input type="radio" name="payment" value="2" checked>{{ __('eapplies.payment_credit') }}
                </p>
            </div>
            <p align="center"><button id="submitbutton" class="submit" type="submit" >{{ __('tables.submit') }}</button></p>
    </div>
</form>

<script src="https://lf9-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery/1.12.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/localization/messages_zh.min.js"></script>
<script>
    $(document).ready(function(){
        $('#applyForm').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
               project_id: {
                  min: 1
               },
               unified_number: {
                  required: false,
                  minlength: 8,
                  maxlength: 8
               },
               email: {
                  required: false,
                  email: true
               },
               phone: {
                  required: true,
                  minlength: 10,
                  maxlength: 10
               },
               address: {
                  required: true,
                  minlength: 3
               },
           },
           messages: {
               project_id: {
                  min: '請選擇方案'
               },
               name: {
                  required: '姓名必填'
               },
               unified_number: {
                  minlength: '統一編號固定為8位數字',
                  maxlength: '統一編號固定為8位數字',
               },
               phone: {
                  required: '電話必填',
                  minlength: '電話號碼長度錯誤(10位數字)',
                  maxlength: '電話號碼長度錯誤(10位數字)'
               },
               email: {
                  email: '電子郵件地址格式錯誤',
               },
               address: {
                  required: '地址必須填寫',
                  minlength: '地址填寫錯誤'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
