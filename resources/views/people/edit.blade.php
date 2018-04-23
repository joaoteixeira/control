@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Person #{{ $person->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/people') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($person, [
                            'method' => 'PATCH',
                            'url' => ['/people', $person->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('people.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
