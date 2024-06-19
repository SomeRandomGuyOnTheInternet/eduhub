<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Create Quiz</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('quizzes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="module_id">Module ID</label>
                <input type="number" class="form-control" id="module_id" name="module_id" required>
            </div>
            <div class="form-group">
                <label for="title">Title*</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description*</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date*</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div id="questions-container">
                <div class="question-group">
                    <div class="form-group">
                        <label for="question">Question 1</label>
                        <input type="text" class="form-control" name="questions[]" required>
                    </div>
                    <div class="form-group">
                        <label for="marks">Marks*</label>
                        <input type="number" class="form-control" name="marks[]" required>
                    </div>
                    <div class="form-group">
                        <label>Options</label>
                        <input type="text" class="form-control" name="options[0][]" placeholder="Option A" required>
                        <input type="text" class="form-control" name="options[0][]" placeholder="Option B" required>
                        <input type="text" class="form-control" name="options[0][]" placeholder="Option C" required>
                        <input type="text" class="form-control" name="options[0][]" placeholder="Option D" required>
                    </div>
                    <div class="form-group">
                        <label for="correct_option">Correct Option*</label>
                        <select class="form-control" name="correct_options[]" required>
                            <option value="A">Option A</option>
                            <option value="B">Option B</option>
                            <option value="C">Option C</option>
                            <option value="D">Option D</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="addQuestionBtn">Add New Question</button>
            <button type="submit" class="btn btn-success">Publish Quiz</button>
        </form>
    </div>

    <script>
        document.getElementById('addQuestionBtn').addEventListener('click', function() {
            const questionsContainer = document.getElementById('questions-container');
            const questionCount = document.querySelectorAll('.question-group').length;
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question-group');
            newQuestion.innerHTML = `
                <hr>
                <div class="form-group">
                    <label for="question">Question ${questionCount + 1}</label>
                    <input type="text" class="form-control" name="questions[]" required>
                </div>
                <div class="form-group">
                    <label for="marks">Marks*</label>
                    <input type="number" class="form-control" name="marks[]" required>
                </div>
                <div class="form-group">
                    <label>Options</label>
                    <input type="text" class="form-control" name="options[${questionCount}][]" placeholder="Option A" required>
                    <input type="text" class="form-control" name="options[${questionCount}][]" placeholder="Option B" required>
                    <input type="text" class="form-control" name="options[${questionCount}][]" placeholder="Option C" required>
                    <input type="text" class="form-control" name="options[${questionCount}][]" placeholder="Option D" required>
                </div>
                <div class="form-group">
                    <label for="correct_option">Correct Option*</label>
                    <select class="form-control" name="correct_options[]" required>
                        <option value="A">Option A</option>
                        <option value="B">Option B</option>
                        <option value="C">Option C</option>
                        <option value="D">Option D</option>
                    </select>
                </div>
            `;
            questionsContainer.appendChild(newQuestion);
        });
    </script>
</body>
</html>
