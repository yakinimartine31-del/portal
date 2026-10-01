<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_members_death_reports".
 *
 * @property int $id
 * @property string $date_time
 * @property string $member_number
 * @property string $pensioner_number
 * @property string $death_date
 * @property string $death_place
 * @property string $death_cause
 * @property string $death_certificate
 * @property int $current_status_id
 * @property string $type
 */
class DeathReports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_members_death_reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'member_number', 'pensioner_number', 'death_date', 'death_place', 'death_cause', 'death_certificate', 'current_status_id', 'type'], 'required'],
            [['date_time', 'death_date'], 'safe'],
            [['current_status_id'], 'integer'],
            [['member_number', 'pensioner_number', 'death_certificate'], 'string', 'max' => 50],
            [['death_place', 'death_cause'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20],
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
            'member_number' => 'Member Number',
            'pensioner_number' => 'Pensioner Number',
            'death_date' => 'Death Date',
            'death_place' => 'Death Place',
            'death_cause' => 'Death Cause',
            'death_certificate' => 'Death Certificate',
            'current_status_id' => 'Current Status ID',
            'type' => 'Type',
        ];
    }
}
