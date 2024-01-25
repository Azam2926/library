<?php

namespace backend\service;

use backend\repositories\ResourceShowerRepository;
use common\models\ResourceShower;
use yii\base\Component;
use yii\db\Exception;

class ResourceShowerService extends Component
{

    public ResourceShowerRepository $resourceShowerRepository;

    public function __construct(ResourceShowerRepository $resourceShowerRepository, $config = [])
    {
        parent::__construct($config);
        $this->resourceShowerRepository = $resourceShowerRepository;
    }

    public function create($form): void
    {

        foreach ($form->resource_id as $id){
            $model = new ResourceShower();
            $model->resource_id = $id;
            $model->type = $form->type;
            $model->save();
        }

    }

    /**
     * @throws Exception
     */
    public function update($form): void
    {
        $form->id = intval($form->id);

       $model =  $this->resourceShowerRepository->findById($form->id);

       if(!$model){
           throw new Exception('Resource shower not found');
       }

       foreach ($form->resource_id as $id){

            $model->resource_id = $id;
            $model->type = $form->type;
            $model->save();
        }
    }

    /**
     * @throws Exception
     * @throws \Throwable
     */
    public function delete(int $id): void
    {
        $model =  $this->resourceShowerRepository->findById($id);

        if(!$model){
            throw new Exception('Resource shower not found');
        }

        $model->delete();
    }

}