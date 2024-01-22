<?php

namespace common\querys;

/**
 * This is the ActiveQuery class for [[\common\models\Carts]].
 *
 * @see \common\models\Carts
 */
class CartsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Carts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Carts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
