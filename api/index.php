<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Forward Vercel requests to normal index.php
require __DIR__ . '/../public/index.php';
