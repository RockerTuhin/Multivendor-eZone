@extends('layouts.seller')

@section('content')

<h4>Orders</h4>

<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody>
		@foreach($items as $item)
		<tr>
			<td>{{ $item->name }}</td>
			<td>{{ $item->pivot->quantity }}</td>
			<td>{{ $item->pivot->price }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection