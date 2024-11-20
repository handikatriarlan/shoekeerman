@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <section class="auth">
        <div class="auth__container">
            <div class="auth__card">
                <a href="{{ route('home') }}" class="auth__back">
                    <i class='bx bx-arrow-back'></i>
                    <span>Back to Home</span>
                </a>

                <div class="auth__header">
                    <h1>Create Account</h1>
                    <p>Join us for exclusive offers and updates</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="auth__form">
                    @csrf

                    <div class="form__group">
                        <div class="form__input-wrapper {{ $errors->has('name') ? 'error' : '' }}">
                            <i class='bx bx-user'></i>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                autocomplete="name" placeholder=" ">
                            <label for="name">Full Name</label>
                        </div>
                        @error('name')
                            <span class="form__error">
                                <i class='bx bx-error-circle'></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

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

                    <div class="form__group">
                        <div class="form__input-wrapper">
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                placeholder=" ">
                            <label for="password_confirmation">Confirm Password</label>
                            <button type="button" class="form__toggle-password">
                                <i class='bx bx-hide'></i>
                            </button>
                        </div>
                    </div>

                    <div class="form__terms {{ $errors->has('terms') ? 'error' : '' }}">
                        <label class="form__checkbox">
                            <input type="checkbox" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            <span class="label-text">I agree to the <a href="#" class="form__link">Terms &
                                    Conditions</a></span>
                        </label>
                        @error('terms')
                            <span class="form__error">
                                <i class='bx bx-error-circle'></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form__actions">
                        <button type="submit" class="form__button form__button--primary">
                            <span>Create Account</span>
                            <i class='bx bx-user-plus'></i>
                        </button>

                        <p class="register__login">
                            Already have an account?
                            <a href="{{ route('login') }}" class="register__login-link">Sign In</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
