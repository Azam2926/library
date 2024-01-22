<?php

namespace common\models;

use Yii;

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
class CartItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
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
    public function attributeLabels()
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
     * @return \yii\db\ActiveQuery|\common\querys\CartsQuery
     */
    public function getCart()
    {
        return $this->hasOne(Carts::class, ['id' => 'cart_id'])->inverseOf('cartItems');
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return \yii\db\ActiveQuery|\common\querys\ResourceQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id'])->inverseOf('cartItems');
    }

    /**
     * {@inheritdoc}
     * @return \common\querys\CartItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\querys\CartItemsQuery(get_called_class());
    }
}
