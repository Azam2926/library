<?php

namespace common\models;

use common\querys\CartItemsQuery;
use common\querys\CartsQuery;
use common\querys\ResourceQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cart_items".
 *
 * @property int $id
 * @property int $cart_id
 * @property int $resource_id
 * @property float|null $price
 * @property int|null $quantity
 * @property string|null $created_at
 *
 * @property Carts $cart
 * @property Resource $resource
 */
class CartItems extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'cart_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['cart_id', 'resource_id'], 'required'],
            [['cart_id', 'resource_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['cart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carts::class, 'targetAttribute' => ['cart_id' => 'id']],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::class, 'targetAttribute' => ['resource_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'cart_id' => 'Cart ID',
            'resource_id' => 'Resource ID',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Cart]].
     *
     * @return ActiveQuery|CartsQuery
     */
    public function getCart(): ActiveQuery|CartsQuery
    {
        return $this->hasOne(Carts::class, ['id' => 'cart_id'])->inverseOf('cartItems');
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return ActiveQuery|ResourceQuery
     */
    public function getResource(): ActiveQuery|ResourceQuery
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id'])->inverseOf('cartItems');
    }

    /**
     * {@inheritdoc}
     * @return CartItemsQuery the active query used by this AR class.
     */
    public static function find(): CartItemsQuery
    {
        return new CartItemsQuery(get_called_class());
    }
}
