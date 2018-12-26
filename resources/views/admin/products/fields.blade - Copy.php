<?php $checked = false; ?>
<div class="nav-tabs-custom col-xs-12">

    <ul class="nav nav-tabs">
        <?php $key = 1;
        foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ): ?>
        <li class="{{ $key==1 ? 'active' : '' }}">
            <a href="#tab_{{ $key }}" data-toggle="tab">
                <span class="locale-title"><i class="fa fa-globe" aria-hidden="true"></i> {{ $properties['native'] }}</span>
            </a>
        </li>
        <?php $key++; endforeach; ?>
        <li>
            <a href="#tab_{{ $key }}" data-toggle="tab">
                <span class="locale-title"><i class="fa fa-picture-o" aria-hidden="true"></i> Изображение</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <?php $key = 1;
        foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ): ?>
        <div class="tab-pane {{ $key==1 ? 'active' : '' }}" id="tab_{{ $key }}">

            <div class="form-group col-sm-6">
                {!! Form::label($locale.'[title]', 'Заголовок:') !!}
                {{ Form::text(
                    $locale.'[title]',
                    isset($product) ? $product->translate($locale)->title : null,
                    ['class' => 'form-control'])
                }}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label($locale.'[slug]', 'URL:') !!}
                {{ Form::text(
                    $locale.'[slug]',
                    isset($product) ? $product->translate($locale)->slug : null,
                    ['class' => 'form-control',
                    'disabled' => isset($product) ? null : 'true'])
                }}
            </div>
        </div>
        <!-- /.tab-pane -->
        <?php $key++; endforeach; ?>
        <div class="tab-pane" id="tab_{{ $key }}">
            <div class="form-group col-sm-12">

                {!! Form::label(false, 'Изображение') !!}

                <?php if( isset($product) && $product->featured_image ): ?>
                <div class="file-wrap">
                    {{ Html::image('uploads/product/admin_'.$product->featured_image, false, array('class' => 'img-responsive img-thumbnail')) }}
                </div>
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('clear_image', true, false) !!} Удалить
                    </label>
                </div>
                <?php endif; ?>

                {!! Form::file('featured_image') !!}

            </div>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<div class="nav-tabs-custom col-xs-12">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_base" data-toggle="tab">
                <span class="locale-title"><i class="fa fa-align-center" aria-hidden="true"></i> Основа</span>
            </a>
        </li>
        <li>
            <a href="#tab_cover" data-toggle="tab">
                <span class="locale-title"><i class="fa fa-align-center" aria-hidden="true"></i> Покрытие</span>
            </a>
        </li>
        <li>
            <a href="#tab_cream" data-toggle="tab">
                <span class="locale-title"><i class="fa fa-align-center" aria-hidden="true"></i> Крема и муссы</span>
            </a>
        </li>
        <li>
            <a href="#tab_decor" data-toggle="tab">
                <span class="locale-title"><i class="fa fa-align-center" aria-hidden="true"></i> Оформление</span>
            </a>
        </li>
        <li>
            <a href="#tab_filling" data-toggle="tab">
                <span class="locale-title"><i class="fa fa-align-center" aria-hidden="true"></i> Начинки</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tab_base">
            @foreach ( $baseArray as $i => $itemName )
                <?php if (isset($productBases)) $checked = in_array($i, $productBases) ? true : false; ?>
                <div class="form-group col-sm-3">
                    {!! Form::checkbox( 'base_id[]', $i, $checked,['class' => 'md-check', 'id' => $itemName] ) !!}
                    {!! Form::label($itemName, $itemName) !!}
                </div>
            @endforeach
        </div>
        <div class="tab-pane" id="tab_cover">
            @foreach ( $coverArray as $i => $itemName )
                <?php if (isset($productCovers)) $checked = in_array($i, $productCovers) ? true : false; ?>
                <div class="form-group col-sm-3">
                    {!! Form::checkbox( 'cover_id[]', $i, $checked, ['class' => 'md-check', 'id' => $itemName] ) !!}
                    {!! Form::label($itemName, $itemName) !!}
                </div>
            @endforeach
        </div>
        <div class="tab-pane" id="tab_cream">
            @foreach ( $creamArray as $i => $itemName )
            <?php if (isset($productCreams)) $checked = in_array($i, $productCreams) ? true : false; ?>
                <div class="form-group col-sm-3">
                    {!! Form::checkbox( 'cream_id[]', $i, $checked, ['class' => 'md-check', 'id' => $itemName] ) !!}
                    {!! Form::label($itemName, $itemName) !!}
                </div>
            @endforeach
        </div>
        <div class="tab-pane" id="tab_decor">
            @foreach ( $decorArray as $i => $itemName )
            <?php if (isset($productDecors)) $checked = in_array($i, $productDecors) ? true : false; ?>
                <div class="form-group col-sm-3">
                    {!! Form::checkbox( 'decor_id[]', $i, $checked, ['class' => 'md-check', 'id' => $itemName] ) !!}
                    {!! Form::label($itemName, $itemName) !!}
                </div>
            @endforeach
        </div>
        <div class="tab-pane" id="tab_filling">
            @foreach ( $fillingArray as $i => $itemName )
            <?php if (isset($productFillings)) $checked = in_array($i, $productFillings) ? true : false; ?>
                <div class="form-group col-sm-3">
                    {!! Form::checkbox( 'filling_id[]', $i, $checked, ['class' => 'md-check', 'id' => $itemName] ) !!}
                    {!! Form::label($itemName, $itemName) !!}
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="form-group col-sm-4">
    {!! Form::label('category_id', 'Категория') !!}
    {!! Form::select('category_id', ['' => 'Select'] + $categoriesArray, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('measure_id', 'Ед. измерения') !!}
    {!! Form::select('measure_id', ['' => 'Select'] + $measureArray, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('size_id', 'Размер') !!}
    {!! Form::select('size_id', ['' => 'Select'] + $sizeArray, null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<div class="form-group col-sm-6">
    {!! Form::label('price', 'Цена:') !!}
    <div class="input-group">
        {{ Form::text('price',isset($product) ? $product->price : null,['class' => 'form-control'])}}
        <div class="input-group-addon">cум за</div>
        <div class="input-group-addon adding"></div>
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('min_order', 'Мин заказ:') !!}
    <div class="input-group">
        {{ Form::text('min_order',isset($product) ? $product->min_order : null,['class' => 'form-control'])}}
        <div class="input-group-addon adding"></div>
    </div>
</div>
<div class="clearfix"></div>

<div class="form-group col-sm-12">
    Рекламный 
    <label class="radio-inline">
        {{ Form::radio('is_special', '1' , isset($product->isSpecial) ? true : false) }} Да 
    </label>
    <label class="radio-inline">
        {{ Form::radio('is_special', '0' , isset($product->isSpecial) ? false : true) }} Нет 
    </label>
</div>

<div class="clearfix"></div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function(){ 
            $('#price').prop('disabled', 'disabled');
            $('#min_order').prop('disabled', 'disabled');

            @if (isset($product))
                $('.adding').html($('#measure_id :selected').text());
                $('#price').prop('disabled', false);
                $('#min_order').prop('disabled', false);
            @endif

            $("#measure_id").on("change",function(){
                $('.adding').html($('#measure_id :selected').text());
                $('#price').prop('disabled', false);
                $('#min_order').prop('disabled', false);
            });
            
        });
        var route_prefix = "{{ url('laravel-filemanager') }}";
        var options = {
            filebrowserImageBrowseUrl: route_prefix + '?type=Images',
            filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: route_prefix + '?type=Files',
            filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
        };

        @foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties )
            CKEDITOR.replace('text-editor-{{ $locale  }}', options);
        @endforeach
    </script>
@endsection