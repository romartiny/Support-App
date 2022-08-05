<?php

use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//public routes for auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//private routes for use ticket system
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('/tickets')->group(function () {
        Route::get('/', [TicketController::class, 'getAllTickets'])->name('getAllTickets');
        Route::put('/{ticketId}', [TicketController::class, 'updateTicket'])->name('updateTicket');
        Route::delete('/{ticketId}', [TicketController::class, 'deleteTicket'])->name('deleteTicket');
        Route::post('/', [TicketController::class, 'addNewTicket'])->name('addNewTicket');
        Route::get('/messages', [MessageController::class, 'showAllMessages'])->name('showAllMessages');
        Route::prefix('/{ticketId}')->group(function () {
            Route::get('/', [TicketController::class, 'showTicket'])->name('showTicket');
            Route::prefix('/messages')->group(function () {
                Route::get('/', [MessageController::class, 'showTicketMessages'])
                    ->name('showTicketMessages');
                Route::get('/{messageId}', [MessageController::class, 'showSingleMessage'])
                    ->name('showSingleMessage');
                Route::post('/', [MessageController::class, 'addTicketMessage'])
                    ->name('addTicketMessage');
                Route::put('/{messageId}', [MessageController::class, 'updateTicketMessage'])
                    ->name('updateTicketMessage');
                Route::delete('/{messageId}', [MessageController::class, 'deleteTicketMessage'])
                    ->name('deleteTicketMessage');
            });
        });
    });

});
