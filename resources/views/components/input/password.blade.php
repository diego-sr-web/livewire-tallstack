@props([
    'label' => null,
    'name_error' => null
])

@if ($label)
    <label for="input-email-1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
@endif

<div class="mb-6">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#5b6228" viewBox="0 0 256 256"><path d="M48,56V200a8,8,0,0,1-16,0V56a8,8,0,0,1,16,0Zm84,54.5L112,117V96a8,8,0,0,0-16,0v21L76,110.5a8,8,0,0,0-5,15.22l20,6.49-12.34,17a8,8,0,1,0,12.94,9.4l12.34-17,12.34,17a8,8,0,1,0,12.94-9.4l-12.34-17,20-6.49A8,8,0,0,0,132,110.5ZM238,115.64A8,8,0,0,0,228,110.5L208,117V96a8,8,0,0,0-16,0v21l-20-6.49a8,8,0,0,0-4.95,15.22l20,6.49-12.34,17a8,8,0,1,0,12.94,9.4l12.34-17,12.34,17a8,8,0,1,0,12.94-9.4l-12.34-17,20-6.49A8,8,0,0,0,238,115.64Z"></path></svg>
        </div>
        <input       
            type="password"  
            {{ $attributes->class(['bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}
            {{ $attributes }}>
    </div>

    @error($name_error)
        <small class="text-red-500">{{ $message }}</small>
    @enderror
</div>