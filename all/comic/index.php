<?php
$ts = time();
$public_key = 'cfa476604e04fd6e0bc9c86eb904badc';
$private_key = '983e3d08023e136611550d3eca68d89366482d1f';
$hash = md5($ts . $private_key . $public_key);

$query_params = [
    'apikey' => $public_key,
    'ts' => $ts,
    'hash' => $hash
];

//convert array into query parameters
$query = http_build_query($query_params);

//make the request
$response = file_get_contents('http://gateway.marvel.com/v1/public/comics?' . $query);

//convert the json string to an array
$response_data = json_decode($response, true);

//print
print_r($response_data);
