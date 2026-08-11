@extends('layouts.storefront')

@section('title', 'Sign Up')

@section('content')
<section class="py-16">
    <div class="max-w-md mx-auto px-4">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-lavender-500 to-lavender-600 flex items-center justify-center mx-auto mb-4 shadow-lg shadow-lavender-500/25">
                <span class="text-3xl">🧋</span>
            </div>
            <h1 class="font-display font-extrabold text-3xl text-gray-900 mb-2">Join What to Buy</h1>
            <p class="text-gray-500">Create an account to start ordering</p>
        </div>

        <div class="card-boba p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="input-label" for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="input @error('name') input-error @enderror"
                           value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
                    @error('name')
                        <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="input-label" for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="input @error('email') input-error @enderror"
                           value="{{ old('email') }}" required autocomplete="email" placeholder="you@example.com">
                    @error('email')
                        <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="input-label" for="phone_number">Phone Number <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="tel" name="phone_number" id="phone_number" class="input"
                           value="{{ old('phone_number') }}" autocomplete="tel" placeholder="(555) 123-4567">
                </div>

                <div>
                    <label class="input-label" for="password">Password</label>
                    <input type="password" name="password" id="password" class="input @error('password') input-error @enderror"
                           required autocomplete="new-password" placeholder="••••••••">
                    @error('password')
                        <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="input-label" for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="input"
                           required autocomplete="new-password" placeholder="••••••••">
                </div>

                <button type="submit" class="btn btn-primary w-full btn-lg">
                    Create Account
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-lavender-600 font-semibold hover:text-lavender-700">Sign in</a>
            </p>
        </div>
    </div>
</section>
@endsection
