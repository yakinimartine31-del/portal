<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_buffering_contribution_trend".
 *
 * @property int $id
 * @property string $member_id
 * @property int $ContributionYear
 * @property float $JANUARY
 * @property float $FEBRUARY
 * @property float $MARCH
 * @property float $APRIL
 * @property float $MAY
 * @property float $JUNE
 * @property float $JULY
 * @property float $AUGUST
 * @property float $SEPTEMBER
 * @property float $OCTOBER
 * @property float $NOVEMBER
 * @property float $DECEMBER
 * @property float $JANUARYC
 * @property float $FEBRUARYC
 * @property float $MARCHC
 * @property float $APRILC
 * @property float $MAYC
 * @property float $JUNEC
 * @property float $JULYC
 * @property float $AUGUSTC
 * @property float $SEPTEMBERC
 * @property float $OCTOBERC
 * @property float $NOVEMBERC
 * @property float $DECEMBERC
 * @property float $AnnualMonthsContributed
 * @property float $AnnualSalaryContributed
 * @property float $AnnualTotalContributed
 * @property string $date_time
 */
class ContributionTrend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_buffering_contribution_trend';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member_id', 'ContributionYear', 'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER', 'JANUARYC', 'FEBRUARYC', 'MARCHC', 'APRILC', 'MAYC', 'JUNEC', 'JULYC', 'AUGUSTC', 'SEPTEMBERC', 'OCTOBERC', 'NOVEMBERC', 'DECEMBERC', 'AnnualMonthsContributed', 'AnnualSalaryContributed', 'AnnualTotalContributed'], 'required'],
            [['id', 'ContributionYear'], 'integer'],
            [['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER', 'JANUARYC', 'FEBRUARYC', 'MARCHC', 'APRILC', 'MAYC', 'JUNEC', 'JULYC', 'AUGUSTC', 'SEPTEMBERC', 'OCTOBERC', 'NOVEMBERC', 'DECEMBERC', 'AnnualMonthsContributed', 'AnnualSalaryContributed', 'AnnualTotalContributed'], 'number'],
            [['date_time'], 'safe'],
            [['member_id'], 'string', 'max' => 255],
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
            'member_id' => Yii::t('yii', 'Member ID'),
            'ContributionYear' => Yii::t('yii', 'Contribution Year'),
            'JANUARY' => Yii::t('yii', 'January'),
            'FEBRUARY' => Yii::t('yii', 'February'),
            'MARCH' => Yii::t('yii', 'March'),
            'APRIL' => Yii::t('yii', 'April'),
            'MAY' => Yii::t('yii', 'May'),
            'JUNE' => Yii::t('yii', 'June'),
            'JULY' => Yii::t('yii', 'July'),
            'AUGUST' => Yii::t('yii', 'August'),
            'SEPTEMBER' => Yii::t('yii', 'September'),
            'OCTOBER' => Yii::t('yii', 'October'),
            'NOVEMBER' => Yii::t('yii', 'November'),
            'DECEMBER' => Yii::t('yii', 'December'),
            'JANUARYC' => Yii::t('yii', 'January'),
            'FEBRUARYC' => Yii::t('yii', 'February'),
            'MARCHC' => Yii::t('yii', 'March'),
            'APRILC' => Yii::t('yii', 'April'),
            'MAYC' => Yii::t('yii', 'May'),
            'JUNEC' => Yii::t('yii', 'June'),
            'JULYC' => Yii::t('yii', 'July'),
            'AUGUSTC' => Yii::t('yii', 'August'),
            'SEPTEMBERC' => Yii::t('yii', 'September'),
            'OCTOBERC' => Yii::t('yii', 'October'),
            'NOVEMBERC' => Yii::t('yii', 'November'),
            'DECEMBERC' => Yii::t('yii', 'December'),
            'AnnualMonthsContributed' => Yii::t('yii', 'Annual Months Contributed'),
            'AnnualSalaryContributed' => Yii::t('yii', 'Annual Salary Contributed'),
            'AnnualTotalContributed' => Yii::t('yii', 'Annual Total Contributed'),
            'date_time' => Yii::t('yii', 'Date Time'),
        ];
    }
}
