@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
        <h3>Nova revisão{{ $documento != null ? ' - Documento ' . $documento->nome : ''}}</h3>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

    {{ Form::open(['route' => 'revisoes.store']) }}
    <div class="form-group">
        @if ($documento == null)
        {!! Form::label('documento_id', 'Documento') !!}
		{!! Form::select('categoria_id',
        \App\Documento::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class' => 'form-control']) !!}
        @else
        {{ Form::hidden('documento_id', $documento->id) }}
        @endif
		{!! Form::label('nome', 'Nome da revisão') !!}
		{!! Form::text('nome', null, ['class' => 'form-control']) !!}
		{!! Form::label('descricao', 'Descrição da revisão') !!}
		{!! Form::textArea('descricao', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>

    <div class="form-group">
        {{ Form::label('arquivo', 'Arquivo da revisão de documento:') }}
        <input id="documento_upload" type="file" accept=".xls, .xlsx, .pdf, .doc, .docx, .rtf" name="documento_upload" class="btn btn-default" />
    </div>

    <div class="form-group">
        {!! Form::submit('Criar revisão', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
    </div>
@endsection
