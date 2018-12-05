@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
        <h3>Novo Histórico</h3>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

            {{ Form::open(['route' => 'historicos.store']) }}

    <!-- Campo habitoId -->
    <div class="form-group">
    {{ Form::label('habito_id', 'Habito:') }}
    {{ Form::select('habito_id',
        \App\Habito::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class' => 'form-control'])
    }}
    </div>
    <!-- Campo Data -->
    <div class="form-group">
        {{ Form::label('data', 'Data:') }}
        {{ Form::text('data', null, ['class'=>'form-control']) }}
    </div>

    <!-- Campo hora -->
    <div class="form-group">
            {{ Form::label('hora', 'Hora:') }}
            {{ Form::text('hora', null, ['class'=>'form-control']) }}
        </div>


    <div class="form-group">
        {!! Form::submit('Criar histórico', ['class' => 'btn btn-primary']) !!}
        </div>
            {!! Form::close() !!}
    </div>
@endsection
