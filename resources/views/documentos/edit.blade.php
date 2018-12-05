@extends('adminlte::default')

@section('content')
	<div class="container-fluid">
		<h3>Editando documento: {{$documento->nome}}</h3>

		@if ($errors -> any())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					{{ $error }}
				</div>
			@endforeach
		@endif

		{!! Form::open(['route' => ['documentos.update', $documento->id], 'method' => 'put']) !!}
		<div class="form-group">
		{!! Form::label('nome', 'Nome') !!}		
		{!! Form::text('nome', $documento->nome, ['class'=>'form-control']) !!}
		{!! Form::label('descricao', 'Descrição') !!}
		{!! Form::textArea('descricao', $documento->descricao, ['class' => 'form-control']) !!}
		{!! Form::label('categoria_id', 'Categoria') !!}
		{!! Form::select('categoria_id',
        \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), $documento->categoria_id, ['class' => 'form-control']) !!}
        </div>


		<div class="form-group">
			{!! Form::submit('Atualizar documento', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}
	</div>
@endsection
