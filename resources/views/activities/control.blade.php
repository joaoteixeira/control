@extends('layouts.backend') @section('content')
<div class="container">

    <h4>Controle</h4>

    <table class="table">
        <thead>
            <tr>
                <th width="1">#</th>
                <th>Salas</th>
                <th>Cópia</th>
                <th>Disponível?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keys as $key)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>Sala {{ $key->room->numero }} - {{ $key->room->descricao }}</td>
                <td>Cópia {{ str_pad($key->copia, 2, '0', STR_PAD_LEFT)  }}</td>
                <td>{{ $key->disponivel ? 'Sim' : 'Não' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection