@extends('layouts.app')

@section('title', 'Learning Content')

@section('content')
<body>
    <div class="container mt-5">
        <h2>Quiz: {{ $quiz->quiz_title }}</h2>
        <p><strong>Module:</strong> {{ $module->module_name }}</p>
        <p><strong>Description:</strong> {{ $quiz->quiz_description }}</p>
        <p><strong>Date:</strong> {{ $quiz->quiz_date }}</p>

        <h3>Questions</h3>
        @foreach($quiz->questions as $index => $question)
            <div class="question-group">
                <hr>
                <h4>Question {{ $index + 1 }}</h4>
                <p>{{ $question->question }}</p>
                <ul>
                    <li>{{ $question->option_a }}</li>
                    <li>{{ $question->option_b }}</li>
                    <li>{{ $question->option_c }}</li>
                    <li>{{ $question->option_d }}</li>
                </ul>
                <p><strong>Correct Option:</strong> {{ $question->correct_option }}</p>
                <p><strong>Marks:</strong> {{ $question->marks }}</p>
            </div>
        @endforeach
    </div>
</body>
@endsection
