<?php

namespace common\querys;

/**
 * This is the ActiveQuery class for [[\common\models\OrderList]].
 *
 * @see \common\models\OrderList
 */
class OrderListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\OrderList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\OrderList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
