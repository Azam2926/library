<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_list".
 *
 * @property int $id
 * @property int $order_id
 * @property int $resource_id
 * @property float|null $price
 * @property int|null $quantity
 * @property string|null $created_at
 *
 * @property Order $order
 * @property Resource $resource
 */
class OrderList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'resource_id'], 'required'],
            [['order_id', 'resource_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
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
            'order_id' => 'Order ID',
            'resource_id' => 'Resource ID',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|\common\querys\OrderQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id'])->inverseOf('orderLists');
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return \yii\db\ActiveQuery|\common\querys\ResourceQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id'])->inverseOf('orderLists');
    }

    /**
     * {@inheritdoc}
     * @return \common\querys\OrderListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\querys\OrderListQuery(get_called_class());
    }
}
