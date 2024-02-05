<?php

namespace common\querys;

use common\models\Type;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[Type]].
 *
 * @see Type
 */
class TypeQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Type[]|array
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
