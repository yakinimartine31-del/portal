<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

function serveFile($file)
{
    if (!is_file($file)) {
        return false;
    }

    $type = function_exists('mime_content_type') ? mime_content_type($file) : false;
    if ($type) {
        header('Content-Type: ' . $type);
    }

    readfile($file);

    return true;
}

/*
|--------------------------------------------------------------------------
| Serve existing files directly
|--------------------------------------------------------------------------
*/

if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false;
}

if ($uri !== '/' && serveFile(__DIR__ . '/frontend/web' . $uri)) {
    return true;
}

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
*/

if ($uri === '/staff' || strpos($uri, '/staff/') === 0) {
    $staffUri = substr($uri, strlen('/staff'));
    $staffUri = $staffUri === '' ? '/' : $staffUri;

    if ($staffUri !== '/' && serveFile(__DIR__ . '/staff' . $staffUri)) {
        return true;
    }

    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/staff/index.php';
    $_SERVER['SCRIPT_NAME'] = '/staff/index.php';
    $_SERVER['PHP_SELF'] = '/staff/index.php';

    chdir(__DIR__ . '/staff');

    require __DIR__ . '/staff/index.php';

    return;
}

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/frontend/web/index.php';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';

chdir(__DIR__ . '/frontend/web');

require __DIR__ . '/frontend/web/index.php';
