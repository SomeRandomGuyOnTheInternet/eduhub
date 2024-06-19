<!-- resources/views/news/index.blade.php -->
@extends('layouts.base')
@section('news')
<!DOCTYPE html>
<html>
<head>
    <title>News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .news-card {
            margin-bottom: 1.5rem;
        }
        .news-header {
            background-color: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }
        .edit-delete-buttons {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
@php
    $moduleId = request()->route('moduleId');
@endphp

@if (Auth::user()->user_type == 'professor')
<a href="{{ route('news.create', ['moduleId' => $moduleId]) }}" class="btn btn-primary mb-4">Create News</a>
@endif

<div class="container mt-5">
    <h1 class="mb-4">News</h1>
    <div class="row">
        <div class="col-md-8">
        <!-- Inside your news index view -->
        @foreach ($newsItems as $news)
            <div class="card news-card">
                <div class="news-header">
                    <div class="edit-delete-buttons">
                        @if (Auth::user()->user_type == 'professor')
                        <a href="{{ route('news.edit', ['newsId' => $news->news_id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('news.delete', ['newsId' => $news->news_id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endif
                    </div>
                    <h5 class="card-title">{{ $news->news_title }}</h5>
                    @if (!empty($news->updated_at))
                    <p class="card-text"><small class="text-muted">Updated at: {{ $news->updated_at }}</small></p>
                    @else
                    <p class="card-text"><small class="text-muted">Created at: {{ $news->created_at }}</small></p>
                    @endif
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $news->news_description }}</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
</body>
</html>
