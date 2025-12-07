<!-- show_current_thumbnail_image_of_subscription_to_admin -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>image Viewer</title>
    <style>
        .pdf-viewer-container{
            text-align: center;
            align-items: center;
            justify-content: center;
        }
        #main-heading{
            color: #454545;
            border: 1px solid #454545;
            padding: 5px 0;
            border-radius: 8px;
            font-size: 40px;
            width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="pdf-viewer-container">
        <h2 id="main-heading" style = "margin-top: 20px;">Subscription Thumbnail Image</h2>
        <embed src="{{ asset('storage/' . $subscription_to_show->subscription_thumnail_image) }}" style = "border: 2px solid #454545; margin-top: 20px; justify-content: center; align-items: center; text-align: center; margin-bottom: 20px;" width="98%" height="500px;" type='application/pdf'>
    </div>
</body>
</html>