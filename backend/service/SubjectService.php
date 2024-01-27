<?php

namespace backend\service;

use backend\repositories\SubjectRepository;
use common\models\Subject;
use Yii;
use yii\base\Component;
use yii\db\Exception;
use yii\db\StaleObjectException;
use Throwable;

class SubjectService extends Component
{

    public SubjectRepository $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository, $config = [])
    {
        parent::__construct($config);
        $this->subjectRepository = $subjectRepository;
    }


    /**
     * @throws Throwable
     * @throws Exception
     * @throws StaleObjectException
     */
    public function softDelete(int $id): void
    {
        $model =  $this->subjectRepository->findById($id);

        if(!$model){
            throw new Exception('Resource shower not found');
        }


        if($model->parent_id == null){

          $child_models = $this->subjectRepository->findParent($id);

          if(!$child_models){
              throw new Exception('Child not found');
          }

          $transaction = Yii::$app->db->beginTransaction();

            try{
              foreach ($child_models as $child_model){
                  $child_model->delete();
              }

              $transaction->commit();
            }
            catch (Exception $e){
//                dd($e->getMessage());

                $transaction->rollBack();
                Yii::error($e->getMessage());
                throw $e;
            }
        }

    }

}