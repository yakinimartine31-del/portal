<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CommonZssfSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Maternity Benefit');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="common-zssf-settings-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

</div>
