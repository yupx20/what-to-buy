<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'What to Buy — Boutique Boba & Milk Tea. Discover, customize, and order your perfect boba drink.')">

    <title>@yield('title', 'What to Buy') — Boutique Boba & Milk Tea</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-cream-50">
    {{-- Toast Notifications --}}
    <div id="toast-container" class="toast-container"></div>

    {{-- Navigation --}}
    <header class="fixed top-0 left-0 right-0 z-50 glass border-b border-cream-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="What to Buy home">
                    <span class="w-10 h-10 rounded-full bg-gradient-to-br from-lavender-500 to-lavender-600 flex items-center justify-center shadow-lg shadow-lavender-500/25 group-hover:shadow-lavender-500/40 transition-shadow">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-4-4 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z"/>
                        </svg>
                    </span>
                    <span class="font-display font-bold text-2xl text-lavender-600 tracking-tight">What to Buy</span>
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden md:flex items-center gap-8" aria-label="Primary navigation">
                    <a href="{{ route('menu') }}" class="font-sans font-semibold text-sm {{ request()->routeIs('menu') ? 'text-lavender-600' : 'text-gray-600 hover:text-lavender-600' }} transition-colors">
                        Menu
                    </a>
                    <a href="{{ route('community') }}" class="font-sans font-semibold text-sm {{ request()->routeIs('community*') ? 'text-lavender-600' : 'text-gray-600 hover:text-lavender-600' }} transition-colors">
                        Community
                    </a>
                </nav>

                {{-- Right Actions --}}
                <div class="flex items-center gap-4">
                    {{-- Cart Button --}}
                    <a href="{{ route('cart.index') }}" class="relative p-2 rounded-full hover:bg-lavender-50 transition-colors" aria-label="Shopping cart">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span id="cart-badge" class="absolute -top-0.5 -right-0.5 w-5 h-5 bg-strawberry-400 text-white text-[10px] font-bold rounded-full flex items-center justify-center {{ app(App\Services\CartService::class)->getItemCount() > 0 ? '' : 'hidden' }}">
                            {{ app(App\Services\CartService::class)->getItemCount() }}
                        </span>
                    </a>

                    {{-- Auth Links --}}
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 btn btn-sm btn-ghost">
                                <span class="w-8 h-8 rounded-full bg-lavender-100 flex items-center justify-center">
                                    <span class="font-display font-bold text-sm text-lavender-600">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </span>
                                <span class="hidden sm:inline text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-cream-200 py-2 z-50">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-lavender-50">Admin Dashboard</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-lavender-50">Log Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-secondary">Log In</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-primary hidden sm:inline-flex">Sign Up</a>
                    @endauth

                    {{-- Mobile Menu Toggle --}}
                    <button id="mobile-menu-toggle" class="md:hidden p-2 rounded-lg hover:bg-lavender-50 transition-colors" aria-label="Toggle menu">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div id="mobile-menu" class="md:hidden hidden border-t border-cream-200 bg-white">
            <div class="px-4 py-4 space-y-2">
                <a href="{{ route('menu') }}" class="block px-4 py-3 rounded-xl font-semibold text-sm {{ request()->routeIs('menu') ? 'bg-lavender-50 text-lavender-600' : 'text-gray-600' }}">Menu</a>
                <a href="{{ route('community') }}" class="block px-4 py-3 rounded-xl font-semibold text-sm {{ request()->routeIs('community*') ? 'bg-lavender-50 text-lavender-600' : 'text-gray-600' }}">Community</a>
            </div>
        </div>
    </header>

    {{-- Main Content (offset for fixed header) --}}
    <main class="pt-20">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-lavender-950 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-10 h-10 rounded-full bg-lavender-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-4-4 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z"/>
                            </svg>
                        </span>
                        <span class="font-display font-bold text-xl">What to Buy</span>
                    </div>
                    <p class="text-lavender-300 text-sm leading-relaxed max-w-sm">
                        Boutique boba & milk tea crafted with premium ingredients. Every sip is an experience.
                    </p>
                </div>
                <div>
                    <h4 class="font-display font-bold text-sm mb-4 text-lavender-200">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('menu') }}" class="text-sm text-lavender-300 hover:text-white transition-colors">Menu</a></li>
                        <li><a href="{{ route('community') }}" class="text-sm text-lavender-300 hover:text-white transition-colors">Community</a></li>
                        <li><a href="{{ route('cart.index') }}" class="text-sm text-lavender-300 hover:text-white transition-colors">Cart</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-display font-bold text-sm mb-4 text-lavender-200">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-sm text-lavender-300">hello@whattobuy.com</li>
                        <li class="text-sm text-lavender-300">(555) 123-4567</li>
                        <li class="text-sm text-lavender-300">123 Boba Street, Tea City</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-lavender-900 mt-12 pt-8 text-center">
                <p class="text-sm text-lavender-400">&copy; {{ date('Y') }} What to Buy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Flash Messages to Toast --}}
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', () => window.showToast?.(@json(session('success')), 'success'));</script>
    @endif
    @if(session('error'))
        <script>document.addEventListener('DOMContentLoaded', () => window.showToast?.(@json(session('error')), 'error'));</script>
    @endif

    @stack('scripts')
</body>
</html>
