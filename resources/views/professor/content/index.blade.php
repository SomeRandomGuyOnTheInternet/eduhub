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
        @foreach($folders as $folder)
            <h3>{{ $folder->folder_name }}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Time Uploaded</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($folder->contents as $content)
                        <tr>
                            <td>{{ $content->title }}</td>
                            <td>
                                @php
                                    // Extract the file extension
                                    $fileExtension = pathinfo($content->file_path, PATHINFO_EXTENSION);
                                @endphp
                                {{ strtoupper($fileExtension) }}
                            </td>
                            <td>{{ $content->created_at->format('h:iA, d M') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</body>
</html>
