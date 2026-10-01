<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_contributions_temp".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $member_number
 * @property int|null $cont_month
 * @property int|null $cont_year
 * @property float|null $amount
 * @property float|null $salary
 * @property string $transaction_id
 * @property string $contributing_period
 */
class ContributionsTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_contributions_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'transaction_id', 'contributing_period'], 'required'],
            [['id', 'cont_month', 'cont_year'], 'integer'],
            [['date_time'], 'safe'],
            [['amount', 'salary'], 'number'],
            [['member_number', 'transaction_id', 'contributing_period'], 'string', 'max' => 255],
            [['id'], 'unique'],
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
            'member_number' => Yii::t('yii', 'Member Number'),
            'cont_month' => Yii::t('yii', 'Cont Month'),
            'cont_year' => Yii::t('yii', 'Cont Year'),
            'amount' => Yii::t('yii', 'Amount'),
            'salary' => Yii::t('yii', 'Salary'),
            'transaction_id' => Yii::t('yii', 'Transaction ID'),
            'contributing_period' => Yii::t('yii', 'Contributing Period'),
        ];
    }
}
