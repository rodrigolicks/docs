@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
            <h3>Documentos</h3>
            <table class="table table-stripped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Revisões</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($documentos as $doc)
                    <tr>
                        <td>{{ $doc->nome }}</td>
                        <td>{{ $doc->descricao }}</td>
                        <td>{{ $doc->categoria->nome }}</td>
                        <td>@foreach($doc->revisoes as $rev)
                            <p><a href=>[{{ $rev->numero }}] {{ $rev->nome }}</p>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('documentos.edit', ['id' => $doc->id]) }}" class="btn-sm btn-success">Editar</a>
                            <a href="#" onclick="return ConfirmaExclusao({{$doc->id}})" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{ route('documentos.create') }}" class="btn btn-info">Novo documento</a>          
    </div>
@endsection

@section('table-delete')
    "documentos"
@endsection
