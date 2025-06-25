<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserDashboardController extends Controller
{
    /**
     * Show the user's dashboard.
     * Displays recent orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        // This fetches a standard Collection, NOT a paginated result.
        // If user.dashboard.blade.php tries to call $orders->links(), it will cause the error.
        $orders = $user->orders()->latest()->take(5)->get();
        return view('user.dashboard', compact('user', 'orders'));
    }

    /**
     * Show all of the authenticated user's orders with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function orders()
    {
                                                                  // FIX: This method correctly uses paginate() for the user.orders view
        $orders = Auth::user()->orders()->latest()->paginate(10); // Paginate with 10 orders per page
        return view('user.orders', compact('orders'));
    }

    /**
     * Show the authenticated user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    /**
     * Update the authenticated user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        Auth::user()->update($request->only('name', 'email'));
        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the authenticated user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (! Hash::check($request->current_password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        Auth::user()->password = Hash::make($request->password);
        Auth::user()->save();

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Show the details of a specific order for the authenticated user.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function showOrder(Order $order)
    {
        // Ensure the authenticated user owns this order
        if (Auth::id() !== $order->user_id) {
            abort(403); // Forbidden access
        }
        return view('user.order-details', compact('order'));
    }
}
