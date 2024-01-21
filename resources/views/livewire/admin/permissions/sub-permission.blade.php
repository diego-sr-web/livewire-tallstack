<div class="w-full">
    @forelse ($permissions as $permission)    
        <div class="flex w-full text-gray-500 border-b p-2">
            <div class="flex">{!! $level !!} {!! $permission->permission_id ? '&rsaquo;&rsaquo;' : '' !!} {{ $permission->name }}</div>
            <div class="flex ml-auto">
                <x-button.circle wire:click="edit({{ $permission->id }})" primary xs icon="pencil" class="mr-1"/>
                <x-button.circle wire:click="confirmDelete({{ $permission->id }})" negative xs icon="x" />
            </div>
        </div>
        @if ($permission->permissions->count())
            <livewire:admin.permissions.sub-permission 
                :key="microtime()" 
                :level="'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $level" 
                :permissions="$permission->permissions">
        @endif
    @empty
    @endforelse
</div>