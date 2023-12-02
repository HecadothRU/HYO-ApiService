<?php
header("Content-Type: application/json");

function fetchVideoInfo($videoId, $apiKey) {
    $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . urlencode($videoId) . '&key=' . urlencode($apiKey);
    $content = file_get_contents($url);
    return json_decode($content, true);
}

function getVideoTags($videoId, $apiKey) {
    $videoInfo = fetchVideoInfo($videoId, $apiKey);
    if (isset($videoInfo['items'][0]['snippet']['tags'])) {
        return $videoInfo['items'][0]['snippet']['tags'];
    }
    return [];
}

$videoId = isset($_GET['videoId']) ? $_GET['videoId'] : '';
$apiKey = 'YOUR_API_KEY'; // Replace with your YouTube Data API key

$videoTags = [];

if (!empty($videoId)) {
    $videoTags = getVideoTags($videoId, $apiKey);
}

echo json_encode($videoTags);
?>
