<?php
$content = @file_get_contents('c:\wamp64\www\portal_zssf\frontend\runtime\logs\app.log');
if ($content) {
    $blocks = explode('yii\web\NotFoundHttpException', $content);
    $found = false;
    foreach ($blocks as $block) {
        if (strpos($block, '"staff"') !== false || strpos($block, '"staff/index"') !== false) {
            echo substr($block, -1000) . "\n---\n";
            $found = true;
        }
    }
    if (!$found) echo 'Not found staff 404';
} else {
    echo "Frontend log not found";
}
