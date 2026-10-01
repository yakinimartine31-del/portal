<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('yii','About');
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="services" class="services section-bg">

    <div class="row">
        <div class="col-md-4">
            <div class="icon-box">
                <i class="fa fa-certificate"></i>
                <h4><a href="<?= Url::toRoute(['articles/boards']);?>"><?=Yii::t('yii','Board Members')?></a></h4>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="icon-box">
                <i class="fa fa-certificate"></i>
                <h4><a href="<?= Url::toRoute(['articles/structure']);?>"><?=Yii::t('yii','Organization Structure')?></a></h4>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="icon-box">
                <i class="fa fa-certificate"></i>
                <h4><a href="<?= Url::toRoute(['articles/management']);?>"><?=Yii::t('yii','Management')?></a></h4>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="icon-box">
                <i class="fa fa-certificate"></i>
                <h4><a href="<?= Url::toRoute(['articles/profile']);?>"><?=Yii::t('yii','Our Profile- Overview')?></a></h4>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="icon-box">
                <i class="fa fa-certificate"></i>
                <h4><a href="<?= Url::toRoute(['articles/regulations']);?>"><?=Yii::t('yii','Our Profile - Act & Regulations')?></a></h4>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="icon-box">
                <i class="fa fa-certificate"></i>
                <h4><a href="<?= Url::toRoute(['articles/values']);?>"><?=Yii::t('yii','Core Values')?></a></h4>
            </div>
        </div>
    </div>
</section><!-- End Services Section -->

<style>




    /*--------------------------------------------------------------
    # Sections General
    --------------------------------------------------------------*/
    section {
        padding: 60px 0;
    }

    .section-bg {
        background-color: #f7fbfe;
    }

    .section-title {
        text-align: center;
        padding-bottom: 10px;
    }

    .section-title h2 {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 20px;
        position: relative;
    }

    .section-title h2::before {
        content: '';
        position: absolute;
        display: block;
        width: 120px;
        height: 1px;
        background: #ddd;
        bottom: 1px;
        left: calc(50% - 60px);
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        display: block;
        width: 40px;
        height: 3px;
        background: #3498db;
        bottom: 0;
        left: calc(50% - 20px);
    }

    .section-title p {
        margin-bottom: 0;
    }

    /*--------------------------------------------------------------
    # Services
    --------------------------------------------------------------*/
    .services .icon-box {
        padding: 30px;
        border-radius: 6px;
        background: #fff;
        transition: ease-in-out 0.3s;
    }

    .services .icon-box i {
        float: left;
        color: #3498db;
        font-size: 40px;
    }

    .services .icon-box h4 {
        margin-left: 70px;
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 18px;
    }

    .services .icon-box h4 a {
        color: #384046;
        transition: 0.3s;
    }

    .services .icon-box p {
        margin-left: 70px;
        line-height: 24px;
        font-size: 14px;
    }

    .services .icon-box:hover {
        box-shadow: 0px 2px 22px rgba(0, 0, 0, 0.08);
    }

    .services .icon-box:hover h4 a {
        color: #3498db;
    }
</style>