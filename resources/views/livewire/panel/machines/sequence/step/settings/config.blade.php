<div class="max-w-screen-xl mx-auto p-4">
    <table class="w-full border-collapse border border-gray-300 bg-white rounded-lg shadow-md">
        <tbody>
            @forelse ($settings as $i => $setting)
                <tr class="border-b border-gray-300">
                    <td class="py-2 px-4">
                        <x-input wire:model.defer="name.{{ $i }}" label="Nome" />
                    </td>
                    <td class="py-2 px-4">
                        <x-input wire:model.defer="expected_name.{{ $i }}" label="Valor Esperado" />
                    </td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="py-2 px-4">
                        <x-input wire:model.defer="condition.{{ $i }}" label="Condição" />    
                    </td>                
                    <td class="py-2 px-4">
                        <x-input wire:model.defer="api.{{ $i }}" label="Api" />
                    </td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="py-2 px-4" colspan="4">
                        <x-select
                            label="Destino"
                            placeholder="Selecione o destino"
                            {{-- multiselect --}}
                            :options="$destinations"
                            wire:model.defer="destination.{{ $i }}"
                            option-value="id"
                            option-label="name"
                        />
                    </td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="py-1 px-4 bg-gray-300" colspan="4"></td>
                </tr>
            @empty                
            @endforelse

            @for ($i=$startLine; $i<$totalLine; $i++)
                <tr class="border-b border-gray-300">
                    <td class="py-2 px-4">
                        <x-input wire:model.defer="name.{{ $i }}" label="Nome" />
                    </td>
                    <td class="py-2 px-4">
                        <x-input wire:model.defer="expected_name.{{ $i }}" label="Valor Esperado" />
                    </td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="py-2 px-4">
                        <x-input wire:model.defer="condition.{{ $i }}" label="Condição" />    
                    </td>                
                    <td class="py-2 px-4">
                        <x-input wire:model.defer="api.{{ $i }}" label="Api" />
                    </td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="py-2 px-4" colspan="4">
                        <x-select
                            label="Destino"
                            placeholder="Selecione o destino"
                            {{-- multiselect --}}
                            :options="$destinations"
                            wire:model.defer="destination.{{ $i }}"
                            option-value="id"
                            option-label="name"
                        />
                    </td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="py-1 px-4 bg-gray-300" colspan="4"></td>
                </tr>
            @endfor
            <tr class="border-b border-gray-300">
                <td class="py-2 px-4 text-right" colspan="4">
                    <button wire:click.prevent="add" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700">+</button>
                    <button wire:click.prevent="save" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Salvar</button>
                </td>
            </tr>                
        </tbody>
    </table>
</div>
