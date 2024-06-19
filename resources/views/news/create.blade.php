<!-- resources/views/news/create.blade.php -->
@section('title', 'Create News')
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div class="container mt-4">
    <h1>Create News</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $moduleId = request()->route('moduleId');
    @endphp

    <form action="{{ route('news.store') }}" method="POST">
        @csrf
        <input type="hidden" name="module_id" value="{{$moduleId}}"> <!-- module id to be dynamic and taken from session -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="news_title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="news_description" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Create News</button>
    </form>
</div>

