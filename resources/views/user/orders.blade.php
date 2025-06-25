@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Orders</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                                $order->status === 'completed' ? 'success' :
                        ($order->status === 'processing' ? 'primary' :
                            ($order->status === 'cancelled' ? 'danger' : 'warning')) 
                                            }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $orders->links() }}
        </div>
    </div>
@endsection