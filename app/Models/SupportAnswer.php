<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_name',
        'support_message',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d h:m:s'
    ];

    protected $hidden = [
        'updated_at'
    ];

//    public function deleteAnswers($id)
//    {
//        return SupportQuestion::find($id)->delete();
//    }

    public function getAnswer(int $id)
    {
        return SupportAnswer::where('support_question_id', $id);
    }
}
