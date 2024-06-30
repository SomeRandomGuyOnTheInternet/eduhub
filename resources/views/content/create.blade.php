@extends('layouts.base')

@section('content')

<h2>{{ $moduleName }}</h2>

<h1>Contents</h1>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Folders here, MR TERATOMA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('modules.content', ['moduleFolderId' => 1]) }}">Lectures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('modules.content', ['moduleFolderId' => 2]) }}">Tutorials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('modules.content', ['moduleFolderId' => 3]) }}">Practicals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('modules.content', ['moduleFolderId' => 4]) }}">Favourites</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@if (Auth::user()->role == 'professor')
<h1> hello professor </h1> 
    <div class="upload-section">
        <h3>Upload Module Content</h3>
        <form action="{{ route('modules.content.store', ['moduleFolderId' => $moduleFolderId]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Enter content title" required>
            <textarea name="description" placeholder="Enter content description" required></textarea>
            <input type="file" name="file" required>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>
    </div>
@endif

@if ($moduleContents->isEmpty())
    <p>No contents found for this module folder.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Time Uploaded</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moduleContents as $content)
                <tr>
                    <td>{{ $content->title }}</td>
                    <td>{{ pathinfo($content->file_path, PATHINFO_EXTENSION) }}</td>
                    <td>{{ $content->upload_date }}</td>
                    <td>
                        <a href="{{ Storage::url($content->file_path) }}" target="_blank">Open</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
