<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\UserPagesController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/userpages/bryan', [UserPagesController::class, 'bryan'])->name('userpages.bryan');
Route::get('/userpages/cornell', [UserPagesController::class, 'cornell'])->name('userpages.cornell');
Route::get('/userpages/kinless', [UserPagesController::class, 'kinless'])->name('userpages.kinless');
