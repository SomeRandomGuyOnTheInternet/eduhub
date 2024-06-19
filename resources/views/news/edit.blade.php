<!-- resources/views/news/edit.blade.php -->
@extends('layouts.base')

@section('content')
<div class="container">
    <h1>Edit News</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('news.update', ['newsId' => $newsItem->news_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="news_title">Title:</label>
            <input type="text" name="news_title" id="news_title" class="form-control" value="{{ $newsItem->news_title }}">
        </div>

        <div class="form-group">
            <label for="news_description">Description:</label>
            <textarea name="news_description" id="news_description" class="form-control" rows="5">{{ $newsItem->news_description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update News</button>
    </form>
</div>
@endsection
