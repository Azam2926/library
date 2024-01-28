<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resource_images".
 *
 * @property int $id
 * @property int $resource_id
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
     */
    public function rules()
    {
        return [
            [['resource_id'], 'required'],
            [['resource_id'], 'integer'],
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

    /**
     * {@inheritdoc}
     * @return ResourceImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResourceImagesQuery(get_called_class());
    }
}
