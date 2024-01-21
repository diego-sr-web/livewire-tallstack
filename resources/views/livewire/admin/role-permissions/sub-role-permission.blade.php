<ul class="w-full">
    @forelse ($permissions->where('global', 1) as $permission)    
        <li class="w-full ">
            {{-- {!! $level !!}<x-toggle lg wire:model="permission.{{ $permission->id }}" wire:click.prevent="setPermission({{ $permission->id }})" label=" {{ $permission->name }}" name="{{ $permission->slug }}" for="{{ $permission->slug }}"/> --}}
            <div class="flex text-gray-500 border-b p-2">
                {!! $level !!} 
                
                <label class="relative inline-flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        wire:model="permission_ids.{{ $permission->id }}" 
                        wire:click.prevent="setPermission({{ $permission->id }})"
                        name="permission_ids[{{ $permission->id }}]" 
                        value="{{ $permission->id }}" 
                        class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->slug }}</span>
                </label>
            </div>            
            @if ($permission->permissions->count())
                <livewire:admin.role-permissions.sub-role-permission 
                    :key="microtime().Str::random()" 
                    :level="'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $level" 
                    :permission_ids="$permission_ids"
                    :permissions="$permission->permissions">
            @endif
        </li>
    @empty
    @endforelse
</ul>