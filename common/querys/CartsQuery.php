<?php

namespace common\querys;

use common\models\Carts;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[Carts]].
 *
 * @see Carts
 */
class CartsQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Carts[]|array
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

    public function findByUserId($user_id): CartsQuery
    {
        return $this->andWhere(['created_by' => $user_id]);
    }
}
