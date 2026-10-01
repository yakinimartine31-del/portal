<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_counters".
 *
 * @property int $id
 * @property string $ip_address
 * @property string $date
 * @property string $time
 * @property string $datetime
 */
class UserCounters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_counters';
    }

    public static function getIPAddress() {
        //whether ip is from the share internet
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
//whether ip is from the remote address
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public static function Online()
    {
        $currentDateTime=date('Y-m-d H:i:s');
        $dff=date('Y-m-d H:i:s', strtotime('-3 minutes'));
        $online=UserCounters::find()
           ->select('ip_address')
            ->where(['between','datetime',$dff,$currentDateTime])
            ->groupBy('ip_address')
            ->count();
        if($online >0){
            echo $online;

        }
        else{
            echo 0;
        }
    }

    public static function checkLastLogin()
    {
        $ip = self::getIPAddress();
        $checkIPLastLogin=UserCounters::findOne(['ip_address'=>$ip,'date'=>date('Y-m-d')]);
        if (empty($checkIPLastLogin)){
            $counter=new UserCounters();
            $counter->ip_address=$ip;
            $counter->date=date('Y-m-d');
            $counter->time=date('H:i:s');
            $counter->datetime=date('Y-m-d H:i:s');
            $counter->save();
        }
        else{
            UserCounters::updateAll(['time'=>date('H:i:s'),'datetime'=>date('Y-m-d H:i:s')],['ip_address'=>$ip]);
        }
    }

    public static function TodayVisitors()
    {
        $currentDate=date('Y-m-d');
        $online=UserCounters::find()
            ->select('ip_address')
            ->where(['date'=>$currentDate])
            ->groupBy('ip_address')
            ->count();
        if($online >0){
            echo $online;
            
        }
        else{
            echo 0;
        }
    }

    public static function AllVisitors()
    {
        $online=UserCounters::find()
            ->select('ip_address')
            ->count();
        if($online >0){
            echo $online;
        }
        else{
            echo 0;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip_address', 'date', 'time', 'datetime'], 'required'],
            [['date', 'time', 'datetime'], 'safe'],
            [['ip_address'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip_address' => 'Ip Address',
            'date' => 'Date',
            'time' => 'Time',
            'datetime' => 'Datetime',
        ];
    }
}
