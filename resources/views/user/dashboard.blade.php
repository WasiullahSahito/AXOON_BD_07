<!-- resources/views/user/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'My Account')
@section('content')

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="user-sidebar">
                        <div class="user-avatar">
                            <img src="{{ asset('images/user-avatar.png') }}" alt="User Avatar">
                        </div>
                        <ul>
                            <li class="active"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('user.orders') }}">My Orders</a></li>
                            <li><a href="{{ route('user.profile') }}">Profile</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="user-dashboard">
                        <h2>Welcome, {{ $user->name }}</h2>

                        <div class="recent-orders">
                            <h3>Recent Orders</h3>
                            @if($orders->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td><a href="#">{{ $order->id }}</a></td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                <td>${{ number_format($order->total, 2) }}</td>
                                                <td>{{ ucfirst($order->status) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>You haven't placed any orders yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection