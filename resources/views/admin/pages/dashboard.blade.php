<!-- resources/views/admin/pages/dashboard.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="admin-dashboard">
        <h1>Dashboard Overview</h1>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Products</h3>
                <p>{{ $stats['products'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Users</h3>
                <p>{{ $stats['users'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p>{{ $stats['orders'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Revenue</h3>
                <p>${{ number_format($stats['revenue'], 2) }}</p>
            </div>
        </div>
    </div>
@endsection