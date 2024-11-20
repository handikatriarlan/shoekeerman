@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <section class="auth">
        <div class="auth__container">
            <div class="auth__card">
                <a href="{{ route('home') }}" class="auth__back">
                    <i class='bx bx-arrow-back'></i>
                    <span>Back to Home</span>
                </a>


                <div class="auth__header">
                    <h1>Welcome Back</h1>
                    <p>Sign in to continue shopping</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="auth__form">
                    @csrf

                    <div class="form__group">
                        <div class="form__input-wrapper {{ $errors->has('email') ? 'error' : '' }}">
                            <i class='bx bx-envelope'></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autocomplete="email" placeholder=" ">
                            <label for="email">Email Address</label>
                        </div>
                        @error('email')
                            <span class="form__error">
                                <i class='bx bx-error-circle'></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <div class="form__input-wrapper {{ $errors->has('password') ? 'error' : '' }}">
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" id="password" name="password" required placeholder=" ">
                            <label for="password">Password</label>
                            <button type="button" class="form__toggle-password">
                                <i class='bx bx-hide'></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="form__error">
                                <i class='bx bx-error-circle'></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form__options">
                        <label class="form__checkbox">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            <span class="label-text">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="form__forgot">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <div class="form__actions">
                        <button type="submit" class="form__button form__button--primary">
                            <span>Sign In</span>
                            <i class='bx bx-right-arrow-alt'></i>
                        </button>

                        <p class="register__login">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="register__login-link">Sign Up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
