<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
</head>
<body>
    <div class="pdf-viewer-container">
        <embed src="{{ asset('storage/' . $Old_Question_Paper_To_Open->material) }}" width="100%" height="800px" type='application/pdf'>
    </div>
</body>
</html>