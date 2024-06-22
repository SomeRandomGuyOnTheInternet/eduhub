<!-- resources/views/professor/content/create_content.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Content</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Create Content for Module: {{ $module->module_name }}</h2>
        <form action="{{ route('modules.content.professor.store-content', ['module_id' => $module->module_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="module_folder_id">Folder</label>
                <select class="form-control" id="module_folder_id" name="module_folder_id" required>
                    @foreach ($folders as $folder)
                        <option value="{{ $folder->module_folder_id }}">{{ $folder->folder_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Content Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="file_path">Upload File</label>
                <input type="file" class="form-control-file" id="file_path" name="file_path" required>
            </div>
            <button type="submit" class="btn btn-success">Create Content</button>
        </form>
    </div>
</body>
</html>
