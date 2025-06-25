@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Order #{{ $order->id }}</h2>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Shipping Address</h4>
                        <p>{!! nl2br(e($order->shipping_address)) !!}</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Billing Address</h4>
                        <p>{!! nl2br(e($order->billing_address)) !!}</p>
                    </div>
                </div>

                <hr>

                <h4>Order Summary</h4>
                <table class="table">
                    <tr>
                        <th>Subtotal:</th>
                        <td>${{ number_format($order->total, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge bg-{{ 
                                $order->status === 'completed' ? 'success' :
        ($order->status === 'processing' ? 'primary' :
            ($order->status === 'cancelled' ? 'danger' : 'warning')) 
                            }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Order Date:</th>
                        <td>{{ $order->created_at->format('F j, Y \a\t g:i a') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="{{ route('user.orders') }}" class="btn btn-secondary mt-3">
            Back to Orders
        </a>
    </div>
@endsection