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