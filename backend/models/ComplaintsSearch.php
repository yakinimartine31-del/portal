<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Complaints;

/**
 * ComplaintsSearch represents the model behind the search form of `backend\models\Complaints`.
 */
class ComplaintsSearch extends Complaints
{
    public $date1;
    public $date2;
    public $sorted_from_date;
    public $sorted_to_date;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category'], 'integer'],
            [[
                'date_time','date1','date2',
                'sorted_from_date','sorted_to_date',
                'zssf_number', 'subject', 'message',
                'photo_file', 'email_address', 'phone_number', 'status_type'
            ], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Helper method to apply status filter correctly
     */
    private function applyStatusFilter($query)
    {
        if (empty($this->status_type)) {
            return;
        }
        
        if ($this->status_type == '1') {
            // PENDING: status_type = '1' AND no response data
            $query->andWhere(['AND',
                ['status_type' => '1'],
                ['respond_date' => null],
                ['response_message' => null],
                ['response_by' => null]
            ]);
        } elseif ($this->status_type == '0') {
            // SORTED: status_type in ['0', 'Sorted'] AND has actual response data with non-empty message
            $query->andWhere(['AND',
                ['IN', 'status_type', ['0', 'Sorted']],
                ['NOT', ['response_by' => null]],
                ['NOT', ['response_message' => null]],
                ['!=', 'response_message', ''],
                ['!=', 'response_message', ' ']
            ]);
        } else {
            // For other values, use regular filter
            $query->andFilterWhere(['like', 'status_type', $this->status_type]);
        }
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if (\Yii::$app->user->can('manageAllComplaints')){
            $query = Complaints::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['between','date(date_time)', $this->date1, $this->date2]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            // Handle sorted status date filtering
            if ($this->status_type === 'Sorted') {
                if (!empty($this->sorted_from_date)) {
                    $query->andFilterWhere(['>=', 'respond_date', $this->sorted_from_date . ' 00:00:00']);
                }
                if (!empty($this->sorted_to_date)) {
                    $query->andFilterWhere(['<=', 'respond_date', $this->sorted_to_date . ' 23:59:59']);
                }
            }

            return $dataProvider;
        }
        elseif (\Yii::$app->user->can('manageBenefit')){
            $query = Complaints::find()->where(['category'=>2]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['between','date(date_time)', $this->date1, $this->date2]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            // Handle sorted status date filtering
            if ($this->status_type === 'Sorted') {
                if (!empty($this->sorted_from_date)) {
                    $query->andFilterWhere(['>=', 'respond_date', $this->sorted_from_date . ' 00:00:00']);
                }
                if (!empty($this->sorted_to_date)) {
                    $query->andFilterWhere(['<=', 'respond_date', $this->sorted_to_date . ' 23:59:59']);
                }
            }

            return $dataProvider;

        }
        elseif (\Yii::$app->user->can('manageContribution')){
            $query = Complaints::find()->where(['category'=>3]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['between','date(date_time)', $this->date1, $this->date2]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            // Handle sorted status date filtering
            if ($this->status_type === 'Sorted') {
                if (!empty($this->sorted_from_date)) {
                    $query->andFilterWhere(['>=', 'respond_date', $this->sorted_from_date . ' 00:00:00']);
                }
                if (!empty($this->sorted_to_date)) {
                    $query->andFilterWhere(['<=', 'respond_date', $this->sorted_to_date . ' 23:59:59']);
                }
            }

            return $dataProvider;

        }
        elseif (\Yii::$app->user->can('manageInvestment')){
            $query = Complaints::find()->where(['category'=>6]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['between','date(date_time)', $this->date1, $this->date2]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            // Handle sorted status date filtering
            if ($this->status_type === 'Sorted') {
                if (!empty($this->sorted_from_date)) {
                    $query->andFilterWhere(['>=', 'respond_date', $this->sorted_from_date . ' 00:00:00']);
                }
                if (!empty($this->sorted_to_date)) {
                    $query->andFilterWhere(['<=', 'respond_date', $this->sorted_to_date . ' 23:59:59']);
                }
            }

            return $dataProvider;

        }
        elseif (\Yii::$app->user->can('manageMobileApp')){
            $query = Complaints::find()->where(['category'=>4]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['between','date(date_time)', $this->date1, $this->date2]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            // Handle sorted status date filtering
            if ($this->status_type === 'Sorted') {
                if (!empty($this->sorted_from_date)) {
                    $query->andFilterWhere(['>=', 'respond_date', $this->sorted_from_date . ' 00:00:00']);
                }
                if (!empty($this->sorted_to_date)) {
                    $query->andFilterWhere(['<=', 'respond_date', $this->sorted_to_date . ' 23:59:59']);
                }
            }

            return $dataProvider;

        }
        elseif (\Yii::$app->user->can('manageRegistration')){
            $query = Complaints::find()->where(['category'=>1]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['between','date(date_time)', $this->date1, $this->date2]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            // Handle sorted status date filtering
            if ($this->status_type === 'Sorted') {
                if (!empty($this->sorted_from_date)) {
                    $query->andFilterWhere(['>=', 'respond_date', $this->sorted_from_date . ' 00:00:00']);
                }
                if (!empty($this->sorted_to_date)) {
                    $query->andFilterWhere(['<=', 'respond_date', $this->sorted_to_date . ' 23:59:59']);
                }
            }

            return $dataProvider;

        }
        elseif (\Yii::$app->user->can('manageSuggestion')){
            $query = Complaints::find()->where(['category'=>5]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['between','date(date_time)', $this->date1, $this->date2]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            // Handle sorted status date filtering
            if ($this->status_type === 'Sorted') {
                if (!empty($this->sorted_from_date)) {
                    $query->andFilterWhere(['>=', 'respond_date', $this->sorted_from_date . ' 00:00:00']);
                }
                if (!empty($this->sorted_to_date)) {
                    $query->andFilterWhere(['<=', 'respond_date', $this->sorted_to_date . ' 23:59:59']);
                }
            }

            return $dataProvider;

        }
        else{
            $query = Complaints::find()->where(['category'=>0]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['between','date(date_time)', $this->date1, $this->date2]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            // Handle sorted status date filtering
            if ($this->status_type === 'Sorted') {
                if (!empty($this->sorted_from_date)) {
                    $query->andFilterWhere(['>=', 'respond_date', $this->sorted_from_date . ' 00:00:00']);
                }
                if (!empty($this->sorted_to_date)) {
                    $query->andFilterWhere(['<=', 'respond_date', $this->sorted_to_date . ' 23:59:59']);
                }
            }

            return $dataProvider;
        }
    }

    /**
     * Search for today's complaints
     */
    public function searchToday($params)
    {
        if (\Yii::$app->user->can('manageAllComplaints')){
            $query = Complaints::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', date('Y-m-d')]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            return $dataProvider;
        }
        elseif (\Yii::$app->user->can('manageBenefit')){
            $query = Complaints::find()->where(['category'=>2]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', date('Y-m-d')]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            return $dataProvider;

        }  elseif (\Yii::$app->user->can('manageContribution')){
            $query = Complaints::find()->where(['category'=>3]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', date('Y-m-d')]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            return $dataProvider;

        }  elseif (\Yii::$app->user->can('manageInvestment')){
            $query = Complaints::find()->where(['category'=>6]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', date('Y-m-d')]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            return $dataProvider;
        }  elseif (\Yii::$app->user->can('manageMobileApp')){
            $query = Complaints::find()->where(['category'=>4]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', date('Y-m-d')]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            return $dataProvider;
        }  elseif (\Yii::$app->user->can('manageRegistration')){
            $query = Complaints::find()->where(['category'=>1]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', date('Y-m-d')]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            return $dataProvider;
        }  elseif (\Yii::$app->user->can('manageSuggestion')){
            $query = Complaints::find()->where(['category'=>5]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', date('Y-m-d')]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            return $dataProvider;
        }
        else{
            $query = Complaints::find()->where(['category'=>0]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', date('Y-m-d')]);

            // ✅ FIXED: Apply correct status filter
            $this->applyStatusFilter($query);

            return $dataProvider;
        }

    }
    
    public function searchSorted($params)
    {
        if (\Yii::$app->user->can('manageAllComplaints')){
            // ✅ FIXED: Only show complaints that are ACTUALLY Sorted
            // Condition 1: status_type MUST be 'Sorted' values
            // Condition 2: AND response_by MUST NOT be null
            $query = Complaints::find()
                ->where(['AND',
                    ['IN', 'status_type', ['0', 0, 'Sorted']],
                    ['NOT', ['response_by' => null]]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }
        elseif (\Yii::$app->user->can('manageBenefit')){
            // ✅ FIXED: Same logic for benefit category
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 2],
                    ['IN', 'status_type', ['0', 0, 'Sorted']],
                    ['NOT', ['response_by' => null]]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;

        }  
        // ✅ FIXED: Apply same fix to ALL other categories
        elseif (\Yii::$app->user->can('manageContribution')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 3],
                    ['IN', 'status_type', ['0', 0, 'Sorted']],
                    ['NOT', ['response_by' => null]]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;

        }  
        elseif (\Yii::$app->user->can('manageInvestment')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 6],
                    ['IN', 'status_type', ['0', 0, 'Sorted']],
                    ['NOT', ['response_by' => null]]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }  
        elseif (\Yii::$app->user->can('manageMobileApp')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 4],
                    ['IN', 'status_type', ['0', 0, 'Sorted']],
                    ['NOT', ['response_by' => null]]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }  
        elseif (\Yii::$app->user->can('manageRegistration')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 1],
                    ['IN', 'status_type', ['0', 0, 'Sorted']],
                    ['NOT', ['response_by' => null]]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }  
        elseif (\Yii::$app->user->can('manageSuggestion')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 5],
                    ['IN', 'status_type', ['0', 0, 'Sorted']],
                    ['NOT', ['response_by' => null]]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }
        else{
            $query = Complaints::find()
                ->where(['AND',
                    ['OR', ['category' => 0], ['category' => null]],
                    ['IN', 'status_type', ['0', 0, 'Sorted']],
                    ['NOT', ['response_by' => null]]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }
    }
    
    public function searchPending($params)
    {
        if (\Yii::$app->user->can('manageAllComplaints')){
            // ✅ FIXED: Show complaints that are TRULY Pending
            // Condition 1: status_type in pending values OR null/empty
            // Condition 2: AND response_by MUST be null (not responded to)
            $query = Complaints::find()
                ->where(['AND',
                    ['OR',
                        ['IN', 'status_type', ['1', 1, 'Pending', null, '']],
                        ['status_type' => '']
                    ],
                    ['response_by' => null] // ✅ MUST have no response_by
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }
        elseif (\Yii::$app->user->can('manageBenefit')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 2],
                    ['OR',
                        ['IN', 'status_type', ['1', 1, 'Pending', null, '']],
                        ['status_type' => '']
                    ],
                    ['response_by' => null]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;

        }  
        elseif (\Yii::$app->user->can('manageContribution')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 3],
                    ['OR',
                        ['IN', 'status_type', ['1', 1, 'Pending', null, '']],
                        ['status_type' => '']
                    ],
                    ['response_by' => null]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;

        }  
        elseif (\Yii::$app->user->can('manageInvestment')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 6],
                    ['OR',
                        ['IN', 'status_type', ['1', 1, 'Pending', null, '']],
                        ['status_type' => '']
                    ],
                    ['response_by' => null]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }  
        elseif (\Yii::$app->user->can('manageMobileApp')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 4],
                    ['OR',
                        ['IN', 'status_type', ['1', 1, 'Pending', null, '']],
                        ['status_type' => '']
                    ],
                    ['response_by' => null]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }  
        elseif (\Yii::$app->user->can('manageRegistration')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 1],
                    ['OR',
                        ['IN', 'status_type', ['1', 1, 'Pending', null, '']],
                        ['status_type' => '']
                    ],
                    ['response_by' => null]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }  
        elseif (\Yii::$app->user->can('manageSuggestion')){
            $query = Complaints::find()
                ->where(['AND',
                    ['category' => 5],
                    ['OR',
                        ['IN', 'status_type', ['1', 1, 'Pending', null, '']],
                        ['status_type' => '']
                    ],
                    ['response_by' => null]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }
        else{
            $query = Complaints::find()
                ->where(['AND',
                    ['OR', ['category' => 0], ['category' => null]],
                    ['OR',
                        ['IN', 'status_type', ['1', 1, 'Pending', null, '']],
                        ['status_type' => '']
                    ],
                    ['response_by' => null]
                ]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 250],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
            $this->load($params);

            if (!$this->validate()) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'date_time' => $this->date_time,
                'category' => $this->category,
            ]);

            $query->andFilterWhere(['like', 'zssf_number', $this->zssf_number])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'photo_file', $this->photo_file])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['=','date(date_time)', $this->date_time]);

            return $dataProvider;
        }
    }

} 