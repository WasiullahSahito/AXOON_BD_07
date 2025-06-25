<!-- resources/views/admin/pages/products/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Manage Products')

@section('content')
    <div class="admin-products">
        <div class="header">
            <h1>Product Management</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50"></td>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection