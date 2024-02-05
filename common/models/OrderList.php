<?php

namespace common\models;

use common\querys\OrderListQuery;
use common\querys\OrderQuery;
use common\querys\ResourceQuery;
use JetBrains\PhpStorm\ArrayShape;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class OrderList extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'order_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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
    #[ArrayShape(['id' => "string", 'order_id' => "string", 'resource_id' => "string", 'price' => "string", 'quantity' => "string", 'created_at' => "string"])] public function attributeLabels(): array
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
     * @return ActiveQuery|OrderQuery
     */
    public function getOrder(): ActiveQuery|OrderQuery
    {
        return $this->hasOne(Order::class, ['id' => 'order_id'])->inverseOf('orderLists');
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return ActiveQuery|ResourceQuery
     */
    public function getResource(): ActiveQuery|ResourceQuery
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id'])->inverseOf('orderLists');
    }

    /**
     * {@inheritdoc}
     * @return OrderListQuery the active query used by this AR class.
     */
    public static function find(): OrderListQuery
    {
        return new OrderListQuery(get_called_class());
    }
}
