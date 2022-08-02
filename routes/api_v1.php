<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\MessageController;
use Illuminate\Support\Facades\Route;


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
        });
    });

});

// for ticket
//Route::get('/tickets', [TicketController::class, 'index'])->name('index');
//Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('show');
//Route::post('/tickets', [TicketController::class, 'store'])->name('store');
//Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('update');
//Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('destroy');

// for messages
//Route::get('/tickets/messages', [MessageController::class, 'index'])->name('index');
//Route::get('/tickets/{id}/messages/{num}', [MessageController::class, 'show'])->name('show');
Route::post('/tickets/{id}/messages', [MessageController::class, 'store'])->name('store');

