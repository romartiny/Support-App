<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'support_tickets_id',
        'message_user_name',
        'message_user_message',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d h:m:s'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function getAnswer(int $id)
    {
        return MessageTicket::all()->where('support_tickets_id', $id);
//        return MessageTicket::where('support_tickets_id', $id);
    }

    public function supportAnswersList(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MessageTicket::class);
    }
}
