@props([
    'primary' => null,
    'secundary' => null
])
<button 
    {{ $attributes->class([
        'w-full sm:w-auto justify-center inline-flex focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5',
        'text-white bg-primary-700 hover:bg-primary-800 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800' => $primary,
        'text-gray-500 items-center bg-white hover:bg-gray-100 border border-gray-200 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600' => $secundary
    ]) }}
    {{ $attributes }}>
    {{ $slot }}
</button>
