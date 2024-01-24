<?php

namespace backend\form;


use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ResourceShowerForm extends Model
{
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
        ];
    }
}