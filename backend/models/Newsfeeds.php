<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nfojm_newsfeeds".
 *
 * @property int $catid
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string $link
 * @property int $published
 * @property int $numarticles
 * @property int $cache_time
 * @property int $checked_out
 * @property string $checked_out_time
 * @property int $ordering
 * @property int $rtl
 * @property int $access
 * @property string $language
 * @property string $params
 * @property string $created
 * @property int $created_by
 * @property string $created_by_alias
 * @property string $modified
 * @property int $modified_by
 * @property string $metakey
 * @property string $metadesc
 * @property string $metadata
 * @property string $xreference
 * @property string $publish_up
 * @property string $publish_down
 * @property string $description
 * @property int $version
 * @property int $hits
 * @property string $images
 */
class Newsfeeds extends \yii\db\ActiveRecord
{

    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nfojm_newsfeeds';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catid', 'published', 'numarticles', 'cache_time', 'checked_out', 'ordering', 'rtl', 'access', 'created_by', 'modified_by', 'version', 'hits'], 'integer'],
            [['name', 'description','params'], 'required'],
            [['checked_out_time', 'created', 'modified', 'publish_up', 'publish_down'], 'safe'],
            [['params', 'metakey', 'metadesc', 'metadata', 'description', 'images'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['alias'], 'string', 'max' => 400],
            [['link'], 'string', 'max' => 2048],
            [['language'], 'string', 'max' => 7],
            [['created_by_alias'], 'string', 'max' => 255],
            [['xreference'], 'string', 'max' => 50],

            [['file',], 'file', 'extensions' => 'pdf,jpg, jpeg, png', 'skipOnEmpty' => false,
                'checkExtensionByMimeType' => false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'catid' => Yii::t('yii', 'Catid'),
            'id' => Yii::t('yii', 'ID'),
            'name' => Yii::t('yii', 'Name'),
            'alias' => Yii::t('yii', 'Alias'),
            'link' => Yii::t('yii', 'Link'),
            'published' => Yii::t('yii', 'Published'),
            'numarticles' => Yii::t('yii', 'Numarticles'),
            'cache_time' => Yii::t('yii', 'Cache Time'),
            'checked_out' => Yii::t('yii', 'Checked Out'),
            'checked_out_time' => Yii::t('yii', 'Checked Out Time'),
            'ordering' => Yii::t('yii', 'Ordering'),
            'rtl' => Yii::t('yii', 'Rtl'),
            'access' => Yii::t('yii', 'Access'),
            'language' => Yii::t('yii', 'Language'),
            'params' => Yii::t('yii', 'Title'),
            'created' => Yii::t('yii', 'Created'),
            'created_by' => Yii::t('yii', 'Created By'),
            'created_by_alias' => Yii::t('yii', 'Created By Alias'),
            'modified' => Yii::t('yii', 'Modified'),
            'modified_by' => Yii::t('yii', 'Modified By'),
            'metakey' => Yii::t('yii', 'Metakey'),
            'metadesc' => Yii::t('yii', 'Metadesc'),
            'metadata' => Yii::t('yii', 'Metadata'),
            'xreference' => Yii::t('yii', 'Xreference'),
            'publish_up' => Yii::t('yii', 'Publish Up'),
            'publish_down' => Yii::t('yii', 'Publish Down'),
            'description' => Yii::t('yii', 'Description'),
            'version' => Yii::t('yii', 'Version'),
            'hits' => Yii::t('yii', 'Hits'),
            'images' => Yii::t('yii', 'Images'),
        ];
    }
}
