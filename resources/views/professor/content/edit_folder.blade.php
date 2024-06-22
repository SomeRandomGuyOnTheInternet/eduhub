<!-- resources/views/professor/content/edit_folder.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Folder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Folder for Module: {{ $module->module_name }}</h2>
        <form
            action="{{ route('modules.content.professor.update-folder', ['module_id' => $module->module_id, 'folder_id' => $folder->module_folder_id]) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="folder_name">Folder Name</label>
                <input type="text" class="form-control" id="folder_name" name="folder_name"
                    value="{{ $folder->folder_name }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update Folder</button>
        </form>
    </div>
</body>

</html>