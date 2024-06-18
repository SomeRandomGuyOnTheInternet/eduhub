<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attempt Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>{{ $quiz->quiz_title }}</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('quizzes.attempt', $quiz) }}" method="POST">
            @csrf
            @foreach ($questions as $index => $question)
                <div class="mb-3">
                    <h5>{{ $index + 1 }}. {{ $question->question }}</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $index }}]" id="option_a_{{ $index }}" value="A" required>
                        <label class="form-check-label" for="option_a_{{ $index }}">{{ $question->option_a }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $index }}]" id="option_b_{{ $index }}" value="B" required>
                        <label class="form-check-label" for="option_b_{{ $index }}">{{ $question->option_b }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $index }}]" id="option_c_{{ $index }}" value="C" required>
                        <label class="form-check-label" for="option_c_{{ $index }}">{{ $question->option_c }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $index }}]" id="option_d_{{ $index }}" value="D" required>
                        <label class="form-check-label" for="option_d_{{ $index }}">{{ $question->option_d }}</label>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
