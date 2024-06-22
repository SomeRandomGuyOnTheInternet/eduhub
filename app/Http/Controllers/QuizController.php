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
     // Display a list of quizzes for the professor within a module.
     public function indexForProfessor($module_id)
     {
         $module = Module::findOrFail($module_id); // Finds the module by its ID, or fails with a 404 error if not found.
         $quizzes = Quiz::where('module_id', $module_id)->get(); // Retrieves all quizzes associated with the module.
         return view('professor.quizzes.index', compact('module', 'quizzes')); // Returns the 'index' view for quizzes, passing the module and quizzes data.
     }
 
     // Show the form to create a new quiz for the professor.
     public function createForProfessor($module_id)
     {
         return view('professor.quizzes.create', compact('module_id')); // Returns the 'create' view for quizzes, passing the module ID.
     }
 
     // Store the new quiz created by the professor.
     public function storeForProfessor(Request $request, $module_id)
     {
         try {
             $request->validate([ // Validates the incoming request data.
                 'module_id' => 'required', // The module ID is required.
                 'title' => 'required', // The quiz title is required.
                 'description' => 'required', // The quiz description is required.
                 'datetime' => 'required|date', // The quiz date and time are required and must be a valid date.
                 'questions.*' => 'required', // Each question is required.
                 'options.*.*' => 'required', // Each option for each question is required.
                 'correct_options.*' => 'required', // Each correct option is required.
                 'marks.*' => 'required|integer', // Each mark is required and must be an integer.
             ]);
 
             $quiz = Quiz::create([ // Creates a new quiz.
                 'module_id' => $module_id, // Sets the module ID.
                 'quiz_title' => $request->title, // Sets the quiz title.
                 'quiz_description' => $request->description, // Sets the quiz description.
                 'quiz_date' => $request->datetime, // Sets the quiz date.
             ]);
 
             foreach ($request->questions as $index => $question) { // Iterates over each question.
                 QuizQuestion::create([ // Creates a new quiz question.
                     'quiz_id' => $quiz->quiz_id, // Sets the quiz ID.
                     'question' => $question, // Sets the question text.
                     'option_a' => $request->options[$index][0], // Sets option A.
                     'option_b' => $request->options[$index][1], // Sets option B.
                     'option_c' => $request->options[$index][2], // Sets option C.
                     'option_d' => $request->options[$index][3], // Sets option D.
                     'correct_option' => substr($request->correct_options[$index], -1), // Sets the correct option.
                     'marks' => $request->marks[$index], // Sets the marks for the question.
                 ]);
             }
 
             return redirect()->route('modules.quizzes.professor.index', ['module_id' => $module_id])
                 ->with('success', 'Quiz created successfully.'); // Redirects to the quizzes index with a success message.
         } catch (\Exception $e) {
             return redirect()->route('modules.quizzes.professor.create', ['module_id' => $module_id])
                 ->with('error', $e->getMessage())
                 ->setStatusCode(500); // Redirects to the quiz creation page with an error message.
         }
     }
 
     // Show the form to edit an existing quiz for the professor.
     public function editForProfessor($module_id, $id)
     {
         $module = Module::findOrFail($module_id); // Finds the module by its ID, or fails with a 404 error if not found.
         $quiz = Quiz::with('questions')->where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail(); // Finds the quiz by its ID and module ID, including its questions.
         return view('professor.quizzes.edit', compact('quiz', 'module')); // Returns the 'edit' view for quizzes, passing the quiz and module data.
     }
 
     // Show a specific quiz for the professor.
     public function showForProfessor($module_id, $id)
     {
         $module = Module::findOrFail($module_id); // Finds the module by its ID, or fails with a 404 error if not found.
         $quiz = Quiz::with('questions')->where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail(); // Finds the quiz by its ID and module ID, including its questions.
         return view('professor.quizzes.show', compact('quiz', 'module')); // Returns the 'show' view for quizzes, passing the quiz and module data.
     }
 
     // Update an existing quiz for the professor.
     public function updateForProfessor(Request $request, $module_id, $id)
     {
         $validated = $request->validate([ // Validates the incoming request data.
             'title' => 'required|string|max:255', // The quiz title is required, must be a string, and cannot exceed 255 characters.
             'description' => 'nullable|string', // The quiz description is optional and must be a string.
             'date' => 'required|date', // The quiz date is required and must be a valid date.
             'questions.*' => 'required|string', // Each question is required and must be a string.
             'options.*.*' => 'required|string', // Each option for each question is required and must be a string.
             'correct_options.*' => 'required|string', // Each correct option is required and must be a string.
             'marks.*' => 'required|integer', // Each mark is required and must be an integer.
         ]);
 
         try {
             $quiz = Quiz::where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail(); // Finds the quiz by its ID and module ID, or fails with a 404 error if not found.
 
             $quiz->update([ // Updates the quiz details.
                 'quiz_title' => $validated['title'], // Sets the quiz title.
                 'quiz_description' => $validated['description'], // Sets the quiz description.
                 'quiz_date' => $validated['date'], // Sets the quiz date.
             ]);
 
             QuizQuestion::where('quiz_id', $quiz->quiz_id)->delete(); // Deletes the existing questions for the quiz.
 
             foreach ($request->questions as $index => $question) { // Iterates over each question.
                 QuizQuestion::create([ // Creates a new quiz question.
                     'quiz_id' => $quiz->quiz_id, // Sets the quiz ID.
                     'question' => $question, // Sets the question text.
                     'option_a' => $request->options[$index][0], // Sets option A.
                     'option_b' => $request->options[$index][1], // Sets option B.
                     'option_c' => $request->options[$index][2], // Sets option C.
                     'option_d' => $request->options[$index][3], // Sets option D.
                     'correct_option' => substr($request->correct_options[$index], -1), // Sets the correct option.
                     'marks' => $request->marks[$index], // Sets the marks for the question.
                 ]);
             }
 
             return redirect()->route('modules.quizzes.professor.index', ['module_id' => $module_id])
                 ->with('success', 'Quiz updated successfully.'); // Redirects to the quizzes index with a success message.
         } catch (\Exception $e) {
             return redirect()->route('modules.quizzes.professor.edit', ['module_id' => $module_id, 'id' => $id])
                 ->with('error', $e->getMessage())
                 ->setStatusCode(500); // Redirects to the quiz edit page with an error message.
         }
     }
 
     // Delete a quiz for the professor.
     public function destroyForProfessor($module, $id)
     {
         $quiz = Quiz::where('module', $module)->findOrFail($id); // Finds the quiz by its module and ID, or fails with a 404 error if not found.
         $quiz->delete(); // Deletes the quiz.
 
         return redirect()->route('modules.quizzes.professor.index', ['module' => $module])
             ->with('success', 'Quiz deleted successfully.'); // Redirects to the quizzes index with a success message.
     }
 
     // Display a list of quizzes for the student within a module.
     public function indexForStudent($module_id)
     {
         $module = Module::findOrFail($module_id); // Finds the module by its ID, or fails with a 404 error if not found.
         $quizzes = Quiz::where('module_id', $module_id)->get(); // Retrieves all quizzes associated with the module.
         $completedQuizzes = QuizAttempt::where('user_id', Auth::id()) // Retrieves all quiz attempts by the authenticated user.
             ->whereHas('quiz', function ($query) use ($module_id) {
                 $query->where('module_id', $module_id); // Ensures the quiz is within the specified module.
             })
             ->with('quiz') // Includes the quiz details with the attempt.
             ->orderBy('created_at', 'desc') // Orders the attempts by creation date, descending.
             ->get();
 
         foreach ($completedQuizzes as $attempt) { // Iterates over each completed quiz attempt.
             $totalMarks = $this->calculateTotalMarks($attempt->quiz_id); // Calculates the total marks for the quiz.
             $attempt->score = $attempt->total_marks . '/' . $totalMarks; // Sets the score for the attempt.
             $attempt->grade = $this->calculateGrade(($attempt->total_marks / $totalMarks) * 100); // Sets the grade for the attempt.
         }
 
         return view('student.quizzes.index', compact('module', 'quizzes', 'completedQuizzes')); // Returns the 'index' view for student quizzes, passing the module, quizzes, and completed attempts data.
     }
 
     // Show a specific quiz for the student.
     public function showForStudent($module_id, $id)
     {
         $module = Module::findOrFail($module_id); // Finds the module by its ID, or fails with a 404 error if not found.
         $quiz = Quiz::with('questions')->where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail(); // Finds the quiz by its ID and module ID, including its questions.
         return view('student.quizzes.show', compact('quiz', 'module')); // Returns the 'show' view for quizzes, passing the quiz and module data.
     }
 
     // Helper method to calculate the total marks for a quiz.
     private function calculateTotalMarks($quiz_id)
     {
         return QuizQuestion::where('quiz_id', $quiz_id)->sum('marks'); // Sums the marks for all questions in the quiz.
     }
 
     // Helper method to calculate the grade based on a percentage.
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
 
     // Process a student's quiz attempt.
     public function attempt(Request $request, $module_id, $id)
     {
         $request->validate([
             'answers.*' => 'required', // Validates that each answer is provided.
         ]);
 
         $user = Auth::user(); // Retrieves the authenticated user.
         $quiz = Quiz::where('quiz_id', $id)->where('module_id', $module_id)->firstOrFail(); // Finds the quiz by its ID and module ID, or fails with a 404 error if not found.
 
         $totalMarks = 0;
 
         $quizAttempt = QuizAttempt::create([ // Creates a new quiz attempt.
             'quiz_id' => $quiz->quiz_id, // Sets the quiz ID.
             'user_id' => $user->user_id, // Sets the user ID.
             'total_marks' => 0, // Initializes the total marks.
         ]);
 
         foreach ($quiz->questions as $index => $question) { // Iterates over each question in the quiz.
             $submittedAnswer = $request->answers[$index]; // Retrieves the submitted answer.
             $correctAnswer = $question->correct_option; // Retrieves the correct answer.
 
             $isCorrect = $submittedAnswer === $correctAnswer; // Checks if the answer is correct.
             $marksObtained = $isCorrect ? $question->marks : 0; // Assigns marks if the answer is correct.
             $totalMarks += $marksObtained; // Updates the total marks.
 
             QuizSubmission::create([ // Creates a new quiz submission.
                 'quiz_questions_id' => $question->quiz_questions_id, // Sets the question ID.
                 'user_id' => $user->user_id, // Sets the user ID.
                 'submission_answer' => $submittedAnswer, // Sets the submitted answer.
             ]);
         }
 
         $quizAttempt->update(['total_marks' => $totalMarks]); // Updates the total marks for the quiz attempt.
 
         return redirect()->route('modules.quizzes.student.index', ['module_id' => $module_id])
             ->with('success', 'Quiz submitted successfully!'); // Redirects to the student quizzes index with a success message.
     }
}