<!-- resources/views/news/index.blade.php -->

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
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">News</h1>
    <div class="row">
        <div class="col-md-8">
            @foreach ($newsItems as $news)
                <div class="card news-card">
                    <div class="news-header">
                        <h5 class="card-title">{{ $news->news_title }}</h5>
                        <p class="card-text"><small class="text-muted">{{ $news->created_at->format('d M Y') }}</small></p>
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
