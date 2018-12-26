@section('css')
    <link rel="stylesheet" href="{{ asset('datePicker/css/bootstrap-datepicker3.css') }}">
@endsection
<div class="nav-tabs-custom col-sm-12">
    <div class="form-group col-sm-12">
        {!! Form::label('name', 'Ф.И.О:') !!}
        {{ Form::text('name', isset($user) ? $user->name : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-12">
        {!! Form::label('companyName', 'Название заведения') !!}
        {{ Form::text('companyName', isset($user) ? $user->companyName : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-12">
        {!! Form::label('legal_name', 'Юридическое название организации') !!}
        {{ Form::text('legal_name', isset($user) ? $user->legal_name : null, ['class' => 'form-control']) }}
    </div>
        
    <div class="clearfix"></div>

    <div class="form-group col-sm-12">
        {!! Form::label('address', 'Адрес') !!}
        {{ Form::text('address', isset($user) ? $user->address : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-12">
        {!! Form::label('email', 'Email') !!}
        {{ Form::text('email', isset($user) ? $user->email : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-4">
        {!! Form::label('phone', 'Phone number (xx) xxx-xxxx') !!}
        {{ Form::text('phone', isset($user) ? $user->phone : null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('mobile', 'Mobile phone number (xx) xxx-xxxx') !!}
        {{ Form::text('mobile', isset($user) ? $user->mobile : null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('sex', 'Пол') !!}
        {!! Form::select('sex', $sexArray, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('discount', 'Скидка') !!}
        <div class="input-group">
            <div class="input-group-addon">На</div>
            {{ Form::text('discount', isset($user) ? $user->discount : null, ['class' => 'form-control']) }}
            <div class="input-group-addon">%</div>
        </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="form-group col-sm-6">
        {!! Form::label('cityId', 'City') !!}
        {!! Form::select('cityId', ['' => 'Select'] + $citiesArray, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('districtId', 'District') !!}
        <select class="form-control" id="districtId" name="districtId"></select>
    </div>
    
    <div class="clearfix"></div>

    <div class="form-group col-sm-6" id="datePicker">
        {!! Form::label('dob', 'Date of birth') !!}
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
            {!! Form::text('dob', isset($user) ? $user->dob : null, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
    </div>
    
</div>

@section('scripts')
    <script src="{{ asset('datePicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('datePicker/locales/bootstrap-datepicker.ru.min.js') }}"></script>
    <script type="text/javascript">
        const isNumericInput = (event) => {
            const key = event.keyCode;
            return ((key >= 48 && key <= 57) || (key >= 96 && key <= 105));   
        };

        const isModifierKey = (event) => {
            const key = event.keyCode;
            return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
                (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
                (key > 36 && key < 41) || // Allow left, up, right, down
                (
                    // Allow Ctrl/Command + A,C,V,X,Z
                    (event.ctrlKey === true || event.metaKey === true) &&
                    (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
                )
        };

        const enforceFormat = (event) => {
            if(!isNumericInput(event) && !isModifierKey(event)){
                event.preventDefault();
            }
        };

        const formatToPhone = (event) => {
            if(isModifierKey(event)) {return;}

            const target = event.target;
            const input = event.target.value.replace(/\D/g,'').substring(0,9);
            const zip = input.substring(0,2);
            const middle = input.substring(2,5);
            const last = input.substring(5,9);

            if(input.length > 5){target.value = `(${zip}) ${middle} - ${last}`;}
            else if(input.length > 2){target.value = `(${zip}) ${middle}`;}
            else if(input.length > 0){target.value = `(${zip}`;}
        };

        const phoneNumber = document.getElementById('phone');
        phoneNumber.addEventListener('keydown',enforceFormat);
        phoneNumber.addEventListener('keyup',formatToPhone);

        const mobilePhone = document.getElementById('mobile');
        mobilePhone.addEventListener('keydown',enforceFormat);
        mobilePhone.addEventListener('keyup',formatToPhone);

        $('#datePicker').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            language: "ru"
        });

        <?php
            if (isset($user)) {
        ?>

        $("#districtId").
            append("<option value='<?= $user->district->id; ?>'><?= $user->district->title; ?></option>");

        <?php }?>

        $('#cityId').on('change',function(){
            var cityId = $(this).val();    
            if(cityId){
                //clear dropdown list
                var select = document.getElementById("districtId");
                var length = select.options.length;
                for (var i = 0; i < length; i++) {
                  select.options[i] = null;
                }
                $.ajax({
                   type:"GET",
                   url:"{{url('backend/api/getDistricts')}}?city_id="+cityId,
                   success:function(res){               
                        if(res){
                            $('#districtId').prop('disabled', false);
                            $.each(res,function(key,value){
                                $("#districtId").
                                    append('<option value="'+value['id']+'">'+value['title']+'</option>');
                            });
                       
                        }
                    }
                });
            }    
        });

        $('#districtId').prop('disabled', 'disabled');

    </script>
@endsection