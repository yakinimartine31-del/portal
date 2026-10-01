<?php

use backend\models\ZssfMembers;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">
    <p>
        <?php Html::a(Yii::t('yii', 'Update'), ['update-agent', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Update Account'), ['update-agent', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to change activation status to this account?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php Html::a(Yii::t('yii', 'Delete Account'), ['delete-agent', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete Sheha account?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('yii', 'Back Home'), ['index-agent'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //     'id',
            'name',
            'username',
//            'profile_picture',
            'email:email',
            [
                'attribute' => 'id',
                'label' => 'Role Assigned',
                'value' => $model->role0 ? $model->role0->item_name : '-'
            ],
            'registerDate',
            // 'lastvisitDate',
            [
                'attribute' => 'id',
                'label' => "Gender",
                'value' => function ($model) {
                    $member = ZssfMembers::findOne(['uid' => $model->id]);
                    if ($member) {
                        return $member->gender;
                    }
                }
            ],
            [
                'attribute' => 'id',
                'label' => "Marital Status",
                'value' => function ($model) {
                    $member = ZssfMembers::findOne(['uid' => $model->id]);
                    if ($member) {
                        return $member->marital_status;
                    }
                }
            ],
            [
                'attribute' => 'id',
                'label' => "Mobile Number",
                'value' => function ($model) {
                    $member = ZssfMembers::findOne(['uid' => $model->id]);
                    if ($member) {
                        return $member->mobile_number;
                    }
                }
            ],
            [
                'attribute' => 'id',
                'label' => "Address",
                'value' => function ($model) {
                    $member = ZssfMembers::findOne(['uid' => $model->id]);
                    if ($member) {
                        return $member->address;
                    }
                }
            ],
            [
                'attribute' => 'id',
                'label' => 'Region',
                'value' => function ($model) {
                    $member=ZssfMembers::findOne(['uid'=>$model->id]);
                    $regionID = $member->region;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://mobile.zssf.or.tz/api2/public/index.php/regions/$regionID",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                    ));

                    $response = curl_exec($curl);
                    $region = json_decode($response, true);

                    if ($region && is_array($region) && isset($region[0]['RegionName'])) {
                        return $region[0]['RegionName'];
                    } else {
                        return "";
                    }
                }
            ],
            [
                'attribute' => 'id',
                'label' => 'District',
                'value' => function ($model) {
                    $member=ZssfMembers::findOne(['uid'=>$model->id]);

                    $district = $member->district;
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://mobile.zssf.or.tz/api2/public/index.php/districts/$district",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                    ));

                    $response = curl_exec($curl);

                    $districts = json_decode($response, true);
                    if ($districts && is_array($districts) && isset($districts[0]['DistrictName'])) {
                        return $districts[0]['DistrictName'];
                    } else {
                        return "";
                    }
                }
            ],
            [
                'attribute' => 'id',
                'label' => 'shehia',
                'value' => function ($model) {
                    $member=ZssfMembers::findOne(['uid'=>$model->id]);
                    $shehiaID = $member->shehia;

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://mobile.zssf.or.tz/api2/public/index.php/shehias/$shehiaID",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                    ));

                    $response = curl_exec($curl);
                    $shehia = json_decode($response, true);

                    if ($shehia && is_array($shehia) && isset($shehia[0]['ShehiaName'])) {
                        return $shehia[0]['ShehiaName'];
                    } else {
                        return "";
                    }
                }
            ],

//            'params:ntext',
//            'lastResetTime',
//            'resetCount',
//            'otpKey',
//            'otep',
//            'requireReset',
//            'create_at',
//            'updated_at',
        ],
    ]) ?>

</div>
