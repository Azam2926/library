<?php

namespace common\models;

use common\querys\ResourceQuery;
use common\querys\ResourceShowerQuery;
use JetBrains\PhpStorm\ArrayShape;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "resource_shower".
 *
 * @property int $id
 * @property int $resource_id
 * @property int $type
 *
 * @property Resource $resource
 */
class ResourceShower extends ActiveRecord
{

    const SLIDER = 1;
    const FEATURE = 2;
    const ARCHIVED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'resource_shower';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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
    #[ArrayShape(['id' => "string", 'resource_id' => "string", 'type' => "string"])] public function attributeLabels(): array
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
     * @return ActiveQuery|ResourceQuery
     */
    public function getResource(): ActiveQuery|ResourceQuery
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id']);
    }

    /**
     * {@inheritdoc}
     * @return ResourceShowerQuery the active query used by this AR class.
     */
    public static function find(): ResourceShowerQuery
    {
        return new ResourceShowerQuery(get_called_class());
    }
}
