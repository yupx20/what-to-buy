@props(['label', 'value', 'icon', 'trend' => null, 'color' => 'lavender'])

<div class="card-admin p-6">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">{{ $label }}</p>
            <p class="text-2xl font-display font-bold text-gray-900">{{ $value }}</p>
            @if($trend)
                <p class="mt-1 text-xs font-medium {{ $trend > 0 ? 'text-matcha-500' : 'text-strawberry-500' }}">
                    {{ $trend > 0 ? '↑' : '↓' }} {{ abs($trend) }}% from yesterday
                </p>
            @endif
        </div>
        <div class="w-12 h-12 rounded-xl bg-{{ $color }}-50 flex items-center justify-center">
            {!! $icon !!}
        </div>
    </div>
</div>
