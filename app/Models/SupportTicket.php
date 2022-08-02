<?php

namespace App\Models;

use App\Http\Resources\MessageResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'question',
        'status',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d h:m:s'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function supportAnswersList()
    {
        return $this->hasMany(MessageTicket::class);
    }

    public function userQuestionList()
    {
        return $this->hasMany(UserQuestion::class);
    }

    public function getTicket(int $id)
    {
        return SupportTicket::findOrFail($id);
    }

    public function getAnswer(int $id)
    {
        return SupportTicket::where('support_tickets_id', $id);
    }
}
