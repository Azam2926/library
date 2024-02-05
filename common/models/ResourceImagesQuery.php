<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[ResourceImages]].
 *
 * @see ResourceImages
 */
class ResourceImagesQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return ResourceImages[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return array|ActiveRecord|null
     */
    public function one($db = null): array|ActiveRecord|null
    {
        return parent::one($db);
    }

    public function resourceId($resource_id): ResourceImagesQuery
    {
        return $this->andWhere(['resource_id' => $resource_id]);
    }
}
