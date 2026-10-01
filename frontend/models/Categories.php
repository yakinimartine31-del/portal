<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "nfojm_categories".
 *
 * @property int $id
 * @property int $asset_id FK to the #__assets table.
 * @property int $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $level
 * @property string $path
 * @property string $extension
 * @property string $title
 * @property string $alias
 * @property string $note
 * @property string $description
 * @property int $published
 * @property int $checked_out
 * @property string $checked_out_time
 * @property int $access
 * @property string $params
 * @property string $metadesc The meta description for the page.
 * @property string $metakey The meta keywords for the page.
 * @property string $metadata JSON encoded metadata properties.
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 * @property int $hits
 * @property string $language
 * @property int $version
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nfojm_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asset_id', 'parent_id', 'lft', 'rgt', 'level', 'published', 'checked_out', 'access', 'created_user_id', 'modified_user_id', 'hits', 'version'], 'integer'],
            [['description', 'params'], 'required'],
            [['description', 'params'], 'string'],
            [['checked_out_time', 'created_time', 'modified_time'], 'safe'],
            [['path', 'alias'], 'string', 'max' => 400],
            [['extension'], 'string', 'max' => 50],
            [['title', 'note'], 'string', 'max' => 255],
            [['metadesc', 'metakey'], 'string', 'max' => 1024],
            [['metadata'], 'string', 'max' => 2048],
            [['language'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'asset_id' => Yii::t('yii', 'Asset ID'),
            'parent_id' => Yii::t('yii', 'Parent ID'),
            'lft' => Yii::t('yii', 'Lft'),
            'rgt' => Yii::t('yii', 'Rgt'),
            'level' => Yii::t('yii', 'Level'),
            'path' => Yii::t('yii', 'Path'),
            'extension' => Yii::t('yii', 'Extension'),
            'title' => Yii::t('yii', 'Title'),
            'alias' => Yii::t('yii', 'Alias'),
            'note' => Yii::t('yii', 'Note'),
            'description' => Yii::t('yii', 'Description'),
            'published' => Yii::t('yii', 'Published'),
            'checked_out' => Yii::t('yii', 'Checked Out'),
            'checked_out_time' => Yii::t('yii', 'Checked Out Time'),
            'access' => Yii::t('yii', 'Access'),
            'params' => Yii::t('yii', 'Params'),
            'metadesc' => Yii::t('yii', 'Metadesc'),
            'metakey' => Yii::t('yii', 'Metakey'),
            'metadata' => Yii::t('yii', 'Metadata'),
            'created_user_id' => Yii::t('yii', 'Created User ID'),
            'created_time' => Yii::t('yii', 'Created Time'),
            'modified_user_id' => Yii::t('yii', 'Modified User ID'),
            'modified_time' => Yii::t('yii', 'Modified Time'),
            'hits' => Yii::t('yii', 'Hits'),
            'language' => Yii::t('yii', 'Language'),
            'version' => Yii::t('yii', 'Version'),
        ];
    }
}
