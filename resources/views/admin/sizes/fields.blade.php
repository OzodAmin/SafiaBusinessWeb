<div class="nav-tabs-custom col-xs-12">
    <div class="form-group col-sm-6">
        {!! Form::label('title', 'Title:') !!}
        <div class="input-group">
            <div class="input-group-addon">На</div>
            {{ Form::text('title',
                isset($size) ? $size->title : null,
                ['class' => 'form-control'])
            }}
            <div class="input-group-addon">человек</div>
        </div>
        
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('sizes.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
