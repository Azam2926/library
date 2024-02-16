<?php

namespace frontend\forms;

use yii\base\Model;

/**
 * Signup form
 */
class OrderForm extends Model
{
    public string $firstname;
    public string $lastname;
    public string $home_address;
    public string $work_address;
    public string $full_address;
    public string $description;
    public string $cart_id;


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