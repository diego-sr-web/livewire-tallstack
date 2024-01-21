<?php

use App\Http\Livewire\Admin as LivewireAdmin;
use App\Http\Livewire\Panel as LivewirePanel;
use App\Models\Owners\Owner;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(['auth', 'verified', 'can:admin'])
    ->group(function () {
        Route::get('dashboard', LivewireAdmin\Dashboards\Index::class)->name('dashboards.index');
        Route::get('papeis', LivewireAdmin\Roles\IndexRole::class)->name('roles');
        Route::get('colaboradores', LivewireAdmin\Collaborators\IndexCollaborator::class)->name('collaborators');
        Route::get('perfil-permissoes', LivewireAdmin\RolePermissions\IndexRolePermission::class)->name('role-permissions');
    });

Route::prefix('painel')
    ->middleware(['auth', 'verified', 'can:panel'])
    ->group(function () {
        Route::get('maquina/{machine}/sequencias', LivewirePanel\Machines\Sequence\Index::class)->name('machine-sequences');        
    });

Route::prefix('admin/configuracoes')
    ->middleware(['auth', 'verified', 'can:'.Owner::class])
    ->group(function () {
        Route::get('empresas', LivewireAdmin\Settings\Companies\IndexCompany::class)->name('companies');
        Route::get('permissoes', LivewireAdmin\Settings\Permissions\IndexPermission::class)->name('permissions');
    });
