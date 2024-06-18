@extends('layouts.base')

@section('content')
<div class="container">
    <h2>{{ $moduleName }}</h2>
    <h1>Module Contents</h1>
    @if ($moduleContents->isEmpty())
        <p>No contents found for this module folder.</p>
    @else
        <div class="list-group">
            @foreach ($moduleContents as $content)
                <div class="list-group-item">
                    <h4>{{ $content->title }}</h4>
                    <p>{{ $content->description }}</p>
                    <p>File Path: {{ $content->file_path }}</p>
                    <p>Upload Date: {{ $content->upload_date }}</p>
                    <p>Created At: {{ $content->created_at->format('d M Y, H:i') }}</p>
                    <p>Updated At: {{ $content->updated_at->format('d M Y, H:i') }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
