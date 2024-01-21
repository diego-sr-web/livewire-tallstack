<?php

use App\Http\Controllers\ListMeis\ListMeisController;
use App\Http\Controllers\MailTemplateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadFiles\UploadFileController;
use App\Http\Livewire\Panel as LivewirePanel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/', \App\Http\Livewire\Users\Login::class);

Route::prefix('painel')
    ->middleware(['auth', 'verified', 'can:panel'])
    ->group(function () {
        Route::get('maquinas', LivewirePanel\Machines\Machine\Index::class)->name('machines');
        Route::get('lista-meis', [ListMeisController::class, 'index'])->name('list-meis.index');
    });

Route::prefix('mail-templates')
    ->middleware(['auth', 'verified', 'can:panel'])
    ->group(function () {
        Route::get('mail-marketing', [MailTemplateController::class, 'marketingIndex'])->name('mail-marketing.index');
        Route::get('mail-marketing/cadastrar', [MailTemplateController::class, 'marketingCreate'])->name('mail-marketing.create');
        Route::get('mail-marketing/{id}/edit', [MailTemplateController::class, 'marketingEdit'])->name('mail-marketing.edit');
        Route::post('mail-marketing', [MailTemplateController::class, 'marketingStore'])->name('mail-marketing.store');
        Route::put('mail-marketing/{id}', [MailTemplateController::class, 'marketingUpdate'])->name('mail-marketing.update');

        Route::get('mail-transactional', [MailTemplateController::class, 'transactionalIndex'])->name('mail-transactional.index');
        Route::get('mail-transactional/cadastrar', [MailTemplateController::class, 'transactionalCreate'])->name('mail-transactional.create');
        Route::get('mail-transactional/{id}/edit', [MailTemplateController::class, 'transactionalEdit'])->name('mail-transactional.edit');
        Route::post('mail-transactional', [MailTemplateController::class, 'transactionalStore'])->name('mail-transactional.store');
        Route::put('mail-transactional/{id}', [MailTemplateController::class, 'transactionalUpdate'])->name('mail-transactional.update');

    }); 
Route::prefix('uploads')
    ->middleware(['auth', 'verified', 'can:panel'])
    ->group(function () { 
        Route::get('arquivos', [UploadFileController::class, 'index'])->name('uploads.index');    
    });

Route::get('/error', function () {
    return view('error.error'); 
})->name('error');

Route::prefix('usuario')
    ->middleware('auth')->group(function () {
        Route::get('perfil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('perfil', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';
