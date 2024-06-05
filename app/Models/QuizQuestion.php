<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';
    protected $primaryKey = 'quiz_question_id';
    protected $fillable = ['quiz_id', 'question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option', 'marks'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
