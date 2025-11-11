<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/katalog', function () {
    return view('katalog');
})->name('katalog');

// Detail produk
Route::get('/detail/{id}', function ($id) {
    return view('detail', ['id' => $id]);
})->name('detail');

// Chatbot route to handle AI messages
Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');
// Chatbot health check
Route::get('/chatbot/health', [ChatbotController::class, 'health'])->name('chatbot.health');
