@props(['rating', 'size' => 'md'])

@php
    $starSize = match($size) {
        'sm' => 'text-sm',
        'lg' => 'text-xl',
        default => 'text-base',
    };
@endphp

<div class="star-rating" aria-label="{{ $rating }} out of 5 stars">
    @for($i = 1; $i <= 5; $i++)
        <span class="star {{ $starSize }} {{ $i <= round($rating) ? 'filled' : '' }}">★</span>
    @endfor
</div>
