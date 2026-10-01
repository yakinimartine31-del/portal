<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BufferResultsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Projection');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buffer-results-index" >

    <?php echo $this->render('_searchProjections', ['model' => $searchModel]); ?>

</div>
