<?php

namespace common\models;

/**
 * This is the model class for table "resource_images".
 *
 * @property int $id
 * @property int $resource_id
 * @property string|null $path
 *
 * @property Resource $resource
 */
class ResourceImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_images';
    }

    /**
     * {@inheritdoc}
     * @return ResourceImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResourceImagesQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource_id'], 'required'],
            [['resource_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::class, 'targetAttribute' => ['resource_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resource_id' => 'Resource ID',
            'path' => 'Path',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => '\yiidreamteam\upload\ImageUploadBehavior',
                'attribute' => 'path',
                'filePath' => '@webroot/uploads/[[model]]/[[resource_id]]/[[filename]].[[extension]]',
                'fileUrl' => '/uploads/[[model]]/[[resource_id]]/[[filename]].[[extension]]',
            ]
        ];
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return \yii\db\ActiveQuery|common\querys\ResourceQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id']);
    }
}
