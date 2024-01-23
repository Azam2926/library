<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resource_shower".
 *
 * @property int $id
 * @property int $resource_id
 * @property int $type
 *
 * @property Resource $resource
 */
class ResourceShower extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_shower';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource_id', 'type'], 'required'],
            [['resource_id', 'type'], 'integer'],
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
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return \yii\db\ActiveQuery|\common\querys\ResourceQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id'])->inverseOf('resourceShowers');
    }

    /**
     * {@inheritdoc}
     * @return \common\querys\ResourceShowerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\querys\ResourceShowerQuery(get_called_class());
    }
}
