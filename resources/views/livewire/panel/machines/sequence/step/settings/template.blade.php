<div class="m-4">
    <div class="p-2 border rounded-lg">
        {{-- <div class="my-1 py-2 border-b">
            <div>
                <p class="text-inscricao">Outras configurações</p>
            </div>
        </div> --}}
        <div class="w-full mb-4">
            <x-select
                label="Selecione a template"
                class="w-full"
                placeholder="Selecione uma template"
                :options="$templates"
                option-label="name"
                option-value="id"
                wire:model.defer="template_id"
            />
        </div>
        <div class="w-full text-right">
            <x-button wire:click.prevent="save" primary label="Salvar" />
        </div>
    </div>
</div>