<?php

namespace common\querys;

/**
 * This is the ActiveQuery class for [[\common\models\Type]].
 *
 * @see \common\models\Type
 */
class TypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Type[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Type|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
