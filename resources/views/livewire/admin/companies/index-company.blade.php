<div class="main-home-wrapper">
    @push('css')
        <link href="{{ asset('css/loading/ball-clip-rotate-multiple.css') }}" rel="stylesheet" />
    @endpush
    <x-loading.modal wire:loading />
    @include('layouts.sidebar')

    <div class="w-full m-4 bg-white rounded-lg">
        <div class="p-6 rounded-t-lg bg-slate-500 border border-b-2 text-right">
            <x-button onclick="Livewire.emit('openModal', 'admin.settings.companies.company.form')" white label="Adicionar Novo" />
        </div>
        <div class="m-4">
            <livewire:admin.settings.companies.list-company />
        </div>
    </div>
</div>