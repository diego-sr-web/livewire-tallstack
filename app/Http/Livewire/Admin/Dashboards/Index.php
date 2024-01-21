<?php

namespace App\Http\Livewire\Admin\Dashboards;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $view = isOwner() ? 'livewire.admin.dashboards.index-owner' : 'livewire.admin.dashboards.index';

        return view($view);
    }
}
