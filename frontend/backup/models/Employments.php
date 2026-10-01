<?php

namespace frontend\models;

use backend\models\CustomerAttachments;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "sys_employments".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $member_code
 * @property string|null $member_name
 * @property string|null $employer_code
 * @property string|null $employer_name
 * @property string|null $employment_appointment
 * @property string|null $latest_updated
 */
class Employments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_employments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'employment_appointment', 'latest_updated'], 'safe'],
            [['member_code', 'member_name', 'employer_code', 'employer_name'], 'string', 'max' => 255],
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
            'member_code' => Yii::t('yii', 'Member Code'),
            'member_name' => Yii::t('yii', 'Member Name'),
            'employer_code' => Yii::t('yii', 'Employer Code'),
            'employer_name' => Yii::t('yii', 'Employer Name'),
            'employment_appointment' => Yii::t('yii', 'Employment Appointment'),
            'latest_updated' => Yii::t('yii', 'Latest Updated'),
        ];
    }

    public function searchMember($id)
    {
        $query = Employments::find()->where(['member_code'=>$id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 250
            ],
            'sort' => ['defaultOrder' => [
                'id' => SORT_DESC,
            ]
            ]
        ]);
        $this->load($id);

        $query->andFilterWhere([

            'member_code' => $id,
        ]);

        // $query->orderBy(['photo'=>SORT_ASC]);
        return $dataProvider;
    }
}
