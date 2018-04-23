<div class="form-group {{ $errors->has('campi_id') ? 'has-error' : ''}}">
    {!! Form::label('campi_id', 'Campus', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('campi_id', $campi->pluck('nome', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Selecione o campus...']) !!}
        {!! $errors->first('campi_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
    {!! Form::label('tipo', 'Tipo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('tipo', ['servidor' => 'Servidor', 'aluno' => 'Aluno'], null, ('' == 'required') ? ['placeholder' => 'Selecione o tipo', 'class' => 'form-control', 'required' => 'required'] : ['placeholder' => 'Selecione o tipo', 'class' => 'form-control']) !!}
        {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    {!! Form::label('nome', 'Nome', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nome', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cpf') ? 'has-error' : ''}}">
    {!! Form::label('cpf', 'CPF', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('cpf', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'data-mask' => '000.000.000-00'] : ['class' => 'form-control', 'data-mask' => '000.000.000-00']) !!}
        {!! $errors->first('cpf', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('siape') ? 'has-error' : ''}}">
    {!! Form::label('siape', 'Siape', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('siape', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('siape', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'E-mail', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
