<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title =Yii::t('yii', 'Overview');
//$this->params['breadcrumbs'][] =  ['label' => Yii::t('yii', 'About'), 'url' => ['site/about']] ;
$this->params['breadcrumbs'][] =  $this->title ;

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="news-title">
                    <h4><?= $model->title ?></h4>
                </div>
                <div class="">
                    <ul class="list-unstyled list-inline mb-1">
                        <li class="list-inline-item">
                            <i class="fa fa-folder-o text-danger"></i>
                            <a href="#"><small><?= $model->date_time ?></small></a>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="news-content">
                    <p><?=$model->contents ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .site-about {
        background-color: #f7fbfe;
    }
</style>