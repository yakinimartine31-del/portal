<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_buffer_results".
 *
 * @property int $id
 * @property string $TotalNumberOfContribution
 * @property string $BestAverageEarning
 * @property string $TotalContributions
 * @property string $ContributionAfterRetirement
 * @property string $Gratuity
 * @property string $MonthlyPension
 * @property string $Refund
 * @property string $ContBeforeRetirement
 * @property string $MONTHLYPENSIONCALCULATED
 * @property string $MPFormula
 * @property string $MPFormulawnumber
 * @property string $GTFormula
 * @property string $GTFormulawnumber
 * @property string $RFFormula
 * @property string $RFFormulawnumber
 * @property string $member_number
 * @property int $type
 * @property float $latest_contribution
 * @property string $latest_updated
 */
class BufferResults extends \yii\db\ActiveRecord
{




    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_buffer_results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TotalNumberOfContribution', 'BestAverageEarning', 'TotalContributions', 'ContributionAfterRetirement', 'Gratuity', 'MonthlyPension', 'Refund', 'ContBeforeRetirement', 'MONTHLYPENSIONCALCULATED', 'MPFormula', 'MPFormulawnumber', 'GTFormula', 'GTFormulawnumber', 'RFFormula', 'RFFormulawnumber', 'member_number', 'type', 'latest_contribution'], 'required'],
            [['type'], 'integer'],
            [['latest_contribution'], 'number'],
            [['latest_updated'], 'safe'],
            [['TotalNumberOfContribution', 'BestAverageEarning', 'TotalContributions', 'ContributionAfterRetirement', 'Gratuity', 'MonthlyPension', 'Refund', 'ContBeforeRetirement', 'MONTHLYPENSIONCALCULATED', 'MPFormula', 'MPFormulawnumber', 'GTFormula', 'GTFormulawnumber', 'RFFormula', 'RFFormulawnumber', 'member_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'TotalNumberOfContribution' => Yii::t('yii', 'Number of Months Contributed'),
            'BestAverageEarning' => Yii::t('yii', 'Best Average Earning'),
            'TotalContributions' => Yii::t('yii', 'Amount Contributed'),
            'ContributionAfterRetirement' => Yii::t('yii', 'Contribution After Retirement'),
            'Gratuity' => Yii::t('yii', 'Gratuity'),
            'MonthlyPension' => Yii::t('yii', 'Monthly Pension'),
            'Refund' => Yii::t('yii', 'Refund'),
            'ContBeforeRetirement' => Yii::t('yii', 'Cont Before Retirement'),
            'MONTHLYPENSIONCALCULATED' => Yii::t('yii', 'Monthlypensioncalculated'),
            'MPFormula' => Yii::t('yii', 'Mp Formula'),
            'MPFormulawnumber' => Yii::t('yii', 'Mp Formulawnumber'),
            'GTFormula' => Yii::t('yii', 'Gt Formula'),
            'GTFormulawnumber' => Yii::t('yii', 'Gt Formulawnumber'),
            'RFFormula' => Yii::t('yii', 'Rf Formula'),
            'RFFormulawnumber' => Yii::t('yii', 'Rf Formulawnumber'),
            'member_number' => Yii::t('yii', 'Member Number'),
            'type' => Yii::t('yii', 'Benefit Type'),
            'latest_contribution' => Yii::t('yii', 'Latest Contribution'),
            'latest_updated' => Yii::t('yii', 'Latest Updated'),
        ];
    }

    public function getBuffer0()
    {
        return $this->hasOne(Contributions::className(), ['id' => 'member_number']);
    }


    public static function getProjection(){

        $user=\Yii::$app->user->identity->getId();
        $member=Members::find()->where(['uid'=>$user])->one();
        $member_number=$member['membership_number'];

        $url = 'https://mobile.zssf.or.tz/api/v1/static/index.php/projections';
        $data_json = json_encode(["member_number" => "$member_number"]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $results = json_decode($response, true);

        return $results;

    }
}
