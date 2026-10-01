<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_employers".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $employer_code
 * @property string|null $employer_names
 */
class Employers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_employers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time'], 'safe'],
            [['employer_code', 'employer_names'], 'string', 'max' => 255],
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
            'employer_code' => Yii::t('yii', 'Employer Code'),
            'employer_names' => Yii::t('yii', 'Employer Names'),
        ];
    }
}
