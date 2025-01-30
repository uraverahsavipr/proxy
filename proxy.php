<?php
// Define the target URL
$target_url = 'http://example.com'; // Replace with your target URL

// Get the request path and query string
$path = isset($_GET['path']) ? $_GET['path'] : '';
$query_string = $_SERVER['QUERY_STRING'];

// Construct the full target URL
$url = $target_url . '/' . $path . ($query_string ? '?' . $query_string : '');

// Initialize a cURL session
$ch = curl_init($url);

// Set the request method (GET, POST, PUT, DELETE, etc.)
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $_SERVER['REQUEST_METHOD']);

// Forward the request headers
$headers = [];
foreach (getallheaders() as $key => $value) {
    if ($key !== 'Host') {
        $headers[] = "$key: $value";
    }
}
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Forward the request body (for POST, PUT, etc.)
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
}

// Return the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close the cURL session
curl_close($ch);

// Set the response code and return the response
http_response_code($http_code);
echo $response;
curl_close($ch);

// Set the response code and return the response
http_response_code($http_code);
echo $response;
