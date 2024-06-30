@extends('layouts.app')

@section('title', 'Learning Content')

@section('content')

<body>
    <div class="container mt-5">
        <h2>{{ $module->module_name }} - Content</h2>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach ($folders as $folder)
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $folder->module_folder_id }}"
                        data-toggle="tab" href="#folder-{{ $folder->module_folder_id }}" role="tab"
                        aria-controls="folder-{{ $folder->module_folder_id }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $folder->folder_name }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @foreach ($folders as $folder)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                    id="folder-{{ $folder->module_folder_id }}" role="tabpanel"
                    aria-labelledby="tab-{{ $folder->module_folder_id }}">
                    <form
                        action="{{ route('modules.content.student.toggle-favourite', ['module_id' => $module->module_id]) }}"
                        method="POST">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all-{{ $folder->module_folder_id }}"></th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Time Uploaded</th>
                                    <th>Favourite</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($folder->contents as $content)
                                    <tr>
                                        <td><input type="checkbox" name="content_ids[]" value="{{ $content->content_id }}"
                                                class="content-checkbox-{{ $folder->module_folder_id }}"></td>

                                        <td><a
                                                href="{{ route('modules.content.student.show', ['module_id' => $module->module_id, 'content_id' => $content->content_id]) }}">{{ $content->title }}</a>
                                        </td>

                                        <td>{{ strtoupper(pathinfo($content->file_path, PATHINFO_EXTENSION))}}</td>
                                        <td>{{ $content->created_at->format('h:iA, d M') }}</td>
                                        <td>
                                            @if ($content->is_favourited)
                                                <span class="favourite-icon">★</span>
                                            @else
                                                <span class="favourite-icon">☆</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Toggle Favourite</button>
                    </form>
                    <form action="{{ route('modules.content.student.download', ['module_id' => $module->module_id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="content_ids[]" class="download-content-ids">
                        <button type="submit" class="btn btn-success mt-2">Download</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach ($folders as $folder)
                document.getElementById('select-all-{{ $folder->module_folder_id }}').addEventListener('change', function () {
                    const checkboxes = document.querySelectorAll('.content-checkbox-{{ $folder->module_folder_id }}');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });

                document.querySelector('.download-content-ids').value = Array.from(document.querySelectorAll('.content-checkbox-{{ $folder->module_folder_id }}:checked')).map(cb => cb.value).join(',');
            @endforeach
        });
    </script>
</body>

</html>
@endsection