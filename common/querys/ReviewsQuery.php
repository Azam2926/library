<?php

namespace common\models\querys;

use common\models\Reviews;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[Reviews]].
 *
 * @see Reviews
 */
class ReviewsQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Reviews[]|array
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
