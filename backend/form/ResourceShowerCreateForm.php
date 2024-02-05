<?php

namespace backend\form;


use yii\base\Model;

/**
 * Signup form
 */
class ResourceShowerCreateForm extends Model
{
    public $id;
    public $resource_id;
    public $type;


    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['resource_id', 'safe'],
            ['resource_id', 'required'],

            ['type', 'integer'],
            ['type', 'required'],

            ['id', 'safe'],
        ];
    }
}