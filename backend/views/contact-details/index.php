<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Contact Details');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Create Contact Details'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'alias',
            'con_position',
            'address:ntext',
            //'suburb',
            //'state',
            //'country',
            //'postcode',
            //'telephone',
            //'fax',
            //'misc:ntext',
            //'image',
            //'email_to:email',
            //'default_con',
            //'published',
            //'checked_out',
            //'checked_out_time',
            //'ordering',
            //'params:ntext',
            //'user_id',
            //'catid',
            //'access',
            //'mobile',
            //'webpage',
            //'sortname1',
            //'sortname2',
            //'sortname3',
            //'language',
            //'created',
            //'created_by',
            //'created_by_alias',
            //'modified',
            //'modified_by',
            //'metakey:ntext',
            //'metadesc:ntext',
            //'metadata:ntext',
            //'featured',
            //'xreference',
            //'publish_up',
            //'publish_down',
            //'version',
            //'hits',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
