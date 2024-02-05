<?php

namespace common\querys;

use common\models\Order;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[Order]].
 *
 * @see Order
 */
class OrderQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Order[]|array
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
}
