<?php

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "sys_zssf_members_34_repeat".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $depedennt_id
 * @property string|null $dependent_names
 * @property string|null $relationship
 */
class Members34Repeat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_zssf_members_34_repeat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['relationship'], 'string'],
            [['depedennt_id', 'dependent_names'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'parent_id' => Yii::t('yii', 'Parent ID'),
            'depedennt_id' => Yii::t('yii', 'Depedennt ID'),
            'dependent_names' => Yii::t('yii', 'Dependent Names'),
            'relationship' => Yii::t('yii', 'Relationship'),
        ];
    }

    public function searchDependant($id)
    {

        $query = Members34Repeat::find()->where(['parent_id'=>$id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => ['defaultOrder' => [
                'relationship' => SORT_DESC,
            ]
            ]
        ]);

        $this->load($id);

        $query->andFilterWhere([

            'parent_id' => $id,
        ]);

        // $query->orderBy(['photo'=>SORT_ASC]);
        return $dataProvider;

    }
}
