<?php

class UrlShortener
{
    private string $apiUrl = 'http://tinyurl.com/api-create.php?url=';

    public function shorten(string $longUrl): string
    {
        $url = filter_var($longUrl, FILTER_VALIDATE_URL);

        if (!$url) {
            throw new InvalidArgumentException('Invalid URL provided');
        }

        $shortUrl = file_get_contents($this->apiUrl . urlencode($longUrl));

        return $shortUrl ?? $longUrl;
    }
}

header('Content-Type: application/json');

try {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $response = [];

    if ($requestMethod === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $longUrl = $input['longUrl'] ?? '';

        if ($longUrl) {
            $urlShortener = new UrlShortener();
            $shortUrl = $urlShortener->shorten($longUrl);
            $response = ['status' => 'success', 'shortUrl' => $shortUrl];
        } else {
            $response = ['status' => 'error', 'message' => 'Missing longUrl in request'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid request method'];
    }

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
