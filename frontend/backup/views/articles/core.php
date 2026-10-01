<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title =Yii::t('yii', 'Core Values');
$this->params['breadcrumbs'][] =  ['label' => Yii::t('yii', 'About'), 'url' => ['site/about']] ;
$this->params['breadcrumbs'][] =  $this->title ;

?>
<div class="row" style="padding-bottom: 100px">
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
                    <div>
                        <img  src="<?= Yii::$app->request->baseUrl . '/../api/' . $model->intro_image; ?>" height="300px" width="700" alt="News Details" class="img-responsive" style="max-height:550px">
                    </div><br>
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