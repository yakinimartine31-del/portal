<?php

/**
 * UserCounter for Yii 2.0
 *
 * This component is complete reworked port of pCounter, originally written by
 * Andreas "Pr0g" Droesch. It uses MySQL for counting the number of visitors.
 * Following information is provided by UserCounter.
 *
 * - users online
 * - total users of today
 * - total users of yesterday
 * - total users overall
 * - maximum users at a day
 * - date for the maximum
 *
 * No cookies or sessions are used. The count is only based on the IP address
 * of users, but this information is stored as md5-hash in database.
 *
 *
 * USAGE
 *
 * For installation, have a look at the extension page on yiiframework.com or
 * on GitHub. There you can find all information about this component:
 * http://www.yiiframework.com/extension/yii-usercounter/
 * https://github.com/armin-pfaeffle/yii-usercounter/
 *
 * Provides methods:
 * - Yii::$app->userCounter->getOnline()
 * - Yii::$app->userCounter->getToday()
 * - Yii::$app->userCounter->getYesterday()
 * - Yii::$app->userCounter->getTotal()
 * - Yii::$app->userCounter->getMaximal()
 * - date('d.m.Y', Yii::$app->userCounter->getMaximalTime())
 *
 *
 * LICENSE
 *
 * UserCounter is freeware and you are allowed to distribute it, but only in case
 * it is not commercial and the script does not get modified.
 *
 *
 * @author Armin Pfäffle <mail@armin-pfaeffle.de>
 * @author Andreas "Pr0g" Droesch
 * @copyright Copyright (c) 2015, Armin Pfäffle <mail@armin-pfaeffle.de>
 * @link https://github.com/armin-pfaeffle/yii-usercounter/
 * @link http://www.yiiframework.com/extension/yii-usercounter/
 * @link http://andreas.droesch.de
 * @version 1.3.0
 */

namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


class UserCounter extends Component
{
    public $autoInstallTables = false;
    public $tableUsers = 'tableUsers';
    public $tableSave = 'tableSave';
    public $onlineTime = 10;

    protected $alreadyUpdated = false;
    protected $dayTime;
    protected $total = 0;
    protected $online = 0;
    protected $today = 0;
    protected $yesterday = 0;
    protected $maxCount = 0;
    protected $maxDate;

    /**
     *
     */
    public function init()
    {
        $this->checkTables();
        $this->refresh();
    }

    /**
     * Checks if necessary tables exist and if not, create them.
     */
    protected function checkTables()
    {
   
    }

    /**
     * Refreshes the counters and updates database. The updated values are stored in
     * class variables.
     */
    public function refresh($force = false)
    {
       
    }

    /**
     * Loads current values from databse.
     */
    protected function getCurrentData()
    {
//        $rows = (new \yii\db\Query())
//            ->select(array('save_name', 'save_value'))
//            ->from($this->tableSave)
//            ->all();
//        $data = array();
//        foreach ($rows as $row) {
//            $data[ $row['save_name'] ] = $row['save_value'];
//        }
//        $this->dayTime = $data['day_time'];
//        $this->total = $data['counter'];
//        $this->yesterday = $data['yesterday'];
//        $this->maxCount = $data['max_count'];
//        $this->maxDate = $data['max_time'];
    }

    /**
     * Detects if current day is a new day compared to {@see dayTime}.
     */
    protected function isNewDay()
    {
       $today = GregorianToJD(date('m'), date('j'), date('Y'));
       // $today = date('m/j/Y');
        return ($today != $this->dayTime);
    }

    /**
     * Returns the number of users which are online at the moment.
     */
    protected function getLastLoggedUsers($onlyOnline = false)
    {
      
    }

    /**
     *
     */
    protected function isNewMaximum($count)
    {
        return ($count > $this->maxCount);
    }

    /**
     *
     */
    protected function insertOrUpdateIpAddress()
    {
        $ipAddress = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        $hashedIpAddress = md5($ipAddress);
        $currentTimestamp = time();
        $sql = 'INSERT INTO ' . $this->tableUsers . ' VALUES (:ipAddress, :time) ON DUPLICATE KEY UPDATE user_time = :time';
        Yii::$app->db->createCommand($sql)
            ->bindParam(':ipAddress', $hashedIpAddress, \PDO::PARAM_STR)
            ->bindParam(':time', $currentTimestamp, \PDO::PARAM_INT)
            ->execute();
    }

    /**
     * Shortcut function.
     */
    protected function update($table, $columns, $conditions='', $params=array())
    {
        return Yii::$app->db->createCommand()
            ->update($table, $columns, $conditions, $params)
            ->execute();
    }

    /**
     * Shortcut function.
     */
    protected function insert($table, $columns)
    {
        return Yii::$app->db->createCommand()
            ->insert($table, $columns)
            ->execute();
    }

    /**
     * Shortcut function.
     */
    protected function truncate($table)
    {
        return Yii::$app->db->createCommand()
            ->truncateTable($table)
            ->execute();
    }

    /**
     * Total number of users since usage of this plugin.
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Getter for number of users which are online at the moment.
     * @return int
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Getter for number of users which were online today.
     * @return int
     */
    public function getToday()
    {
        return $this->today;
    }

    /**
     * Getter for number of users which were online yesterday.
     * @return int
     */
    public function getYesterday()
    {
        return $this->yesterday;
    }

    /**
     * Getter for maximal number of users which were online at a day.
     * @return int
     */
    public function getMaxCount()
    {
        return $this->maxCount;
    }

    /**
     * Returns date when maximal users were online.
     * @return
     */
    public function getMaximalDate()
    {
        return $this->maxDate;
    }

    /**
     * @deprecated deprecated since version 1.2. Please use getMaxCount() instead.
     */
    public function getMaximal()
    {
        return $this->getMaxCount();
    }

    /**
     * @deprecated deprecated since version 1.2. Please use getMaximalDate() instead.
     */
    public function getMaximalTime()
    {
        return $this->getMaximalDate();
    }
}