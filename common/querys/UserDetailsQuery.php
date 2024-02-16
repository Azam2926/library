<?php

namespace common\querys;

use yii\db\ActiveQuery;
use common\models\UserDetails;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[UserDetails]].
 *
 * @see UserDetails
 */
class UserDetailsQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserDetails[]|array
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
