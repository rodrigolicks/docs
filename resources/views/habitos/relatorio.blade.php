<div class="container-fluid">
    <h3>Hábitos</h3>

	<table>
		<thead>
			<tr>
				<th>Id</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Tipo</th>
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
			</tr>
			@endforeach
        </tbody>
    </table>
</div>
