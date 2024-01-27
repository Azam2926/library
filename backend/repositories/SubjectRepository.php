<?php

namespace backend\repositories;


use common\models\Resource;
use common\models\Subject;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class SubjectRepository
{
    public function parentSubjectList(): array
    {
        return  ArrayHelper::map(Subject::find()->parent()->asArray()->all(),'id', 'name');
    }

    public function findById($id): Subject|array|null
    {
        return Subject::find()->findById($id)->one();
    }
    public function findParent($parent_id): Subject|array|null
    {
        return Subject::find()->findParent($parent_id)->all();
    }

    /**
     * @throws Exception
     */
    public function deleteAll($models): int
    {
      return  Subject::deleteAll($models);
    }
}