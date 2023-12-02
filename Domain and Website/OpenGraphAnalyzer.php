<?php
header("Content-Type: application/json");

function fetchOpenGraphTags($url, $tags) {
    $content = file_get_contents($url);
    $doc = new DOMDocument();
    @$doc->loadHTML($content);

    $metaTags = $doc->getElementsByTagName('meta');
    $openGraphTags = [];

    foreach ($metaTags as $metaTag) {
        $property = $metaTag->getAttribute('property');
        $content = $metaTag->getAttribute('content');

        if (in_array($property, $tags)) {
            $openGraphTags[$property] = $content;
        }
    }

    return $openGraphTags;
}

$domain = isset($_GET['domain']) ? $_GET['domain'] : '';

$desiredTags = [
    'og:url',
    'og:title',
    'og:type',
    'og:description',
    'og:site_name',
    'og:image',
    'fb:app_id',
    'og:type',
    'og:locale',
    'og:video',
    'og:video:url',
    'og:video:secure_url',
    'og:video:type',
    'og:video:width',
    'og:video:height',
    'og:image',
    'og:image:url',
    'og:image:secure_url',
    'og:image:type',
    'og:image:width',
    'og:image:height'
];

$response = [];

if (!empty($domain)) {
    $response = fetchOpenGraphTags($domain, $desiredTags);
}

echo json_encode($response);
?>
