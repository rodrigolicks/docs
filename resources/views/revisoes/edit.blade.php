@extends('adminlte::default')

@section('content')
	<div class="container-fluid">
		<h3>Editando revisão: {{$revisao->nome}}</h3>

		@if ($errors -> any())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					{{ $error }}
				</div>
			@endforeach
		@endif

		{!! Form::open(['route' => ['revisoes.update', $revisao->id], 'method' => 'put']) !!}
		<div class="form-group">
		{!! Form::hidden('documento_id', $revisao->documento_id) !!}
		{!! Form::label('nome', 'Nome') !!}		
		{!! Form::text('nome', $revisao->nome, ['class'=>'form-control']) !!}
		{!! Form::label('descricao', 'Descrição') !!}
		{!! Form::textArea('descricao', $revisao->descricao, ['class' => 'form-control']) !!}
        </div>

		<div class="form-group">
			<label for="documento_upload">Arquivo da revisão de documento: <b>{!! $revisao->arquivo_id !!}</label>
			<input id="documento_upload" type="file" accept=".xls, .xlsx, .pdf, .doc, .docx, .rtf" name="documento_upload" class="btn btn-default" />
		</div>	

		<div class="form-group">
			{!! Form::submit('Atualizar revisão', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}
	</div>
@endsection
