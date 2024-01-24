<?php

namespace backend\service;

use common\models\ResourceShower;

class ResourceShowerService
{
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

}