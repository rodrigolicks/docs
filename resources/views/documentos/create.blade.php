@extends('adminlte::default')

@section('content')
	<div class="container-fluid">
		<h3>Novo documento</h3>

		@if ($errors -> any())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					{{ $error }}
				</div>
			@endforeach
		@endif

		{!! Form::open(['route' => 'documentos.store', 'files' => true]) !!}
		<div class="form-group">
		{!! Form::label('nome', 'Nome') !!}
		{!! Form::text('nome', null, ['class' => 'form-control']) !!}
		{!! Form::label('descricao', 'Descrição') !!}
		{!! Form::textArea('descricao', null, ['class' => 'form-control']) !!}
		{!! Form::label('categoria_id', 'Categoria') !!}
		{!! Form::select('categoria_id',
        \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {{ Form::label('arquivo', 'Arquivo do documento:') }}
            <input id="documento_upload" type="file" accept=".xls, .xlsx, .pdf, .doc, .docx, .rtf" name="documento_upload" class="btn btn-default" />
        </div>

		<div class="form-group">
			{!! Form::submit('Criar documento', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}
	</div>
@endsection
