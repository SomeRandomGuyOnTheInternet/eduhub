<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>{{ $module->module_name }} - Content</h2>
        
        <ul class="nav nav-tabs" id="contentTabs" role="tablist">
            @foreach ($folders as $index => $folder)
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if($index == 0) active @endif" id="tab-{{ $folder->module_folder_id }}" data-toggle="tab" href="#folder-{{ $folder->module_folder_id }}" role="tab" aria-controls="folder-{{ $folder->module_folder_id }}" aria-selected="true">{{ $folder->folder_name }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="contentTabsContent">
            @foreach ($folders as $index => $folder)
                <div class="tab-pane fade @if($index == 0) show active @endif" id="folder-{{ $folder->module_folder_id }}" role="tabpanel" aria-labelledby="tab-{{ $folder->module_folder_id }}">
                    <div class="mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Time Uploaded</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($folder->contents as $content)
                                    <tr>
                                        <td>{{ $content->title }}</td>
                                        <td>{{ strtoupper(pathinfo($content->file_path, PATHINFO_EXTENSION)) }}</td>
                                        <td>{{ $content->created_at->format('h:iA, d M') }}</td>
                                        <td>
                                            <a href="{{ route('modules.content.professor.edit-content', ['module_id' => $module->module_id, 'content_id' => $content->content_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('modules.content.professor.delete-content', ['module_id' => $module->module_id, 'content_id' => $content->content_id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form action="{{ route('modules.content.professor.delete-folder', ['module_id' => $module->module_id, 'folder_id' => $folder->module_folder_id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete Folder</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
