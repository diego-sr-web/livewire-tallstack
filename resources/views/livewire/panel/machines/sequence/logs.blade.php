
<div class="relative h-4/5 overflow-y-auto max-h-96">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Usuário / Ação
                </th>
                <th scope="col" class="px-6 py-3">
                    Dados anteriores
                </th>
                <th scope="col" class="px-6 py-3">
                    Data
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sequence->logs as $log)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="p-1 border-b-2">{{ $log->relation->name }}</div>
                        <div class="p-1">
                            {{ machineLogActionLabels($log->action) }}
                        </div>
                    </th>
                    <td class="px-6 py-4">                        
                        <div class="text-xs">
                            {!! machineLogChanges($log->sequence, json_decode($log->log)); !!}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        {{ $log->created_at }}
                    </td>
                </tr> 
            @empty     
                <tr>
                    <td colspan="3" class="p-4 text-center">Nenhum log para exibir</td>    
                </tr>           
            @endforelse                       
        </tbody>
    </table>
</div>