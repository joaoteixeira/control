<div class="form-group {{ $errors->has('numero') ? 'has-error' : ''}}">
    {!! Form::label('numero', 'Numero', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('numero', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
    {!! Form::label('descricao', 'Descricao', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('descricao', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('agendavel') ? 'has-error' : ''}}">
    {!! Form::label('agendavel', 'Agendavel', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <div class="checkbox">
    <label>{!! Form::radio('agendavel', '1') !!} Yes</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('agendavel', '0', true) !!} No</label>
</div>
        {!! $errors->first('agendavel', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('campi_id') ? 'has-error' : ''}}">
    {!! Form::label('campi_id', 'Campi Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('campi_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('campi_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
