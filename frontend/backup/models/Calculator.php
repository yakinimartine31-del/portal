<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class Calculator extends Model
{

    public $amount;
    public $id;
    public $validation_method;
    public $time_type;
    public $time;
    public $gross_salary;

    const month=1;
    const year=2;

    public static function getType()
    {
        return [
            self::month => Yii::t('yii', 'In Months'),
            self::year => Yii::t('yii', 'In Years'),

        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount','gross_salary','time','time_type'],'required'],
            [['amount','gross_salary'], 'number'],
            [['time','time_type'], 'integer'],
            ['time', 'integer'],
            ['gross_salary', 'number', 'min' => 1],
            ['amount', 'number', 'min' => 1],
        ];
    }


    public function attributeLabels()
    {
        return [
            'amount' => Yii::t('yii', 'Gross Salary'),
            'time' => Yii::t('yii', 'Years or Months'),
            'time_type' => Yii::t('yii', 'Contributing Period'),
            'gross_salary' => Yii::t('yii', 'Gross Salary'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */

}
