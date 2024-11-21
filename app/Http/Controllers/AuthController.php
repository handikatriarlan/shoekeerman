<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'digits_between:10,20'],
            'address' => ['required', 'string', 'max:500'],
        ], [
            'email.unique' => 'The email address is already in use.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password and confirm password do not match.',
        ]);

        DB::beginTransaction();

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'password' => Hash::make($validated['password']),
            ]);

            DB::commit();

            return redirect()->route('login')
                ->with('success', 'Registration successful. Please login.');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database error during registration: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'An error occurred during registration. Please try again later.')
                ->withInput($request->except(['password', 'password_confirmation']));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('General error during registration: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'An unexpected error occurred. Please contact support.')
                ->withInput($request->except(['password', 'password_confirmation']));
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.required' => 'Password is required.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            $redirectTo = $user->role === 'admin' ? route('admin.dashboard') : route('home');

            return redirect()->intended($redirectTo)
                ->with('success', 'Login successful.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')
                ->with('success', 'Logout successful.');
        } catch (Exception $e) {
            Log::error('Error during logout: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'An error occurred while logging out. Please try again later.');
        }
    }
}
