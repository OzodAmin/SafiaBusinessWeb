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
    </ul>

    <div class="tab-content">
        <?php $key = 1;
        foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ): ?>
        <div class="tab-pane {{ $key==1 ? 'active' : '' }}" id="tab_{{ $key }}">

            <div class="form-group col-sm-6">
                {!! Form::label($locale.'[title]', 'Заголовок:') !!}
                {{ Form::text(
                    $locale.'[title]',
                    isset($cover) ? $cover->translate($locale)->title : null,
                    ['class' => 'form-control'])
                }}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label($locale.'[slug]', 'URL:') !!}
                {{ Form::text(
                    $locale.'[slug]',
                    isset($cover) ? $cover->translate($locale)->slug : null,
                    ['class' => 'form-control',
                    'disabled' => isset($cover) ? null : 'true'])
                }}
            </div>

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('creams.index') !!}" class="btn btn-default">Cancel</a>
            </div>

        </div>  
        <?php $key++; endforeach; ?>
    </div>
</div>
