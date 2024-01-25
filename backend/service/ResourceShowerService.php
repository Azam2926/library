<?php

namespace backend\service;

use backend\repositories\ResourceShowerRepository;
use common\models\ResourceShower;
use yii\db\Exception;

class ResourceShowerService
{

    public ResourceShowerRepository $resourceShowerRepository;

    public function create($form)
    {

        foreach ($form->resource_id as $id){
            $model = new ResourceShower();
            $model->resource_id = $id;
            $model->type = $form->type;
            $model->save();
        }

        return ;
    }

    public function update($form)
    {

       $model =  $this->resourceShowerRepository->findByid($form->id);

       if(!$model){
           throw new Exception('Resource shower not found');
       }

       foreach ($form->resource_id as $id){

            $model->resource_id = $id;
            $model->type = $form->type;
            $model->save();
        }
    }

}