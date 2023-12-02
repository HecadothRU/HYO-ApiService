<?php
header("Content-Type: application/json");

function url_get_contents($url) {
    if (!function_exists('curl_init')) {
        return file_get_contents($url);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function get_data($query, $lang) {
    $url = 'http://suggestqueries.google.com/complete/search?callback=?&hl=' . strtolower($lang) . '&ds=yt&jsonp=suggestCallBack&client=youtube&q=' . urlencode($query);
    $get_source = url_get_contents($url);

    preg_match('/suggestCallBack\((.*)\)/', $get_source, $match);

    $deJson = json_decode($match[1], true);

    $data = [];

    if ($deJson[1]) {
        foreach ($deJson[1] as $value) {
            array_push($data, $value[0]);
        }
    }

    return $data;
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

$response = [];

if (!empty($query)) {
    $response = get_data($query, $lang);
}

echo json_encode($response);
?>
