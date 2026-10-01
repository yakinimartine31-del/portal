<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

    <h4><?= Html::encode($this->title) ?></h4>


<section class="container clearfix main_section" style="padding-top: 15px">
    <div id="main_content_outer" class="clearfix">
        <div id="main_content">
            <div class="row">
                <div class="col-sm-11">
                    <div class="col-md-12">
                        <h5 style="color: #003b4c;font-family: Tahoma">
                            <i class="fa fa-server text-default">
                            </i><strong> ROLE NAME</strong></h5>
                    </div>
                    <div class="panel panel-default">
                        <div class="user-index">
                            <div class="box-body table-responsive">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'name',
                                        'type',
                                        'description:ntext',
                                       // 'rule_name',
                                       // 'data:ntext',
                                       // 'created_at',
                                       // 'updated_at',
                                    ],
                                ]) ?>
                            </div>
                            <p>
                                <?= Html::a('Update', ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('Delete', ['delete', 'id' => $model->name], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>