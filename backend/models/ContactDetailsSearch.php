<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ContactDetails;

/**
 * ContactDetailsSearch represents the model behind the search form of `backend\models\ContactDetails`.
 */
class ContactDetailsSearch extends ContactDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'default_con', 'published', 'checked_out', 'ordering', 'user_id', 'catid', 'access', 'created_by', 'modified_by', 'featured', 'version', 'hits'], 'integer'],
            [['name', 'alias', 'con_position', 'address', 'suburb', 'state', 'country', 'postcode', 'telephone', 'fax', 'misc', 'image', 'email_to', 'checked_out_time', 'params', 'mobile', 'webpage', 'sortname1', 'sortname2', 'sortname3', 'language', 'created', 'created_by_alias', 'modified', 'metakey', 'metadesc', 'metadata', 'xreference', 'publish_up', 'publish_down'], 'safe'],
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
        $query = ContactDetails::find();

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
            'id' => $this->id,
            'default_con' => $this->default_con,
            'published' => $this->published,
            'checked_out' => $this->checked_out,
            'checked_out_time' => $this->checked_out_time,
            'ordering' => $this->ordering,
            'user_id' => $this->user_id,
            'catid' => $this->catid,
            'access' => $this->access,
            'created' => $this->created,
            'created_by' => $this->created_by,
            'modified' => $this->modified,
            'modified_by' => $this->modified_by,
            'featured' => $this->featured,
            'publish_up' => $this->publish_up,
            'publish_down' => $this->publish_down,
            'version' => $this->version,
            'hits' => $this->hits,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'con_position', $this->con_position])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'suburb', $this->suburb])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'misc', $this->misc])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'email_to', $this->email_to])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'webpage', $this->webpage])
            ->andFilterWhere(['like', 'sortname1', $this->sortname1])
            ->andFilterWhere(['like', 'sortname2', $this->sortname2])
            ->andFilterWhere(['like', 'sortname3', $this->sortname3])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'created_by_alias', $this->created_by_alias])
            ->andFilterWhere(['like', 'metakey', $this->metakey])
            ->andFilterWhere(['like', 'metadesc', $this->metadesc])
            ->andFilterWhere(['like', 'metadata', $this->metadata])
            ->andFilterWhere(['like', 'xreference', $this->xreference]);

        return $dataProvider;
    }
}
