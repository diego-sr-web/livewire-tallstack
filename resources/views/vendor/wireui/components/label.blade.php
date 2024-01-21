@props(['class' => 'text-sm'])
<label {{ $attributes->class([
        'block ' . $class . ' font-medium text-gray-600',
        'text-negative-600'  => $hasError,
        'opacity-60'         => $attributes->get('disabled'),
        'text-gray-700 dark:text-gray-400' => !$hasError,
    ]) }}>
    {{ $label ?? $slot }}
</label>