@extends('layouts.storefront')

@section('title', 'Log In')

@section('content')
<section class="py-16">
    <div class="max-w-md mx-auto px-4">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-lavender-500 to-lavender-600 flex items-center justify-center mx-auto mb-4 shadow-lg shadow-lavender-500/25">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-4-4 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z"/>
                </svg>
            </div>
            <h1 class="font-display font-extrabold text-3xl text-gray-900 mb-2">Welcome Back</h1>
            <p class="text-gray-500">Sign in to your account to continue</p>
        </div>

        <div class="card-boba p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="input-label" for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="input @error('email') input-error @enderror"
                           value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="you@example.com">
                    @error('email')
                        <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="input-label" for="password">Password</label>
                    <input type="password" name="password" id="password" class="input @error('password') input-error @enderror"
                           required autocomplete="current-password" placeholder="••••••••">
                    @error('password')
                        <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-cream-300 text-lavender-500 focus:ring-lavender-400" {{ old('remember') ? 'checked' : '' }}>
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-full btn-lg">
                    Sign In
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-lavender-600 font-semibold hover:text-lavender-700">Sign up</a>
            </p>
        </div>
    </div>
</section>
@endsection
