<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAttempt;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        try {
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
                    'correct_option' => substr($request->correct_options[$index], -1), // Ensure it's a single character
                    'marks' => $request->marks[$index],
                ]);
            }

            return redirect()->route('quizzes.create')->with('success', 'Quiz created successfully.');

        } catch (\Exception $e) {
            return redirect()->route('quizzes.create')->with('error', $e->getMessage())->setStatusCode(500);
        }
    }

    public function show(Quiz $quiz)
    {
        try {
            $questions = $quiz->questions;
            return response()->view('quizzes.show', compact('quiz', 'questions'), 200);

        } catch (\Exception $e) {
            return response()->view('quizzes.show', ['error' => 'Quiz not found.'], 404);
        }
    }

    public function attempt(Request $request, Quiz $quiz)
    {
        try {
            $request->validate([
                'answers.*' => 'required',
            ]);

            $user = Auth::user();
            if (!$user) {
                return redirect()->route('quizzes.show', $quiz)->with('error', 'User not authenticated.')->setStatusCode(401);
            }

            $totalMarks = 0;

            $quizAttempt = QuizAttempt::create([
                'quiz_id' => $quiz->quiz_id,
                'user_id' => $user->id,
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
                    'user_id' => $user->id,
                    'submission_answer' => $submittedAnswer,
                ]);
            }

            $quizAttempt->update(['total_marks' => $totalMarks]);

            return redirect()->route('quizzes.show', $quiz)->with('success', 'Quiz submitted successfully!')->setStatusCode(200);

        } catch (\Exception $e) {
            return redirect()->route('quizzes.show', $quiz)->with('error', $e->getMessage())->setStatusCode(500);
        }
    }

    public function userQuizzes()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('user.quizzes')->with('error', 'User not authenticated.')->setStatusCode(401);
            }

            // Fetching the quizzes attempted by the user
            $quizAttempts = QuizAttempt::with('quiz')
                ->where('user_id', $user->id)
                ->get();

            return response()->view('quizzes.user_quizzes', compact('quizAttempts'), 200);

        } catch (\Exception $e) {
            return response()->view('quizzes.user_quizzes', ['error' => $e->getMessage()], 500);
        }
    }
}