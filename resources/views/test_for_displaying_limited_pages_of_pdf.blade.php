<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limited Pages</title>
</head>
<body>
    @foreach ($images as $image)
        @php
            $relative_path = str_replace('C:\\Users\\hp\\OneDrive\\Documents\\For_Laravel\\ProjectPhase\\public\\', '', $image);
        @endphp
        <h1>{{ $relative_path }}</h1>
        <img src="{{ asset($relative_path) }}" alt="Page" style = "height: 200px">
    @endforeach
</body>
</html>
