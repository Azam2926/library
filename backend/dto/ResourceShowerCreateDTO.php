<?php


namespace backend\dto;


use yii\base\Model;

class ResourceShowerCreateDTO extends Model
{

    public array $resource_ids;
    public int $type;

//    public function __construct(array $resource_ids, int $type)
//    {
//        $this->resource_ids = $resource_ids;
//        $this->type = $type;
//    }


}