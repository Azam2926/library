<?php

namespace common\querys;

/**
 * This is the ActiveQuery class for [[\common\models\ResourceDownloads]].
 *
 * @see \common\models\ResourceDownloads
 */
class ResourceDownloadsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\ResourceDownloads[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ResourceDownloads|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
