<!-- resources/views/professor/content/show.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>{{ $content->title }}</h2>
        <p>{{ $content->description }}</p>
        <p><strong>Type:</strong> {{ strtoupper(pathinfo($content->file_path, PATHINFO_EXTENSION)) }}</p>
        <p><strong>Time Uploaded:</strong> {{ $content->created_at->format('h:iA, d M Y') }}</p>

        <a href="{{ route('modules.content.professor.edit-content', ['module_id' => $module->module_id, 'content_id' => $content->content_id]) }}"
            class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('modules.content.professor.delete-content', ['module_id' => $module->module_id, 'content_id' => $content->content_id]) }}"
            method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
