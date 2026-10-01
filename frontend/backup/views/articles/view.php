<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Articles */

$this->title = $model->title;
$this->params['breadcrumbs'][] =  ['label' => Yii::t('yii', 'News and events'), 'url' => ['news']] ;
$this->params['breadcrumbs'][] =  $this->title ;

\yii\web\YiiAsset::register($this);


?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="news-title">
                    <h2><?= $model->title ?></h2>
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