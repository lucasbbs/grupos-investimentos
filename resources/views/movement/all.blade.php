@extends('templates.master')
@section('conteudo-view')
	
	@if(session('success'))
		<h3>{{ session('success')['messages'] }}</h3>
	@endif

<table class="default-table">
	<thead>
		<tr>
			<th>Data</th>
			<th>Tipo</th>
			<th>Produto</th>
			<th>Grupo</th>
			<th>Valor</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($movement_list as $movement)
		<tr>
			<td>{{ $movement->created_at->format("d/m/Y H:i") }}</td>
			<td>{{ $movement->type == 1 ? "Aplicação" : "Resgate" }}</td>
			<td>{{ $movement->product->name }}</td>
			<td>{{ $movement->group->name }}</td>
			<td>{{ $movement->value }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection