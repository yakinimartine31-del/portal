<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nfojm_contact_details".
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string|null $con_position
 * @property string|null $address
 * @property string|null $suburb
 * @property string|null $state
 * @property string|null $country
 * @property string|null $postcode
 * @property string|null $telephone
 * @property string|null $fax
 * @property string|null $misc
 * @property string|null $image
 * @property string|null $email_to
 * @property int $default_con
 * @property int $published
 * @property int $checked_out
 * @property string $checked_out_time
 * @property int $ordering
 * @property string $params
 * @property int $user_id
 * @property int $catid
 * @property int $access
 * @property string $mobile
 * @property string $webpage
 * @property string $sortname1
 * @property string $sortname2
 * @property string $sortname3
 * @property string $language
 * @property string $created
 * @property int $created_by
 * @property string $created_by_alias
 * @property string $modified
 * @property int $modified_by
 * @property string $metakey
 * @property string $metadesc
 * @property string $metadata
 * @property int $featured Set if article is featured.
 * @property string $xreference A reference to enable linkages to external data sets.
 * @property string $publish_up
 * @property string $publish_down
 * @property int $version
 * @property int $hits
 */
class ContactDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nfojm_contact_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'params', 'language', 'metakey', 'metadesc', 'metadata'], 'required'],
            [['address', 'misc', 'params', 'metakey', 'metadesc', 'metadata'], 'string'],
            [['default_con', 'published', 'checked_out', 'ordering', 'user_id', 'catid', 'access', 'created_by', 'modified_by', 'featured', 'version', 'hits'], 'integer'],
            [['checked_out_time', 'created', 'modified', 'publish_up', 'publish_down'], 'safe'],
            [['name', 'con_position', 'telephone', 'fax', 'image', 'email_to', 'mobile', 'webpage', 'sortname1', 'sortname2', 'sortname3', 'created_by_alias'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 400],
            [['suburb', 'state', 'country', 'postcode'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 7],
            [['xreference'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'name' => Yii::t('yii', 'Name'),
            'alias' => Yii::t('yii', 'Alias'),
            'con_position' => Yii::t('yii', 'Con Position'),
            'address' => Yii::t('yii', 'Address'),
            'suburb' => Yii::t('yii', 'Suburb'),
            'state' => Yii::t('yii', 'State'),
            'country' => Yii::t('yii', 'Country'),
            'postcode' => Yii::t('yii', 'Postcode'),
            'telephone' => Yii::t('yii', 'Telephone'),
            'fax' => Yii::t('yii', 'Fax'),
            'misc' => Yii::t('yii', 'Misc'),
            'image' => Yii::t('yii', 'Image'),
            'email_to' => Yii::t('yii', 'Email To'),
            'default_con' => Yii::t('yii', 'Default Con'),
            'published' => Yii::t('yii', 'Published'),
            'checked_out' => Yii::t('yii', 'Checked Out'),
            'checked_out_time' => Yii::t('yii', 'Checked Out Time'),
            'ordering' => Yii::t('yii', 'Ordering'),
            'params' => Yii::t('yii', 'Params'),
            'user_id' => Yii::t('yii', 'User ID'),
            'catid' => Yii::t('yii', 'Catid'),
            'access' => Yii::t('yii', 'Access'),
            'mobile' => Yii::t('yii', 'Mobile'),
            'webpage' => Yii::t('yii', 'Webpage'),
            'sortname1' => Yii::t('yii', 'Sortname1'),
            'sortname2' => Yii::t('yii', 'Sortname2'),
            'sortname3' => Yii::t('yii', 'Sortname3'),
            'language' => Yii::t('yii', 'Language'),
            'created' => Yii::t('yii', 'Created'),
            'created_by' => Yii::t('yii', 'Created By'),
            'created_by_alias' => Yii::t('yii', 'Created By Alias'),
            'modified' => Yii::t('yii', 'Modified'),
            'modified_by' => Yii::t('yii', 'Modified By'),
            'metakey' => Yii::t('yii', 'Metakey'),
            'metadesc' => Yii::t('yii', 'Metadesc'),
            'metadata' => Yii::t('yii', 'Metadata'),
            'featured' => Yii::t('yii', 'Featured'),
            'xreference' => Yii::t('yii', 'Xreference'),
            'publish_up' => Yii::t('yii', 'Publish Up'),
            'publish_down' => Yii::t('yii', 'Publish Down'),
            'version' => Yii::t('yii', 'Version'),
            'hits' => Yii::t('yii', 'Hits'),
        ];
    }
}
