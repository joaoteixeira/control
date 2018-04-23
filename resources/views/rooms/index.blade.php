@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Rooms</div>
                    <div class="card-body">
                        <a href="{{ url('/rooms/create') }}" class="btn btn-success btn-sm" title="Add New Room">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/rooms', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sala</th>
                                        <th>Descricao</th>
                                        <th>Agendavel</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($rooms as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->numero }}</td>
                                        <td>{{ $item->descricao }}</td>
                                        <td>{{ $item->agendavel ? 'Sim' : 'Não' }}</td>
                                        <td>
                                            <a href="{{ url('/rooms/' . $item->id) }}" title="View Room"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/rooms/' . $item->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/rooms', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Room',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $rooms->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
