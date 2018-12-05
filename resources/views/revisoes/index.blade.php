@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
            <h3>Revisões</h3>
            <table class="table table-stripped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Numero</th>
                        <th>Descrição</th>
                        <th>Documento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($revisoes as $rev)
                    <tr>
                        <td>{{ $rev->nome }}</td>
                        <td>{{ $rev->numero }}</td>
                        <td>{{ $rev->descricao }}</td>
                        <td>{{ $rev->documento->categoria->nome}} - {{ $rev->documento->nome }}</td>
                        <td>
                            <a href="{{ route('revisoes.edit', ['id' => $rev->id]) }}" class="btn-sm btn-success">Editar</a>
                            <a href="#" onclick="return ConfirmaExclusao({{$rev->id}})" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{ route('revisoes.create') }}" class="btn btn-info">Nova revisão</a>          
    </div>
@endsection

@section('table-delete')
    "revisoes"
@endsection
