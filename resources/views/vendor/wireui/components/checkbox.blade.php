@props([
    'class' => 'text-sm',
    'ml' => 'ml-2',
    'id' => null,
    'name' => null,
])
<div>
    <label for="{{ $id }}" class="flex items-center {{ $errors->has($name) ? 'text-negative-600':'' }}">
        <div class="relative flex items-start">
            @if ($leftLabel)
                <div class="mr-2 {{ $class }} text-right">
                    <x-dynamic-component
                        :component="WireUi::component('label')"
                        class="{{ $class }}"
                        :for="$id"
                        :label="$leftLabel"
                        :has-error="$errors->has($name)"
                    />
                    @if($description)
                        <div class="text-gray-500">{{ $description }}</div>
                    @endif
                </div>
            @endif

            <div class="flex items-center h-5">
                <input {{ $attributes->class([
                    $getClasses($errors->has($name)),
                ])->merge([
                    'type'  => 'checkbox',
                ]) }} />
            </div>

            @if ($label)
                <div class="{{ $ml }} {{ $class }}">
                    <x-dynamic-component
                        :component="WireUi::component('label')"
                        class="{{ $class }}"
                        :for="$id"
                        :label="$label"
                        :has-error="$errors->has($name)"
                    />
                    @if($description)
                        <div id="{{ $id }} . comments-description" class="text-gray-500">{{ $description }}</div>
                    @endif
                </div>
            @endif
        </div>
    </label>

    @if ($name)
        <x-dynamic-component
            :component="WireUi::component('error')"
            :name="$name"
        />
    @endif
</div>
