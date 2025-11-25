@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded'
    : 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
