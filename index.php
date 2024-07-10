<?php
// Include necessary files
require 'controllers/ServiceController.php';

// Get the requested URL path
$request = $_SERVER['REQUEST_URI'];

// Remove query string from the request
$request = strtok($request, '?');

// Route the request
switch ($request) {
    case '/':
        // Default route
        require 'home.html';
        break;
    case '/services':
        require 'services.php';
        break;
    default:
        http_response_code(404);
        require 'home.html';
        break;
}
