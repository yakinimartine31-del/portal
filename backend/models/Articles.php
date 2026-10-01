<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_articles".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $title
 * @property string|null $intro_image
 * @property string|null $contents
 * @property int|null $category_id
 * @property int|null $order_position
 */
class Articles extends \yii\db\ActiveRecord
{
    public  $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contents','title'], 'required'],
            [['date_time'], 'safe'],
            [['intro_image', 'contents'], 'string'],
            [['category_id', 'order_position'], 'integer'],
            [['title'], 'string', 'max' => 255],

            [['file',], 'file', 'extensions' => 'pdf,jpg, jpeg, png', 'skipOnEmpty' => true,
                'checkExtensionByMimeType' => false],
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
            'title' => Yii::t('yii', 'Title'),
            'intro_image' => Yii::t('yii', 'Intro Image'),
            'contents' => Yii::t('yii', 'Contents'),
            'category_id' => Yii::t('yii', 'Category ID'),
            'order_position' => Yii::t('yii', 'Order Position'),
        ];
    }
}
