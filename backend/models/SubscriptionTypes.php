<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_subscription_types".
 *
 * @property int $id
 * @property string $type_name
 * @property string $type_name_sw
 * @property int $default
 */
class SubscriptionTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_subscription_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name', 'type_name_sw', 'default'], 'required'],
            [['default'], 'integer'],
            [['type_name', 'type_name_sw'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'Type Name',
            'type_name_sw' => 'Type Name Sw',
            'default' => 'Default',
        ];
    }
}
