<div class="min-h-[40rem]">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <x-tab.open>
            <x-tab.item 
                wire:click.prevent="openTab('config')" 
                icon="config" 
                href="javascript:;" 
                active="{{ (bool)data_get(array_flip($activeComponent), 'config') }}" 
                disabled="{{ data_get($tabDisabled, 'config', false) }}">
                Configurações
            </x-tab.item>

            <x-tab.item 
                wire:click.prevent="openTab('template')" 
                icon="envelope" 
                href="javascript:;" 
                active="{{ (bool)data_get(array_flip($activeComponent), 'template') }}" 
                disabled="{{ data_get($tabDisabled, 'template', false) }}">
                Template
            </x-tab.item>
            
            <x-tab.item 
                wire:click.prevent="openTab('schedule')" 
                icon="window" 
                href="javascript:;" 
                active="{{ (bool)data_get(array_flip($activeComponent), 'schedule') }}" 
                disabled="{{ data_get($tabDisabled, 'hours', false) }}">
                Horarios para envio
            </x-tab.item>
            
            <x-tab.item disabled>Logs</x-tab.item>
        </x-tab.open>
    </div>

    @switch(data_get($activeComponent, 1))
        @case('config')
            <livewire:panel.machines.sequence.step.settings.config :step="$step" />
            @break
        @case('template')
            <livewire:panel.machines.sequence.step.settings.template :step="$step" />
            @break
        @case('schedule')
            <livewire:panel.machines.sequence.step.settings.schedule />
            @break
        @default
            
    @endswitch
</div>
{{-- https://sinnbeck.dev/posts/making-a-complete-file-uploader-with-progressbar-using-livewire-and-alpinejs --}}
