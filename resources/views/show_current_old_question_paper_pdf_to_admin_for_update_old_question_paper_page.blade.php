<!-- show_current_old_question_paper_pdf_to_admin_for_update_old_question_paper_page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
</head>
<body>
    <div class="pdf-viewer-container">
        <embed src="{{ asset('storage/' . $current_old_question_pdf_to_show->material) }}" width="100%" height="800px" type='application/pdf'>
    </div>
</body>
</html>