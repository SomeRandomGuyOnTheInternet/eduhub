<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAttempt;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function indexForProfessor($module_id)
    {
        $module = Module::findOrFail($module_id);
        $quizzes = Quiz::where('module_id', $module_id)->get();
        return view('professor.quizzes.index', compact('module', 'quizzes'));
    }
    public function createForProfessor($module_id)
    {
        return view('professor.quizzes.create', compact('module_id'));
    }

    public function storeForProfessor(Request $request, $module_id)
    {
        try {
            $request->validate([
                'module_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'datetime' => 'required|date',
                'questions.*' => 'required',
                'options.*.*' => 'required',
                'correct_options.*' => 'required',
                'marks.*' => 'required|integer',
            ]);

            $quiz = Quiz::create([
                'module_id' => $module_id,
                'quiz_title' => $request->title,
                'quiz_description' => $request->description,
                'quiz_date' => $request->datetime,
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

            return redirect()->route('modules.quizzes.professor.index', ['module_id' => $module_id])
                ->with('success', 'Quiz created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('modules.quizzes.professor.create', ['module_id' => $module_id])
                ->with('error', $e->getMessage())
                ->setStatusCode(500);
        }
    }

    public function editForProfessor($module_id, $id)
    {
        $module = Module::findOrFail($module_id);
        $quiz = Quiz::with('questions')->where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail();
        return view('professor.quizzes.edit', compact('quiz', 'module'));
    }

    public function showForProfessor($module_id, $id)
    {
        $module = Module::findOrFail($module_id);
        $quiz = Quiz::with('questions')->where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail();
        return view('professor.quizzes.show', compact('quiz', 'module'));
    }

    public function updateForProfessor(Request $request, $module_id, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'questions.*' => 'required|string',
            'options.*.*' => 'required|string',
            'correct_options.*' => 'required|string',
            'marks.*' => 'required|integer',
        ]);

        try {
            // Find the quiz
            $quiz = Quiz::where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail();

            // Update quiz details
            $quiz->update([
                'quiz_title' => $validated['title'],
                'quiz_description' => $validated['description'],
                'quiz_date' => $validated['date'],
            ]);

            // Delete existing questions to replace with updated ones
            QuizQuestion::where('quiz_id', $quiz->quiz_id)->delete();

            // Create new questions
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

            return redirect()->route('modules.quizzes.professor.index', ['module_id' => $module_id])
                ->with('success', 'Quiz updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('modules.quizzes.professor.edit', ['module_id' => $module_id, 'id' => $id])
                ->with('error', $e->getMessage())
                ->setStatusCode(500);
        }
    }


    public function destroyForProfessor($module, $id)
    {
        $quiz = Quiz::where('module', $module)->findOrFail($id);
        $quiz->delete();

        return redirect()->route('modules.quizzes.professor.index', ['module' => $module])
            ->with('success', 'Quiz deleted successfully.');
    }

    public function indexForStudent($module_id)
    {
        $module = Module::findOrFail($module_id);
        $quizzes = Quiz::where('module_id', $module_id)->get();
        $completedQuizzes = QuizAttempt::where('user_id', Auth::id())
            ->whereHas('quiz', function ($query) use ($module_id) {
                $query->where('module_id', $module_id);
            })
            ->with('quiz')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($completedQuizzes as $attempt) {
            $totalMarks = $this->calculateTotalMarks($attempt->quiz_id);
            $attempt->score = $attempt->total_marks . '/' . $totalMarks;
            $attempt->grade = $this->calculateGrade(($attempt->total_marks / $totalMarks) * 100);
        }

        return view('student.quizzes.index', compact('module', 'quizzes', 'completedQuizzes'));
    }

    public function showForStudent($module_id, $id)
    {
        $module = Module::findOrFail($module_id);
        $quiz = Quiz::with('questions')->where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail();
        return view('student.quizzes.show', compact('quiz', 'module'));
    }

    private function calculateTotalMarks($quiz_id)
    {
        return QuizQuestion::where('quiz_id', $quiz_id)->sum('marks');
    }

    private function calculateGrade($percentage)
    {
        if ($percentage >= 85) {
            return 'A+';
        } elseif ($percentage >= 80) {
            return 'A';
        } elseif ($percentage >= 75) {
            return 'A-';
        } elseif ($percentage >= 70) {
            return 'B+';
        } elseif ($percentage >= 65) {
            return 'B';
        } elseif ($percentage >= 60) {
            return 'B-';
        } elseif ($percentage >= 55) {
            return 'C+';
        } elseif ($percentage >= 50) {
            return 'C';
        } elseif ($percentage >= 45) {
            return 'D+';
        } elseif ($percentage >= 40) {
            return 'D';
        } else {
            return 'F';
        }
    }

    public function attempt(Request $request, $module_id, $id)
    {
        $request->validate([
            'answers.*' => 'required',
        ]);

        $user = Auth::user();
        $quiz = Quiz::where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail();

        $totalMarks = 0;

        $quizAttempt = QuizAttempt::create([
            'quiz_id' => $quiz->quiz_id,
            'user_id' => $user->user_id,
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
                'user_id' => $user->user_id,
                'submission_answer' => $submittedAnswer,
            ]);
        }

        $quizAttempt->update(['total_marks' => $totalMarks]);

        return redirect()->route('modules.quizzes.student.index', ['module_id' => $module_id])
            ->with('success', 'Quiz submitted successfully!');
    }
}