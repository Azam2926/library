<?php

namespace common\querys;

use common\models\ResourceShower;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[ResourceShower]].
 *
 * @see ResourceShower
 */
class ResourceShowerQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return ResourceShower[]|array
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

    public function findById($id): ResourceShowerQuery
    {
        return $this->andWhere(['id' => $id]);
    }

    public function findByType(int $type): ResourceShowerQuery
    {
        return $this->andWhere(['type' => $type]);
    }
}
