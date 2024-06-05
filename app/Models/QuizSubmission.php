<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    protected $table = 'quiz_submissions';
    protected $primaryKey = 'quiz_submission_id';
    protected $fillable = ['quiz_questions_id', 'user_id', 'submission_answer'];

    public function quiz_question()
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_questions_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
