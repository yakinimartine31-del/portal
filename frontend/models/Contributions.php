<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_contributions".
 *
 * @property int $id
 * @property string|null $date_time
 * @property int|null $member_number
 * @property int|null $cont_month
 * @property int|null $cont_year
 * @property float|null $amount
 * @property float|null $salary
 * @property string $transaction_id
 * @property string $contributing_period
 * @property string|null $latest_updated
 *
 * @property SysEmployments1 $memberNumber
 */
class Contributions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_contributions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'latest_updated'], 'safe'],
            [['member_number', 'cont_month', 'cont_year'], 'integer'],
            [['amount', 'salary'], 'number'],
            [['transaction_id', 'contributing_period'], 'required'],
            [['transaction_id', 'contributing_period'], 'string', 'max' => 255],
            [['member_number'], 'exist', 'skipOnError' => true, 'targetClass' => Employments::className(), 'targetAttribute' => ['member_number' => 'member_code']],
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
            'cont_month' => Yii::t('yii', 'Latest Contribution (Month)'),
            'cont_year' => Yii::t('yii', 'Latest Contribution (Year)'),
            'amount' => Yii::t('yii', 'Latest amount Contributed'),
            'salary' => Yii::t('yii', 'Latest Salary (Tshs)'),
            'transaction_id' => Yii::t('yii', 'Transaction ID'),
            'contributing_period' => Yii::t('yii', 'Number of Months Contributed'),
            'latest_updated' => Yii::t('yii', 'Latest Updated'),
        ];
    }

    /**
     * Gets query for [[MemberNumber]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberNumber()
    {
        return $this->hasOne(Employments::className(), ['member_code' => 'member_number']);
    }

    public function getId0()
    {
        return $this->hasOne(Members::className(), ['membership_number' => 'member_number']);
    }

    public function getBuffer0()
    {
        return $this->hasOne(BufferResults::className(), ['member_number' => 'member_number']);
    }
}
