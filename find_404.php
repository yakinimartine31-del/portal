<?php
$content = file_get_contents('c:\wamp64\www\portal_zssf\backend\runtime\logs\app.log');
$blocks = explode('yii\web\NotFoundHttpException', $content);
if (count($blocks) > 1) {
    echo substr($blocks[count($blocks)-2], -2000);
} else {
    echo "Not found";
}
