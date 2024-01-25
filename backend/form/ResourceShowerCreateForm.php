<?php

namespace backend\form;


use Yii;
use yii\base\Model;
use common\models\User;

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
    public function rules()
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