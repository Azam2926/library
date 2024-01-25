<?php

namespace common\querys;

use common\models\ResourceShower;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\ResourceShower]].
 *
 * @see ResourceShower
 */
class ResourceShowerQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return ResourceShower[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ResourceShower|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function findById($id): ResourceShowerQuery
    {
        return $this->andWhere(['id' => $id]);
    }
}
