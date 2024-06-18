<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAttempt;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'questions.*' => 'required',
            'options.*.*' => 'required',
            'correct_options.*' => 'required',
            'marks.*' => 'required|integer',
        ]);

        $quiz = Quiz::create([
            'module_id' => $request->module_id,
            'quiz_title' => $request->title,
            'quiz_description' => $request->description,
            'quiz_date' => $request->date,
        ]);

        foreach ($request->questions as $index => $question) {
            QuizQuestion::create([
                'quiz_id' => $quiz->quiz_id,
                'question' => $question,
                'option_a' => $request->options[$index][0],
                'option_b' => $request->options[$index][1],
                'option_c' => $request->options[$index][2],
                'option_d' => $request->options[$index][3],
                'correct_option' => substr($request->correct_options[$index], -1),
                'marks' => $request->marks[$index],
            ]);
        }

        return redirect()->route('quizzes.create')->with('success', 'Quiz created successfully.');
    }

    public function show(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('quizzes.show', compact('quiz', 'questions'));
    }

    public function attempt(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answers.*' => 'required',
        ]);

        // Temporarily hardcoding the user ID for testing
        $userId = 1; // Replace 1 with the actual user ID for testing
        $totalMarks = 0;

        $quizAttempt = QuizAttempt::create([
            'quiz_id' => $quiz->quiz_id,
            'user_id' => $userId,
            'total_marks' => 0,
        ]);

        foreach ($quiz->questions as $index => $question) {
            $submittedAnswer = $request->answers[$index];
            $correctAnswer = $question->correct_option;

            $isCorrect = $submittedAnswer === $correctAnswer;
            $marksObtained = $isCorrect ? $question->marks : 0;
            $totalMarks += $marksObtained;

            QuizSubmission::create([
                'quiz_questions_id' => $question->quiz_questions_id,
                'user_id' => $userId,
                'submission_answer' => $submittedAnswer,
            ]);
        }

        $quizAttempt->update(['total_marks' => $totalMarks]);

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Quiz submitted successfully!');
    }

    public function userQuizzes()
    {
        // Temporarily hardcoding the user ID for testing
        $userId = 1; // Replace 1 with the actual user ID for testing

        // Fetching the quizzes attempted by the user
        $quizAttempts = QuizAttempt::with('quiz')
            ->where('user_id', $userId)
            ->get();

        return view('quizzes.user_quizzes', compact('quizAttempts'));
    }
}