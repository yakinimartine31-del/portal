<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_complaints_categories".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $category_name
 */
class ComplaintsCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_complaints_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time'], 'safe'],
            [['status'], 'integer'],
            [['category_name','recepient_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'date_time' => Yii::t('yii', 'Date Time'),
            'category_name' => Yii::t('yii', 'Category Name'),
        ];
    }
}
