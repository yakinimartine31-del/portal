<?php

use frontend\models\Members;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BufferResultsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Test Benefit');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->getFlash('benefit_success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('benefit_success'),
    ]);

}


?>
<div class="buffer-results-index" >

    <?php

    echo $this->render('_search', ['model' => $searchModel]); ?>

</div>
