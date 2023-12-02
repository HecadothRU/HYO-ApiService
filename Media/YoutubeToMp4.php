<?php

// Check for the video URL parameter
if (!isset($_GET['url'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing URL parameter']);
    exit;
}

// Get the video URL
$videoUrl = $_GET['url'];

// Validate and sanitize the video URL
if (filter_var($videoUrl, FILTER_VALIDATE_URL) === false) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid URL']);
    exit;
}

$videoUrl = filter_var($videoUrl, FILTER_SANITIZE_URL);

// Check if the domain is YouTube
$domain = parse_url($videoUrl, PHP_URL_HOST);
if (!in_array($domain, ['youtube.com', 'www.youtube.com', 'youtu.be', 'www.youtu.be'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid domain']);
    exit;
}

// Get the video metadata
$metadataCmd = "youtube-dl -j " . escapeshellarg($videoUrl);
$metadataJson = shell_exec($metadataCmd);
$metadata = json_decode($metadataJson, true);

// Check if the video is under 15 minutes long
$duration = isset($metadata['duration']) ? (int) $metadata['duration'] : 0;
$maxDuration = 15 * 60;

if ($duration > $maxDuration) {
    http_response_code(400);
    echo json_encode(['error' => 'Video exceeds 15 minutes']);
    exit;
}

// Download the video using youtube-dl
$videoPath = __DIR__ . '/downloads/' . uniqid() . '.mp4';
$cmd = "youtube-dl -o " . escapeshellarg($videoPath) . " -f mp4 " . escapeshellarg($videoUrl);
exec($cmd, $output, $returnCode);

if ($returnCode !== 0) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to download video']);
    exit;
}

// Serve the video file
header('Content-Type: video/mp4');
header('Content-Disposition: attachment; filename=video.mp4');
header('Content-Length: ' . filesize($videoPath));
readfile($videoPath);

// Clean up the downloaded video file
unlink($videoPath);

?>