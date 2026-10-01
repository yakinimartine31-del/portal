<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_zssf_backend_members_simulation".
 *
 * @property int $id
 * @property string|null $date_time
 * @property string|null $member_number
 * @property string|null $mobile_number
 * @property string|null $email
 * @property string|null $validation_code
 * @property string|null $member_code
 * @property string|null $first_name
 * @property string|null $second_name
 * @property string|null $last_name
 * @property string|null $address
 * @property string|null $join_date
 * @property string|null $full_names
 * @property float|null $amount
 * @property string|null $birthday
 */
class ZssfBackendMembersSimulation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_zssf_backend_members_simulation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'join_date', 'birthday'], 'safe'],
            [['amount'], 'number'],
            [['member_number', 'mobile_number', 'email', 'validation_code', 'member_code', 'first_name', 'second_name', 'last_name', 'address', 'full_names'], 'string', 'max' => 255],
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
            'mobile_number' => 'Mobile Number',
            'email' => 'Email',
            'validation_code' => 'Validation Code',
            'member_code' => 'Member Code',
            'first_name' => 'First Name',
            'second_name' => 'Second Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
            'join_date' => 'Join Date',
            'full_names' => 'Full Names',
            'amount' => 'Amount',
            'birthday' => 'Birthday',
        ];
    }
}
