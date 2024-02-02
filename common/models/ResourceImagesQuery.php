<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ResourceImages]].
 *
 * @see ResourceImages
 */
class ResourceImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ResourceImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ResourceImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function resourceId($resource_id): ResourceImagesQuery
    {
        return $this->andWhere(['resource_id' => $resource_id]);
    }
}
