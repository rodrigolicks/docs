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

    {{ Form::open(['route' => 'historicos.masterdetail']) }}

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

        <hr/>
        <h4>Hábitos</h4>

        <div class="input_fields_wrap"></div>
        <br>
        <button style="float:right;" class="add_field_button btn btn-success">Adicionar hábito</button>
        <br>
        <hr/>

        <div class="form-group">
            {!! Form::submit('Criar histórico', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('dyn_scripts')
<script>
    $(document).ready(function(){
        var wrapper = $(".input_fields_wrap");
        var add_button = $(".add_field_button");
        var x = 0;
        $(add_button).click(function(e){
            x++;
            var newField = `
            <div>
                <div style="width: 94%; float: left;" id="habito">
                    {{ Form::select("itens[]", \App\Habito::orderBy("nome")->pluck("nome", "id")->toArray(), null,
                        ["class"=>"form-control", "required", "placeholder" => "Selecone um hábito"])
                    }}
                </div>
                <button type="button" class="remove_field btn btn-danger btn-circle"><i class="fa fa-times">
                </button>
            </div>`;

            $(wrapper).append(newField);
        });

        $(wrapper).on("click", ".remove_field", function(e){
            e.preventDefault();
            $(this).parent('div').remove();
        });
    });
</script>
@endsection
