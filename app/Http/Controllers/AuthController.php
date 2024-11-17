<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('General error during registration: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'An unexpected error occurred. Please contact support.')
                ->withInput($request->except(['password', 'password_confirmation']));
        }
    }
}
