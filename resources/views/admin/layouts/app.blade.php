<!-- resources/views/admin/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <!-- Include your CSS files here -->
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                <li><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                <li><a href="{{ route('admin.reports.index') }}">Reports</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            @yield('content')
        </main>
    </div>
</body>

</html>