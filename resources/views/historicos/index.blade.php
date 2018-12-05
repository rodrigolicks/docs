@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
            <h3>Históricos</h3>

            <table class="table table-stripped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Hábitos</th>
                        <th>Ação</th>
                    </tr>

                </thead>
                <tbody>
                @foreach($historicos as $hist)
                    <tr>
                        <td>{{ $hist->data }}</td>
                        <td>{{ $hist->hora }}</td>
                        <td>@foreach($hist->historico_habitos as $hab)
                            <ul>
                                <li>{{ $hab->habito->nome }}</li>
                            </ul>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('historicos.edit', ['id' => $hist->id]) }}" class="btn-sm btn-success">Editar</a>
                            <a href="#" onclick="return ConfirmaExclusao({{$hist->id}})" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@endsection

@section('table-delete')
    "historicos"
@endsection
