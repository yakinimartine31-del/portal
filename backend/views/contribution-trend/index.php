<?php


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplaintsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = Yii::t('yii', 'Members Contributions');
?>
<div class="clerk-deni-index" style="padding-top: 10px">
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            SEARCH FOR ZSSF MEMBERS CONTRIBUTIONS
        </div>

    </div>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>

