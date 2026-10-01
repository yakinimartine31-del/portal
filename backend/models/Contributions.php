<?php

namespace backend\models;

use frontend\models\Members;
use Yii;

/**
 * This is the model class for table "sys_contributions".
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
 * @property string|null $latest_updated
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
            [['cont_month', 'cont_year'], 'integer'],
            [['amount', 'salary'], 'number'],
            [['transaction_id', 'contributing_period'], 'required'],
            [['member_number', 'transaction_id', 'contributing_period'], 'string', 'max' => 255],
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
            'cont_month' => Yii::t('yii', 'Latest Contribution Month'),
            'cont_year' => Yii::t('yii', 'Latest Contribution Year'),
            'amount' => Yii::t('yii', 'Latest Contribution Amount'),
            'salary' => Yii::t('yii', 'Latest Salary'),
            'transaction_id' => Yii::t('yii', 'Transaction'),
            'contributing_period' => Yii::t('yii', 'Contributing Period'),
            'latest_updated' => Yii::t('yii', 'Latest Updated'),
        ];
    }

    public  function getMember0()
    {
        return $this->hasOne(Members::className(), ['membership_number' => 'member_number']);
    }
}
