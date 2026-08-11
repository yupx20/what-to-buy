@extends('layouts.admin')

@section('page_title', 'Activity Log')

@section('content')
<div class="space-y-6">
    {{-- Type Filter --}}
    <div class="card-admin p-4">
        <div class="flex gap-2">
            <a href="{{ route('admin.activity') }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ !$type ? 'bg-lavender-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                All
            </a>
            <a href="{{ route('admin.activity', ['type' => 'order']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ $type === 'order' ? 'bg-lavender-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                📋 Orders
            </a>
            <a href="{{ route('admin.activity', ['type' => 'stock']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ $type === 'stock' ? 'bg-lavender-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                📦 Stock
            </a>
            <a href="{{ route('admin.activity', ['type' => 'system']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ $type === 'system' ? 'bg-lavender-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                ⚙️ System
            </a>
        </div>
    </div>

    {{-- Activity Timeline --}}
    <div class="card-admin">
        <div class="divide-y divide-gray-50">
            @forelse($logs as $log)
                <div class="p-5 flex gap-4 hover:bg-gray-50/50 transition-colors">
                    <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center text-lg
                        {{ $log->type === 'order' ? 'bg-lavender-50' : ($log->type === 'stock' ? 'bg-amber-50' : 'bg-gray-50') }}">
                        {{ $log->type === 'order' ? '📋' : ($log->type === 'stock' ? '📦' : '⚙️') }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="font-semibold text-sm text-gray-900">{{ $log->title }}</p>
                                <p class="text-sm text-gray-500 mt-0.5">{{ $log->message }}</p>
                            </div>
                            <span class="text-xs text-gray-400 whitespace-nowrap flex-shrink-0">{{ $log->created_at->diffForHumans() }}</span>
                        </div>
                        @if($log->action_url)
                            <a href="{{ $log->action_url }}" class="text-xs text-lavender-600 hover:text-lavender-700 font-medium mt-1 inline-block">
                                View details →
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-16 text-center">
                    <span class="text-4xl block mb-3">📝</span>
                    <p class="text-gray-500">No activity logged yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $logs->withQueryString()->links() }}
    </div>
</div>
@endsection
