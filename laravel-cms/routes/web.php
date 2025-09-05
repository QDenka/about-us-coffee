<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/lang/{locale}', function ($locale, \Illuminate\Http\Request $request) {
    if (in_array($locale, ['vi', 'en'])) {
        session(['locale' => $locale]);
    }
    
    // Handle redirect parameter if provided
    $redirect = $request->get('redirect', '/');
    
    // Validate redirect URL to prevent open redirects
    if (!str_starts_with($redirect, '/') || str_contains($redirect, '//')) {
        $redirect = '/';
    }
    
    return redirect($redirect);
})->name('lang.switch');
