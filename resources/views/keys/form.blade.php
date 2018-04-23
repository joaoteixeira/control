<div class="form-group {{ $errors->has('room_id') ? 'has-error' : ''}}">
    {!! Form::label('room_id', 'Sala', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('room_id', $rooms->pluck('numero', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Selecione a sala...']) !!}
        {!! $errors->first('room_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('copia') ? 'has-error' : ''}}">
    {!! Form::label('copia', 'Copia', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('copia', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('copia', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
