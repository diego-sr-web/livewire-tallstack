@props([
    'label' => null,
    'name' => null
])

@if ($label)
    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
@endif

<input 
    type="text" 
    {{ $attributes->class(['bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500']) }}
    {{ $attributes }}>

@error($name)
    <small class="text-red-500">{{ $message }}</small>
@enderror