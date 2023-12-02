<?php

function fetch_subdomains($domain, $api_key) {
    $url = "https://index.commoncrawl.org/collinfo.json";
    $index_data = json_decode(file_get_contents($url), true);
    $subdomains = array();

    foreach ($index_data as $index) {
        $search_url = $index['api'] . '?url=*.%s/*&output=json&apikey=%s';
        $search_url = sprintf($search_url, $domain, $api_key);
        $response = file_get_contents($search_url);

        if ($response) {
            $lines = explode("\n", trim($response));

            foreach ($lines as $line) {
                $result = json_decode($line, true);
                $url_parts = parse_url($result['url']);

                if (!empty($url_parts['host']) && !in_array($url_parts['host'], $subdomains)) {
                    $subdomains[] = $url_parts['host'];
                }
            }
        }
    }

    return $subdomains;
}

function get_ip_and_host($subdomain) {
    $ip = gethostbyname($subdomain);
    return array('host' => $subdomain, 'ip' => $ip);
}

if (isset($_GET['domain'])) {
    $domain = $_GET['domain'];
    $api_key = 'YOUR_API_KEY';
    $subdomains = fetch_subdomains($domain, $api_key);
    $result = array();

    foreach ($subdomains as $subdomain) {
        $result[] = get_ip_and_host($subdomain);
    }

    echo json_encode($result);
} else {
    echo "Please provide a domain using the 'domain' GET parameter.";
}
