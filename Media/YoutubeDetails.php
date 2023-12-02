<?php
// Replace YOUR_API_KEY with your actual YouTube Data API key
$apiKey = 'YOUR_API_KEY';

// Get the video ID from the query string
$videoId = isset($_GET['videoId']) ? $_GET['videoId'] : '';

// Check if the video ID is provided
if (!empty($videoId)) {
    // Set up the API URL
    $apiUrl = 'https://www.googleapis.com/youtube/v3/videos?id=' . $videoId . '&key=' . $apiKey . '&part=snippet,statistics';

    // Make an HTTP GET request to the YouTube API
    $response = file_get_contents($apiUrl);

    // Decode the JSON response into a PHP object
    $videoData = json_decode($response);

    // Check if the video was found
    if (!empty($videoData->items)) {
        $video = $videoData->items[0];

        // Return video details as JSON
        header('Content-Type: application/json');
        echo json_encode($video);
    } else {
        // Return an error message if the video is not found
        header('HTTP/1.0 404 Not Found');
        echo json_encode(['error' => 'Video not found']);
    }
} else {
    // Return an error message if the video ID is not provided
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(['error' => 'Missing video ID']);
}
