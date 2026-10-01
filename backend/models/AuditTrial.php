<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\User;

/**
 * This is the model class for table "audit_trial".
 *
 * @property int $id
 * @property string|null $activity
 * @property string|null $items
 * @property string|null $module
 * @property string|null $action
 * @property string $old
 * @property string $new
 * @property string|null $maker
 * @property string|null $maker_time
 * @property string|null $category
 */
class AuditTrial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'audit_trial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['items'], 'string'],
            [['category'], 'integer'],
            [['old', 'new'], 'required'],
            [['activity', 'module', 'action', 'old', 'new', 'maker', 'maker_time'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity' => 'Activity',
            'items' => 'Items',
            'module' => 'Module',
            'action' => 'Action',
            'old' => 'Old',
            'new' => 'New',
            'maker' => 'Maker',
            'maker_time' => 'Maker Time',
        ];
    }

    public function getUser0()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'maker']);
    }

    public static function getAll()
    {

        return ArrayHelper::map(AuditTrial::find()
            ->select(['module'])
            ->distinct()
            ->all(),'module','module');
    }


    public static function TotalWebLogins()
    {

        $model = AuditTrial::find()->where(['module'=>'Site login'])->count();
        if ($model > 0) {
            return $model;
        } else {
            return 0;
        }
    }

    public static function TotalAppLogins()
    {

        $model = AuditTrial::find()->where(['module'=>'App Login'])->count();
        if ($model > 0) {
            return $model;
        } else {
            return 0;
        }
    }
}
