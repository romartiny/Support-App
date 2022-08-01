<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::factory()->createMany([
            ['title' => 'Problem with name?', 'question' => 'How to edit my name?',
                'status' => 'frozen', 'created_at' => '12', 'updated_at' => '01'],
            ['title' => 'Problem with surname?', 'question' => 'How to edit my surname?',
                'status' => 'completed', 'created_at' => '12', 'updated_at' => '01'],
            ['title' => 'Problem with age?', 'question' => 'How to edit my age?',
                'status' => 'uncompleted', 'created_at' => '12', 'updated_at' => '01'],
        ]);
    }
}
