<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_investments".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $category
 * @property string|null $title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $map
 * @property string|null $article_date
 */
class Investments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_investments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'article_date'], 'safe'],
            [['category', 'description', 'image'], 'string'],
            [['title', 'map'], 'string', 'max' => 255],
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
            'category' => Yii::t('yii', 'Category'),
            'title' => Yii::t('yii', 'Title'),
            'description' => Yii::t('yii', 'Description'),
            'image' => Yii::t('yii', 'Image'),
            'map' => Yii::t('yii', 'Map'),
            'article_date' => Yii::t('yii', 'Article Date'),
        ];
    }
}
