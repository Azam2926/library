<?php

namespace frontend\forms;

use yii\base\Model;

/**
 * Signup form
 */
class OrderForm extends Model
{
    public $firstname;
    public $lastname;
    public $home_address;
    public $work_address;
    public $full_address;
    public $description;
    public $cart_id;


    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['cart_id'], 'safe'],
            [['home_address', 'work_address', 'full_address', 'description'], 'string'],
            [['firstname', 'lastname'], 'string', 'max' => 255],
        ];
    }
}