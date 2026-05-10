<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Fix Vercel read-only filesystem issues
putenv("VIEW_COMPILED_PATH=/tmp");
putenv("SESSION_DRIVER=cookie");
putenv("LOG_CHANNEL=stderr");
putenv("CACHE_STORE=array");

// Provide a fallback APP_KEY if the user forgot to add it in Vercel
if (!getenv('APP_KEY') && !isset($_ENV['APP_KEY']) && !isset($_SERVER['APP_KEY'])) {
    putenv('APP_KEY=base64:8Y+SBsZ5054bGthPj2qG3W1w3uo1yYzaCX5h6qBDG+8=');
}

$_SERVER['IS_VERCEL'] = true;

// Forward Vercel requests to normal index.php
require __DIR__ . '/../public/index.php';
