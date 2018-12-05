@extends('adminlte::default')

@section('content')
	<div class="container-fluid">
		<h3>Novo hábito</h3>

		@if ($errors -> any())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					{{ $error }}
				</div>
			@endforeach
		@endif


		{!! Form::open(['route' => 'habitos.store', 'files' => true]) !!}
		<div class="form-group">
		{!! Form::label('nome', 'Nome') !!}
		{!! Form::text('nome', null, ['class' => 'form-control']) !!}
		{!! Form::label('descricao', 'Descrição') !!}
		{!! Form::textArea('descricao', null, ['class' => 'form-control']) !!}
		{!! Form::label('tp_habito', 'Tipo') !!}
		{!! Form::select('tp_habito', array('B' => 'Bom',
											'R' => 'Ruim'),
									  'B',
									  ['class' => 'form-control']) !!}
		{!! Form::label('objetivo', 'Objetivo') !!}
		{!! Form::number('objetivo', null, ['class' => 'form-control'], 'required') !!}
		{!! Form::label('dt_inicio_ctrl', 'Data') !!}
		{!! Form::date('dt_inicio_ctrl', '2018-09-19 00:00:00', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {{ Form::label('foto', 'Foto:') }}
            <input id="foto" type="file" name="foto" class="btn btn-default" />
        </div>

		<div class="form-group">
			{!! Form::submit('Criar hábito', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}
	</div>
@endsection
