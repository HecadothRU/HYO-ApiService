<?php

// Set the API key
$api_key = "your_api_key_here";

// Check if the video ID was submitted via a GET request
if (isset($_GET['video_id'])) {
  // Get the video ID from the GET data
  $video_id = $_GET['video_id'];

  // Set the URL for the YouTube API endpoint
  $url = "https://www.googleapis.com/youtube/v3/videos?id=" . $video_id . "&key=" . $api_key . "&part=snippet";

  // Send a GET request to the API endpoint
  $response = file_get_contents($url);

  // Decode the JSON response
  $data = json_decode($response, true);

  // Get the URL for the thumbnail
  $thumbnail_url = $data["items"][0]["snippet"]["thumbnails"]["medium"]["url"];

  // Display the thumbnail link
  echo $thumbnail_url;
?>
