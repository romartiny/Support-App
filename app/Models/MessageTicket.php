<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasMany;

class MessageTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'support_tickets_id',
        'user_name',
        'user_message',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d h:m:s'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function getTicketMessages(int $ticketId, int $messageId): Collection
    {
        return MessageTicket::all()
            ->where('support_tickets_id', $ticketId)
            ->where('id', $messageId);
    }

    public function getTicketMessage(int $id)
    {
        return MessageTicket::findOrFail($id);
    }

    public function deleteMessage($id)
    {
        return MessageTicket::where('support_tickets_id', $id)
            ->delete();
    }

//    public function supportAnswersList(): HasMany
//    {
//        return $this->hasMany(MessageTicket::class);
//    }

}
