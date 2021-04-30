@extends('layouts.seller')

@section('content')

<h4>Orders</h4>

{{-- Display success meassage --}}
@if(session()->has('message'))
    <div class="alert alert-success" role="alert" style="text-align: center;">
        {{ session('message') }}
    </div>
@endif

<table class="table">
	<thead>
		<tr>
			<th>Order Number</th>
			<th>Order Status</th>
			<th>Seller Item Count</th>
			<th>Shipping Address</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($subOrders as $subOrder)
		<tr>
			<td>{{ $subOrder->order->order_number }}</td>
			<td>
				{{ $subOrder->status }}

				@if($subOrder->status != 'completed')
					<a href="{{ route('seller.order.delivered',$subOrder->id) }}" class="btn btn-sm btn-primary">mark as delivered</a>
				@endif
			</td>
			<td>{{ $subOrder->item_count }}</td>
			<td>{{ $subOrder->order->shipping_address }}</td>
			<td>
				<a class="btn btn-primary btn-sm" href="{{ route('seller.orders.show',$subOrder) }}">view</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection