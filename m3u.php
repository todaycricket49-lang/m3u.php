<?php
header('Content-Type: application/x-mpegurl');
header('Access-Control-Allow-Origin: *');

$playlistUrl = "http://m3u4u.com/m3u/5z3end3pdzspd4pzyqpk";

// Real browser jaisa request bhejne ke liye options
$options = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
    ]
];

$context = stream_context_create($options);
$m3uText = @file_get_contents($playlistUrl, false, $context);

if ($m3uText === FALSE) {
    // Agar direct nahi khula, toh curl use karenge
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $playlistUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    $m3uText = curl_exec($ch);
    curl_close($ch);
}

echo $m3uText;
?>

