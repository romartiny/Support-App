<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportQuestion extends Model
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

    public function answersList()
    {
        return $this->hasMany(SupportAnswer::class);
    }

    public function getQuestion(int $id)
    {
        return SupportQuestion::findOrFail($id);
    }
}
