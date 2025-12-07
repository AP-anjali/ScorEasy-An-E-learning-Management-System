<!DOCTYPE html>
<html>
<head>
    <title>Video Example</title>
</head>
<body style = "background: pink; text-align: center; padding-top: 20px;">

<h2>test for stopping video at 3 sec :)</h2>

<video id="myVideo" height = "500" controls>
    <source src="{{ asset('img/GPSC Exam Full Information (Hindi).mp4') }}" type="video/mp4">
    Your browser does not support the video tag
</video>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var video = document.getElementById('myVideo');

    // Function to navigate to subscription page
    function navigateToSubscriptionPage() 
    {
        window.location.href = "{{ route('showing_all_Subscriptions_at_main_page') }}";
    }

    // Event listener for timeupdate
    video.addEventListener('timeupdate', function() {
        var currentTime = video.currentTime;
        // Check if 5 minutes have elapsed
        if (currentTime >= 3) { // 300 seconds = 5 minutes
            video.pause(); // Pause the video
            navigateToSubscriptionPage(); // Navigate to subscription page
        }
    });
});
</script>

</body>
</html>
