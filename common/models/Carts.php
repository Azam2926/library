<?php

namespace common\models;

use common\querys\CartItemsQuery;
use common\querys\CartsQuery;
use JetBrains\PhpStorm\ArrayShape;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "carts".
 *
 * @property int $id
 * @property int|null $created_by
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CartItems[] $cartItems
 * @property User $user
 */
class Carts extends ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_IN_ACTIVE =2;
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'carts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['created_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    #[ArrayShape(['id' => "string", 'created_by' => "string", 'status' => "string", 'created_at' => "string", 'updated_at' => "string"])] public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'created_by' => 'Created By',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CartItems]].
     *
     * @return ActiveQuery|CartItemsQuery
     */
    public function getCartItems(): ActiveQuery|CartItemsQuery
    {
        return $this->hasMany(CartItems::class, ['cart_id' => 'id']);
    }

    public function getUser(): ActiveQuery|CartItemsQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return CartsQuery the active query used by this AR class.
     */
    public static function find(): CartsQuery
    {
        return new CartsQuery(get_called_class());
    }
}
