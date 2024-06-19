<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Quizzes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Quizzes</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#active" data-toggle="tab">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#completed" data-toggle="tab">Completed</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="active">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Grade</th>
                            <th>Points Gained</th>
                            <th>Feedback</th>
                            <th>Time Attempted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quizAttempts as $attempt)
                            <tr>
                                <td>{{ $attempt->quiz->quiz_title }}</td>
                                <td>{{ $attempt->grade ?? '-' }}</td>
                                <td>{{ $attempt->total_marks }}</td>
                                <td>{{ $attempt->feedback ?? '-' }}</td>
                                <td>{{ $attempt->created_at->format('h:ia, d M') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="completed">
                <p>Completed quizzes will be displayed here.</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
