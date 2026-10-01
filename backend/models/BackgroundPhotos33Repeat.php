<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_background_photos_33_repeat".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $slide_name
 * @property string|null $image
 */
class BackgroundPhotos33Repeat extends \yii\db\ActiveRecord
{

    public  $picha;
    public  $picha_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_background_photos_33_repeat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['image'], 'string'],
            [['picha',], 'file', 'extensions' => 'png','maxSize' => 1000000*1*1,'tooBig' => 'Limit of size is 1 MB, height is 2292 Pixels
            and Width 1442 pixels', 'skipOnEmpty' => true,
                'checkExtensionByMimeType' => false],
            [['slide_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'slide_name' => 'Slide Name',
            'image' => 'Image',
        ];
    }
}
