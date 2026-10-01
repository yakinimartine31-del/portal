<?php
$content = @file_get_contents('c:\wamp64\www\portal_zssf\frontend\runtime\logs\app.log');
if ($content) {
    $blocks = explode('yii\web\NotFoundHttpException', $content);
    if (count($blocks) > 1) {
        echo substr($blocks[count($blocks)-2], -2000);
    } else {
        echo "Not found in frontend";
    }
} else {
    echo "Frontend log not found";
}
