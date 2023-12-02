<?php
header("Content-Type: application/json");

function fetchVideoInfo($videoId, $apiKey) {
    $url = 'https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=' . urlencode($videoId) . '&key=' . urlencode($apiKey);
    $content = file_get_contents($url);
    return json_decode($content, true);
}

function getRestrictedRegions($videoId, $apiKey) {
    $videoInfo = fetchVideoInfo($videoId, $apiKey);
    if (isset($videoInfo['items'][0]['contentDetails']['regionRestriction']['blocked'])) {
        return $videoInfo['items'][0]['contentDetails']['regionRestriction']['blocked'];
    }
    return [];
}

$videoId = isset($_GET['videoId']) ? $_GET['videoId'] : '';
$apiKey = 'YOUR_API_KEY'; // Replace with your YouTube Data API key

$restrictedRegions = [];

if (!empty($videoId)) {
    $restrictedRegions = getRestrictedRegions($videoId, $apiKey);
}

echo json_encode($restrictedRegions);
?>
