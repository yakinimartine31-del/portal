<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ZssfBackendMembersSimulationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zssf Backend Members Simulations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zssf-backend-members-simulation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Zssf Backend Members Simulation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_time',
            'member_number',
            'mobile_number',
            'email:email',
            //'validation_code',
            //'member_code',
            //'first_name',
            //'second_name',
            //'last_name',
            //'address',
            //'join_date',
            //'full_names',
            //'amount',
            //'birthday',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
