<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_publications".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $publication_type
 * @property string|null $title
 * @property string|null $publication
 * @property string|null $publication_date
 */
class Publications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_publications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publication_type','publication','title'], 'required'],
            [['date_time', 'publication_date'], 'safe'],
            [['publication_type', 'publication'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'publication_type' => Yii::t('yii', 'Publication Type'),
            'title' => Yii::t('yii', 'Title'),
            'publication' => Yii::t('yii', 'Publication'),
            'publication_date' => Yii::t('yii', 'Publication Date'),
        ];
    }
}
