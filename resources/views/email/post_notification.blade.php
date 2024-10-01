<!DOCTYPE html>
<html>
<head>
    <title>New Post Notification</title>
</head>
<body>
    <h1>New Post: {{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p>Visit <a href="{{ url('/posts/'.$post->id) }}">here</a> to read more.</p>
</body>
</html>
