<?php

namespace backend\models;

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
            'id' => 'ID',
            'date_time' => 'Date Time',
            'employer_code' => 'Employer Code',
            'employer_names' => 'Employer Names',
        ];
    }


    public static function AllEmployers()
    {
        $model = ZssfMembers::find()->where(['user_type'=>12])->count();
        if ($model > 0) {
            return $model;
        } else {
            return 0;
        }
    }
}
