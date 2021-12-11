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
}
