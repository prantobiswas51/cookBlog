@props(['textColor','bgColor'])

@php
    $textColor = match ($textColor) {
        'blue' => 'text-blue-800',
        'red' => 'text-red-800',
        'green' => 'text-green-800',
        'yellow' => 'text-yellow-800',
        default => 'text-gray-800'
    };

    $bgColor = match ($bgColor) {
        'blue' => 'bg-blue-200',
        'red' => 'bg-red-200',
        'green' => 'bg-green-200',
        'yellow' => 'bg-yellow-200',
        default => 'bg-gray-200'
    };
@endphp

<button {{$attributes}} class="{{ $textColor }} {{ $bgColor }} rounded-xl px-3 py-1 text-base"> {{$slot}} </button>
