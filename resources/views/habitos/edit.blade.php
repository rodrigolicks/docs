@extends('adminlte::default')

@section('content')
	<div class="container-fluid">
		<h3>Editando hábito: {{$habito->nome}}</h3>

		@if ($errors -> any())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					{{ $error }}
				</div>
			@endforeach
		@endif

		{!! Form::open(['route' => ['habitos.update', $habito->id], 'files' => true, 'method' => 'put']) !!}
		<div class="form-group">
		{!! Form::label('nome', 'Nome') !!}
		{!! Form::text('nome', $habito->nome, ['class' => 'form-control']) !!}
		{!! Form::label('descricao', 'Descrição') !!}
		{!! Form::textArea('descricao', $habito->descricao, ['class' => 'form-control']) !!}
		{!! Form::label('tp_habito', 'Tipo') !!}
		{!! Form::select('tp_habito', array('B' => 'Bom',
											'R' => 'Ruim'),
											$habito->tp_habito,
									  ['class' => 'form-control']) !!}
		{!! Form::label('objetivo', 'Objetivo') !!}
		{!! Form::number('objetivo', $habito->objetivo, ['class' => 'form-control'], 'required') !!}
		{!! Form::label('dt_inicio_ctrl', 'Data') !!}
		{!! Form::date('dt_inicio_ctrl', $habito->dt_inicio_ctrl, ['class' => 'form-control']) !!}
        </div>

		<div class="form-group">
            {{ Form::label('foto', 'Foto atual:') }}<br>
            <?php
                $data = $habito->foto;
                echo '<img style="max-width: 250px; width: auto; height: auto;" src="data:image/jpeg;base64,' . base64_encode($data) . '"/>';
            ?>
        </div>

		<div class="form-group">
                {{ Form::label('foto', 'Alterar foto:') }}
                <input id="foto" type="file" name="foto" class="btn btn-default"/>
        </div>

		<div class="form-group">
			{!! Form::submit('Atualizar hábito', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}
	</div>
@endsection
