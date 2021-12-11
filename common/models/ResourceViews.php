<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resource_views".
 *
 * @property int $id
 * @property int $resource_id
 * @property int|null $count
 *
 * @property Resource $resource
 */
class ResourceViews extends \yii\db\ActiveRecord
{
    public $all_counts;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_views';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource_id'], 'required'],
            [['resource_id', 'count'], 'integer'],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::className(), 'targetAttribute' => ['resource_id' => 'id']],
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
            'count' => 'Count',
        ];
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return \yii\db\ActiveQuery|\common\querys\ResourceQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\querys\ResourceViewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\querys\ResourceViewsQuery(get_called_class());
    }
}
