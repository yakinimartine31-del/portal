<?php

/* @var $this yii\web\View */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;

$this->title = Yii::t('yii', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-lg-5">
            <?= Html::beginForm(['site/login'], 'post', ['id' => 'login-form', 'autocomplete' => 'off']) ?>
                <input type="hidden" name="_csrf-frontend" value="<?= Html::encode(Yii::$app->request->getCsrfToken()) ?>">

                <div class="form-group">
                    <label><?= Yii::t('yii', 'Username') ?></label>
                    <input class="form-control" type="text" name="LoginForm[username]" required autofocus>
                </div>

                <div class="form-group">
                    <label><?= Yii::t('yii', 'Password') ?></label>
                    <input class="form-control" type="password" name="LoginForm[password]" required>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="LoginForm[rememberMe]" value="1">
                        <?= Yii::t('yii', 'Remember me') ?>
                    </label>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit"><?= Yii::t('yii', 'Login') ?></button>
                </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>


