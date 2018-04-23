@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Key {{ $key->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/keys') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
{{--                        <a href="{{ url('/keys/' . $key->id . '/edit') }}" title="Edit Key"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>--}}
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['keys', $key->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Key',
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
                                        <td>{{ $key->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Sala </th>
                                        <td> {{ $key->room->numero }} - {{ $key->room->descricao }} </td>
                                    </tr>
                                    <tr>
                                        <th> Copia </th>
                                        <td> {{ str_pad($key->copia, 2, '0', STR_PAD_LEFT) }} </td>
                                    </tr>
                                    <tr>
                                        <th> Disponivel </th>
                                        <td> {{ $key->disponivel ? 'Sim' : 'Não'}} </td>
                                    </tr>
                                    <tr>
                                        <th> Qr Code </th>
                                        <td> {!! QrCode::size(200)->generate($key->qr_code) !!} </td>
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
