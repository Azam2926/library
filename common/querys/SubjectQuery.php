<?php

namespace common\querys;

use yii\db\ActiveQuery;
use common\models\Subject;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[Subject]].
 *
 * @see Subject
 */
class SubjectQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Subject[]|array
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
    public function parent(): SubjectQuery
    {
        return $this->where(['parent_id' => null]);
    }

    public function findById($id): SubjectQuery
    {
        return $this->where(['id' => $id]);
    }
    public function findParent($parent_id): SubjectQuery
    {
        return $this->andWhere(['parent_id' => $parent_id]);
    }


}
