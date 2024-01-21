@props([
    'class' => 'absolute w-full mx-auto text-center transition-opacity ease-linear z-sticky z-99999999'
])
<div    
    class="{{ $class }}"
        {{ $attributes }}
    >
    <div class="flex items-end justify-center px-4 pt-4 pb-10 text-center sm:block sm:p-0">
        <div
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-all transform"
        >
            <div class="
                absolute 
                inset-0 
                bg-gray-100 
                opacity-75
                ">
            </div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle" aria-hidden="true">&#8203;</span>
        <div
            {{-- x-show="show && showActiveComponent" --}}
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            {{-- x-bind:class="modalWidth" --}}
            class="
                inline-flex w-full align-middle bg-transparent text-center 
                overflow-hidden transform transition-all dark:bg-gray-950
                justify-center min-h-0 top-0 right-0"
            id="modal-container"
        >
            <x-loading.ball-clip-rotate-multiple class="flex" />
        </div>
    </div>
</div>