<?php

namespace common\querys;

/**
 * This is the ActiveQuery class for [[\common\models\Subject]].
 *
 * @see \common\models\Subject
 */
class SubjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Subject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Subject|array|null
     */
    public function one($db = null)
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
