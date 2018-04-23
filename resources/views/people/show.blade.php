@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Person {{ $person->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/people') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/people/' . $person->id . '/edit') }}" title="Edit Person"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['people', $person->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Person',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $person->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Campus </th>
                                        <td> {{ $person->campi->nome }} </td>
                                    </tr>
                                    <tr>
                                        <th> Tipo </th>
                                        <td> {{ $person->tipo }} </td>
                                    </tr>
                                    <tr>
                                        <th> Nome </th>
                                        <td> {{ $person->nome }} </td>
                                    </tr>
                                    <tr>
                                        <th> CPF </th>
                                        <td> {{ $person->cpf }} </td>
                                    </tr>
                                    <tr>
                                        <th> Siape </th>
                                        <td> {{ $person->siape ? $person->siape : '-' }} </td>
                                    </tr>
                                    <tr>
                                        <th> Qr Code </th>
                                        <td> {!! QrCode::size(200)->generate($person->qr_code) !!} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
