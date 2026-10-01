<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class Statement extends Model
{

    public $zssf_no;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['zssf_no'],'required'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'zssf_no' => Yii::t('yii', 'Member Number'),

        ];
    }
    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */

}
