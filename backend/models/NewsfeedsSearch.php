<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Newsfeeds;

/**
 * NewsfeedsSearch represents the model behind the search form of `backend\models\Newsfeeds`.
 */
class NewsfeedsSearch extends Newsfeeds
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catid', 'id', 'published', 'numarticles', 'cache_time', 'checked_out', 'ordering', 'rtl', 'access', 'created_by', 'modified_by', 'version', 'hits'], 'integer'],
            [['name', 'alias', 'link', 'checked_out_time', 'language', 'params', 'created', 'created_by_alias', 'modified', 'metakey', 'metadesc', 'metadata', 'xreference', 'publish_up', 'publish_down', 'description', 'images'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Newsfeeds::find();

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

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'catid' => $this->catid,
            'id' => $this->id,
            'published' => $this->published,
            'numarticles' => $this->numarticles,
            'cache_time' => $this->cache_time,
            'checked_out' => $this->checked_out,
            'checked_out_time' => $this->checked_out_time,
            'ordering' => $this->ordering,
            'rtl' => $this->rtl,
            'access' => $this->access,
            'created' => $this->created,
            'created_by' => $this->created_by,
            'modified' => $this->modified,
            'modified_by' => $this->modified_by,
            'publish_up' => $this->publish_up,
            'publish_down' => $this->publish_down,
            'version' => $this->version,
            'hits' => $this->hits,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'created_by_alias', $this->created_by_alias])
            ->andFilterWhere(['like', 'metakey', $this->metakey])
            ->andFilterWhere(['like', 'metadesc', $this->metadesc])
            ->andFilterWhere(['like', 'metadata', $this->metadata])
            ->andFilterWhere(['like', 'xreference', $this->xreference])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'images', $this->images]);

        return $dataProvider;
    }
}
