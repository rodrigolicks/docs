@extends('adminlte::default')

@section('content')

<div class="container-fluid">
    <h3>Hábitos</h3>

    <!-- Form executa a forma de pesquisa, que é "praticamente" a mesma da filtragem -->
    {{ Form::open(['name' => 'form_name', 'route' => 'habitos']) }}
    <div class="sidebar-form">
        <div class="input-group">
            <input type="text" name="filtragem" class="form-control" style="width: 100% !important;" placeholder="Pesquisar">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </div>
    <br>
    {{ Form::close() }}
	<table class="table table-stripped table-bordered table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Tipo</th>
				<th>Ações</th>
			</tr>
		</thead>
        <tbody>
			@foreach($habitos as $hab)
			<tr>
				<td>{{$hab->id}}</td>
				<td>{{$hab->nome}}</td>
				<td>{{$hab->descricao}}</td>
				@if ($hab->tp_habito == 'B')
				<td>Bom
				@elseif($hab->tp_habito == 'R')
				<td>Ruim
				@endif</td>
				<td><a href="{{ route('habitos.edit', ['id'=>$hab->id]) }}" class="btn-sm btn-primary">Editar</a>
					<a href="#" onclick="return ConfirmaExclusao({{$hab->id}})" class="btn-sm btn-danger">Excluir</a>
				</td>
			</tr>
			@endforeach
        </tbody>
    </table>
    {{ $habitos->links() }}
    <a href="{{ route('habitos.create') }}" class="btn btn-info">Novo</a>
    <a href="{{ route('habitos.relatorio') }}" class="btn btn-success">Gerar PDF</a>
</div>
@endsection

@section('table-delete')
"habitos"
@endsection
