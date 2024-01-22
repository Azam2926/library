<?php

namespace common\models;

use Yii;

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
 */
class Carts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
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
     * @return \yii\db\ActiveQuery|\common\querys\CartItemsQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItems::class, ['cart_id' => 'id'])->inverseOf('cart');
    }

    /**
     * {@inheritdoc}
     * @return \common\querys\CartsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\querys\CartsQuery(get_called_class());
    }
}
