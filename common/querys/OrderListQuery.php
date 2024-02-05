<?php

namespace common\querys;

use common\models\OrderList;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[OrderList]].
 *
 * @see OrderList
 */
class OrderListQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return OrderList[]|array
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
