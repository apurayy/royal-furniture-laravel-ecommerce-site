<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('frontend.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            \App\Http\Controllers\Frontend\CartController::syncGuestCartToUser();
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function registerForm()
    {
        return view('frontend.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:50',
            'password' => 'required|confirmed|min:8',
            'terms' => 'accepted',
        ]);

        $name = trim($request->first_name . ' ' . $request->last_name);

        $user = User::create([
            'name' => $name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        auth()->login($user);

        return redirect('/')->with('success', 'Account created successfully!');
    }

    public function logout()
    {
        auth()->logout();
        session()->forget('cart');
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully.');
    }

    public function myAccount()
    {
        $user = auth()->user();
        return view('frontend.my-account', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:50',
        ]);

        $user = auth()->user();
        $firstName = trim($request->input('first_name', ''));
        $lastName = trim($request->input('last_name', ''));
        $name = trim($firstName . ' ' . $lastName);

        if ($name !== '') {
            $user->name = $name;
        }

        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function myOrders()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->paginate(10);
        return view('frontend.my-orders', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $order->load('items.product');
        return view('frontend.order-detail', compact('order'));
    }

    public function myAddresses()
    {
        $user = auth()->user();
        return view('frontend.my-addresses', compact('user'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();
        $user->address = $request->address;
        $user->save();

        return back()->with('success', 'Address updated successfully.');
    }

    public function forgotPasswordForm()
    {
        return view('frontend.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordForm($token)
    {
        return view('frontend.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
